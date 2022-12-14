<?php

namespace App\EventSubscriber;

use App\Repository\ParametreRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{


    public function __construct(
        private Environment $twig,
        private ParametreRepository $parametreRepository,
        private UrlGeneratorInterface $urlGenerator
    ) {
    }
    public function onKernelController(ControllerEvent $event): void
    {
        $parametre=$this->parametreRepository->findOneBy([],[]);
        if(null===$parametre){
            // dd("Le systeme devrait d'abord etre initialisé....");
        }
        $this->twig->addGlobal('parametre',$parametre);
    }


    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
