<?php

namespace App\Controller\Admin;

use App\Entity\Auteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Auteur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('noms'),
            TextEditorField::new('biographie'),
            DateField::new('dateNaissance'),
            TextField::new('adresse'),
            TextField::new('codePostal'),
            TextField::new('email'),
            TextField::new('telephone'),
            ImageField::new('photo')->setBasePath('uploads/images/')->setUploadDir('public/uploads/images/'),
           
        ];
    }
    
}
