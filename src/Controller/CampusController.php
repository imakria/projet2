<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Form\CampusFormType;
use App\Repository\CampusRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{
    /**
     * @Route("/campus", name="campus")
     * @param EntityManagerInterface $em
     * @param CampusRepository $campusRepository
     * @param Request $rq
     * @return Response
     */
    public function allCampus(EntityManagerInterface $em, CampusRepository $campusRepository, Request $rq): Response
    {

        $campus = new Campus();
        $campuses = $campusRepository->findAll();
        $formCampus = $this->createForm(CampusFormType::class, $campus);
        $formCampus->handleRequest($rq);

        if ($formCampus->isSubmitted() && $formCampus->isValid()) {

            $em->persist($campus);
            $em->flush();

            return $this->redirectToRoute('campus');
        }


        return $this->render('campus/campus.html.twig', [
            'controller_name' => 'VilleController',
            'campuses' => $campuses,
            'campusForm' => $formCampus->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param CampusRepository $campusRepository
     * @return RedirectResponse
     * @Route("/deleteCampus/{id}", name="deleteCampus")
     */
    public function deleteCampus(Request $request, EntityManagerInterface $em, CampusRepository $campusRepository)
    {
        $id = $request->get('id');
        $campus = $campusRepository->find($id);
        $em->remove($campus);
        $em->flush();

        return $this->redirectToRoute('campus');
    }


    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param CampusRepository $campusRepository
     * @param $id
     * @Route("/modifyCampus/{id}", name="modifyCampus")
     */
    public function modifyCampus(Request $request, EntityManagerInterface $em, CampusRepository $campusRepository, $id)
    {
        $id = $request->get('id');
        $campus = $campusRepository->find($id);

        $nom = $campus->getNom();


//        $ville = $villeRepository->find($id);
//        $em->remove($ville);
//        $em->flush();
//
//        return $this->redirectToRoute('ville');
    }
}
