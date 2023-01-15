<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\Livre;
use App\Form\AchatType;
use App\Repository\AchatRepository;
use App\Repository\LivreRepository;
use App\Repository\MobileMoneyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/achat')]
class AchatController extends AbstractController
{
    #[Route('/', name: 'app_achat_index', methods: ['GET'])]
    public function index(AchatRepository $achatRepository): Response
    {

        $user=$this->getUser();

        return $this->render('achat/index.html.twig', [
            'achats' => $achatRepository->findBy(['user'=>$user]),
        ]);
    }

    #[Route('/new', name: 'app_achat_new', methods: ['GET', 'POST'])]
    public function new(MailerInterface $mailer, LivreRepository $livreRepository, SessionInterface $session,MobileMoneyRepository $mobileMoneyRepository, LivreRepository $produitRepository, Request $request, EntityManagerInterface $entityManager): Response
    {

        $this->isGranted('IS_AUTHENTICATED_FULLY');
        $user=$this->getUser();
        if(!$user){
            $this->addFlash("info", "Prière de vous connectez avant de confirmer votre achat");
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);

        }
        ///verifier que le mobile money sont déja configuré 
        $mobileMoneys = $mobileMoneyRepository->findAll();
        if(sizeof($mobileMoneys)==0){
            $this->addFlash('info','Contacter le gestionnaire du site pour création des mobiles money....');
            return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
        }
        
        $email=$user->getEmail();
        $achat = new Achat($user);
        $livre=$livreRepository->findOneBy([]);
        // dd($livre);
        if($livre==null){
            $this->addFlash('info','Contacter le gestionnaire du site pour création configuration du livre ....');
            return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
        }else{
            $achat->setLivre($livre);
        }
        // dd($achat->getMobileMoney());
        //ici on recupere la session et on initialise les données dans l'achat 
        $panier=$session->get('panier',[]);
        if($panier==null){
            // return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }
        $dataPanier=[];
        $total=0;
        foreach($panier as $id=>$quantite){
            $produit=$produitRepository->find($id);
            if($produit){
                $dataPanier[]=[
                    'produit'=>$produit,
                    'quantite'=>$quantite,
                ];
                $total +=$produit->getPrix() * $quantite;
                $achat->setLivre($produit);
                $achat->setQuantite($quantite);
                $achat->setMontantTotal($quantite * $produit->getPrix());
                // $ligneAchat->setTotalLigne();
            }
            
        }
        ///initialiser l objet achat 
        $achat->setMontantTotal($total);

        ////
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($achat);
            $entityManager->flush();
            $session->set("panier",[]);
            $this->addFlash("info","Merci d'avoir effectué votre achat. Vous serez servie dans le delai.");

            $mail= (new Email())
            ->from('info@finasarl.com')
            ->to($user->getEmail())
            ->text('Merci pour votre achat');
            try{
                $mailer->send($mail);
            }catch(TransportException $e){
                $this->addFlash("danger","Une erreur s'est produite.");
            }
            return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('achat/new.html.twig', [
            'mobileMoneys' => $mobileMoneys,
            'total' => $total,
            'dataPanier' => $dataPanier,
            'achat' => $achat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_achat_show', methods: ['GET'])]
    public function show(Achat $achat): Response
    {
        return $this->render('achat/show.html.twig', [
            'achat' => $achat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_achat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Achat $achat, AchatRepository $achatRepository): Response
    {
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $achatRepository->save($achat, true);

            return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('achat/edit.html.twig', [
            'achat' => $achat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_achat_delete', methods: ['POST'])]
    public function delete(Request $request, Achat $achat, AchatRepository $achatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$achat->getId(), $request->request->get('_token'))) {
            $achatRepository->remove($achat, true);
        }

        return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
    }
}
