<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('sousTitre'),
            DateField::new('dateParution'),
            IntegerField::new('nombreCopieVendues'),
            IntegerField::new('nombreCopieImprimees'),
            IntegerField::new('nombreTasseCafes'),
            IntegerField::new('nombreLecteurSatisfaits'),
            MoneyField::new('prix')->setCurrency("USD"),
            ImageField::new('imagePrincipale')->setBasePath('uploads/images/')->setUploadDir('public/uploads/images/'),
            ImageField::new('imageSecondaire')->setBasePath('uploads/images/')->setUploadDir('public/uploads/images/'),
            TextField::new('APropos'),
            CollectionField::new('chapitres')->useEntryCrudForm(ChapitreCrudController::class),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }

}
