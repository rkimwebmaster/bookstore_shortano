<?php

namespace App\Controller\Admin;

use App\Entity\PrivacyPage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PrivacyPageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PrivacyPage::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            // TextField::new('title'),
            TextEditorField::new('contenu'),
        ];
    }
    
}
