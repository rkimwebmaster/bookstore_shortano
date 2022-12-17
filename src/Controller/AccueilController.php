<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(Request $request): Response
    {
        $id=$request->get('page');
        if($id==1){
            return $this->render('accueil/accueil.html.twig', [
                'controller_name' => 'AccueilController',
            ]);  
        }
        if($id==2){
            return $this->render('accueil/apropos.html.twig', [
                'controller_name' => 'AccueilController',
            ]);  
        }
        if($id==3){
            return $this->render('accueil/chapitres.html.twig', [
                'controller_name' => 'AccueilController',
            ]);  
        }
        if($id==4){
            return $this->render('accueil/temoignages.html.twig', [
                'controller_name' => 'AccueilController',
            ]);  
        }
        if($id==5){
            return $this->render('accueil/meslivres.html.twig', [
                'controller_name' => 'AccueilController',
            ]);  
        }
        if($id==6){
            return $this->render('accueil/auteur.html.twig', [
                'controller_name' => 'AccueilController',
            ]);  
        }
        if($id==7){
            return $this->render('accueil/contact.html.twig', [
                'controller_name' => 'AccueilController',
            ]);  
        }
        return $this->render('accueil/accueil.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    
    #[Route('/creationContact', name: 'app_creation_contact')]
    public function creationContact(Request $request, ContactRepository $contactRepository): Response
    {
        $nom=$request->get('nom');
        $email=$request->get('email');
        $sujet=$request->get('sujet');
        $message=$request->get('message');
        $contact=new Contact($nom, $email, $sujet, $message);
        $contactRepository->save($contact, true);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
