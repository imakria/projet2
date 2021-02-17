<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends AbstractController
{
    /**
     * //     * @IsGranted("ROLE_ADMIN")
     * @Route("/ville", name="ville")
     * @param Request $request
     * @param VilleRepository $villeRepository
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function allCities(Request $request, VilleRepository $villeRepository, EntityManagerInterface $em): Response
    {

        $ville = new Ville();
        $villes = $villeRepository->findAll();



        return $this->render('ville/ville.html.twig', [
            'controller_name' => 'VilleController',
        ]);
    }
}
