<?php

namespace App\Controller\Admin;

use App\Entity\AutreLivre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AutreLivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AutreLivre::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('categorie'),
            ImageField::new('image')->setBasePath('uploads/images/')->setUploadDir('public/uploads/images/'),
        ];
    }
    
}
