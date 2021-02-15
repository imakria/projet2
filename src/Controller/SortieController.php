<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param ParticipantRepository $repository
     * @param Request $rq
     * @return Response
     */
    public function index(ParticipantRepository $repository, Request $rq): Response
    {

        $participant = $this->getUser();

        return $this->render('sortie/index.html.twig', [
            'controller_name' => 'SortieController',
            'participant' => $participant,
        ]);
    }

    /**
     * @Route("/navbar", name="navbar")
     * @param ParticipantRepository $repository
     * @param Request $rq
     * @return Response
     */
    public function navbar(ParticipantRepository $repository, Request $rq): Response
    {

        $participant = $this->getUser();

        return $this->render('inc/navbar.html.twig', [
            'controller_name' => 'SortieController',
            'participant' => $participant,
        ]);
    }


}
