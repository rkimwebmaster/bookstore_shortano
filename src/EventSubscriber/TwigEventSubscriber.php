<?php

namespace App\EventSubscriber;

use App\Repository\AuteurRepository;
use App\Repository\AutreLivreRepository;
use App\Repository\LivreRepository;
use App\Repository\ParametreRepository;
use App\Repository\TemoignageRepository;
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
        private LivreRepository $livreRepository,
        private AuteurRepository $auteurRepository,
        private AutreLivreRepository $autreLivreRepository,
        private TemoignageRepository $temoignageRepository,
        // private UrlGeneratorInterface $urlGenerator
    ) {
    }
    public function onKernelController(ControllerEvent $event): void
    {
        $parametre=$this->parametreRepository->findOneBy([],[]);
        $auteur=$this->auteurRepository->findOneBy([],[]);
        $livre=$this->livreRepository->findOneBy([],[]);
        $autreLivres=$this->autreLivreRepository->findAll([],[]);
        $temoignages=$this->temoignageRepository->findAll([],[]);
        if(null===$parametre){
            // dd("Le systeme devrait d'abord etre initialis√©....");
        }
        $this->twig->addGlobal('parametre',$parametre);
        $this->twig->addGlobal('auteur',$auteur);
        $this->twig->addGlobal('livre',$livre);
        $this->twig->addGlobal('autreLivres',$autreLivres);
        $this->twig->addGlobal('temoignages',$temoignages);
    }


    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
