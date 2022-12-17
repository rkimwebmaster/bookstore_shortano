<?php

namespace App\Controller;

use App\Repository\PrivacyPageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrivacyPageController extends AbstractController
{
    #[Route('/privacy/page', name: 'app_privacy_page')]
    public function index(PrivacyPageRepository $privacyPageRepository): Response
    {
        $page=$privacyPageRepository->findOneBy([],[]);
        return $this->render('privacy_page/index.html.twig', [
            'page' => $page,
        ]);
    }
}
