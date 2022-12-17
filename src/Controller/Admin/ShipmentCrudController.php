<?php

namespace App\Controller\Admin;

use App\Entity\Shipment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ShipmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Shipment::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
