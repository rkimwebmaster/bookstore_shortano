<?php

namespace App\Controller\Admin;

use App\Entity\Achat;
use App\Entity\Auteur;
use App\Entity\Contact;
use App\Entity\Livre;
use App\Entity\Parametre;
use App\Entity\Temoignage;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminURLGenerator $adminURL)
    {
    }
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->render('admin/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->generateRelativeUrls()
            ->setTitle('Shortano Admin');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('WebSite', 'fa fa-home'),

            MenuItem::section('Configuration', 'fa fa-search-plus'),
            MenuItem::subMenu('Parametres')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Parametre::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Parametre::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Temoignages')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Temoignage::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Temoignage::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Contact')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Contact::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Contact::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Auteur')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Auteur::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Auteur::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Livres  ')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Livre::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Livre::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Achats')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Achat::class)->setAction(Crud::PAGE_INDEX),
            ]),
            MenuItem::section('Gestion des utilisateurs'),
            MenuItem::subMenu('Utilisateurs')->setSubItems([
               MenuItem::linkToCrud('Liste ', 'fa fa-tags', User::class)->setAction(Crud::PAGE_INDEX),
               MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', User::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::section('Métiers '),
            MenuItem::subMenu('Liste des éléments ')->setSubItems([
                MenuItem::linkToCrud('Achats', 'fa fa-tags', Achat::class),
                //MenuItem::linkToCrud('Annulations', 'fa fa-tags', Annulation::class),
                MenuItem::linkToCrud('Contacts', 'fa fa-tags', Contact::class),

            ]),
            MenuItem::section('Infos entreprise'),
            //MenuItem::linkToCrud('Entreprise', 'fa fa-tags', Entreprise::class),
            // MenuItem::section('Statistiques'),
            // MenuItem::linkToCrud('Achats', 'fa fa-tags', Achat::class),
            // MenuItem::linkToCrud('Annualtion', 'fa fa-tags', Annulation::class),

            // MenuItem::linkToCrud('Blog Posts', 'fa fa-file-text', BlogPost::class),

        ];
    }
}