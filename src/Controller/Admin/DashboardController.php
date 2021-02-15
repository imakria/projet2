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
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(ParticipantCrudController::class)->generateUrl());

//        // you can also redirect to different pages depending on the current user
//        if ('jane' === $this->getUser()->getUsername()) {
//            return $this->redirect('...');
//        }
//
//        // you can also render some template to display a proper Dashboard
//        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
//        return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SortirCom');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::section('Mon Menu');
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', Participant::class);
        yield MenuItem::linkToCrud('Sorties', 'fas fa-bookmark', Sortie::class);
        yield MenuItem::linkToCrud('Campus', 'fas fa-bookmark', Campus::class);
        yield MenuItem::linkToCrud('Lieux', 'fas fa-bookmark', Lieu::class);
        yield MenuItem::linkToCrud('Villes', 'fas fa-bookmark', Ville::class);
        yield MenuItem::linkToCrud('Etat en cours', 'fas fa-bookmark', Etat::class);
    }
}
