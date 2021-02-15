<?php

namespace App\Controller\Admin;

use App\Entity\Participant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ParticipantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Participant::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('pseudo'),
            TextField::new('nom'),
            TextField::new('prenom'),
            EmailField::new('mail'),
            BooleanField::new('actif', 'Actif ?'),
            BooleanField::new('administrateur', 'Role'),
            AssociationField::new('campus')->autocomplete(),
        ];
    }

}
