<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'cart_index')]
    public function index(SessionInterface $session, LivreRepository $livreRepository): Response
    {
        $panier=$session->get('panier',[]);
        $dataPanier=[];
        $prixTotalPanier=0;
        $quantiteProduits=0;
        foreach($panier as $id=>$quantite){
            $produit=$livreRepository->find($id);
            if($produit){
                $dataPanier[]=[
                    'produit'=>$produit,
                    'quantite'=>$quantite,
                ];
                $prixTotalPanier +=$produit->getPrix() * $quantite;
                $quantiteProduits +=$quantite;
    
            }
        }
        return $this->redirectToRoute('app_achat_new', [], Response::HTTP_SEE_OTHER);
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
        ]);
    }
}
