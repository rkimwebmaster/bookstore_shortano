<?php

namespace App\Controller\Admin;

use App\Entity\Parametre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class ParametreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Parametre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Parametres Généraux'),
            IdField::new('id')->hideOnForm(),
            TextField::new('adresse'),
            TextField::new('telephone'),
            TextField::new('email'),
            TextField::new('facebook'),
            TextField::new('twitter'),
            TextField::new('instagramme'),
            UrlField::new('website'),
            MoneyField::new('monnaie')->setCurrency("USD"),
            // AssociationField::new('auteur')->useEntryCrudForm(ChapitreCrudController::class),
            // AssociationField::new('auteur')->renderAsEmbeddedForm(),
            // yield AssociationField::new('...')->renderAsEmbeddedForm(CategoryCrudController::class);

            // the other optional arguments are the page names passed to the configureFields()
            // method of the CRUD controller (this allows you to have a better control of
            // the fields displayed on different scenarios)
            FormField::addTab('Parametres Auteur'),
            AssociationField::new('auteur')->renderAsEmbeddedForm(
                AuteurCrudController::class,
                'create_category_inside_an_article',
                'edit_category_inside_an_article'
            ),
            // yield AssociationField::new('...')->renderAsEmbeddedForm();
            FormField::addTab('Parametres Livres '),
            AssociationField::new('livre')->renderAsEmbeddedForm(),
            // AssociationField::new('livre')->setCrudController(LivreCrudController::class),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }
}
