<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Form\CampusFormType;
use App\Form\SearchCampusType;
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


        $searchForm = $this->createForm(SearchCampusType::class);
        $searchForm->handleRequest($rq);

        $campus = new Campus();
        $formCampus = $this->createForm(CampusFormType::class, $campus);
        $formCampus->handleRequest($rq);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searchInput = $searchForm->get('search')->getData();
            $searchCampus = $campusRepository->search($searchInput);

            return $this->render('campus/campus.html.twig', [
                'campuses' => $searchCampus,
                'campusForm' => $formCampus->createView(),
                'searchForm' => $searchForm->createView(),
            ]);
        }
        $campuses = $campusRepository->findAll();

        if ($formCampus->isSubmitted() && $formCampus->isValid()) {

            $em->persist($campus);
            $em->flush();

            return $this->redirectToRoute('campus');
        }


        return $this->render('campus/campus.html.twig', [
            'campuses' => $campuses,
            'campusForm' => $formCampus->createView(),
            'searchForm' => $searchForm->createView(),

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
