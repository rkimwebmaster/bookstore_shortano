<?php

namespace App\Controller\Admin;

use App\Entity\Parametre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;

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
            TelephoneField::new('telephone'),
            EmailField::new('email'),
            UrlField::new('facebook'),
            UrlField::new('twitter'),
            UrlField::new('instagramme'),
            UrlField::new('website'),
            // FormField::addTab('Parametres Auteur'),
            // AssociationField::new('auteur')->renderAsEmbeddedForm(
            //     AuteurCrudController::class,
            //     'create_category_inside_an_article',
            //     'edit_category_inside_an_article'
            // ),
            // FormField::addTab('Parametres Livres '),
            // AssociationField::new('livre')->renderAsEmbeddedForm(),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }
}
