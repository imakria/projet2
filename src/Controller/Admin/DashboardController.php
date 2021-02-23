<?php

namespace App\Controller\Admin;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\Lieu;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Entity\Ville;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(ParticipantCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SortirCom');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('DashBoard', 'fa fa-home');
        yield MenuItem::section('Admin');
        yield MenuItem::linkToCrud('Participants', 'fa fa-home', Participant::class);
        yield MenuItem::linkToCrud('Sorties', 'fa fa-home', Sortie::class);
        yield MenuItem::linkToCrud('Campus', 'fa fa-home', Campus::class);
        yield MenuItem::linkToCrud('Villes', 'fa fa-home', Ville::class);
        yield MenuItem::linkToCrud('Lieux', 'fa fa-home', Lieu::class);
        yield MenuItem::linkToCrud('Etats', 'fa fa-home', Etat::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
