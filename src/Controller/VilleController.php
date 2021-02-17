<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleFormType;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends AbstractController
{
    /**
     * @Route("/ville", name="ville")
     * @param Request $request
     * @param VilleRepository $villeRepository
     * @param EntityManagerInterface $em
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function allCities(Request $request, VilleRepository $villeRepository, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {

        $ville = new Ville();
        $villes = $villeRepository->findAll();

        $formVille = $this->createForm(VilleFormType::class, $ville);
        $formVille->handleRequest($request);

        if ($formVille->isSubmitted() && $formVille->isValid()) {

            $em->persist($ville);
            $em->flush();

            return $this->redirectToRoute('ville');
        }


        return $this->render('ville/ville.html.twig', [
            'controller_name' => 'VilleController',
            'villeForm' => $formVille->createView(),
            'villes' => $villes
        ]);
    }


    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param VilleRepository $villeRepository
     * @Route("/deleteCity/{id}", name="deleteCity")
     */
    public function deleteCitie(Request $request, EntityManagerInterface $em, VilleRepository $villeRepository)
    {
        $id = $request->get('id');
        $ville = $villeRepository->find($id);
        $em->remove($ville);
        $em->flush();

        return $this->redirectToRoute('ville');
    }


    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param VilleRepository $villeRepository
     * @Route("/modifyCity/{id}", name="modifyCity")
     */
    public function modifyCity(Request $request, EntityManagerInterface $em, VilleRepository $villeRepository, $id)
    {
        $id = $request->get('id');
        $ville = $villeRepository->find($id);

        $nom = $ville->getNom();
        $codePostal = $ville->getCodePostal();


//        $ville = $villeRepository->find($id);
//        $em->remove($ville);
//        $em->flush();
//
//        return $this->redirectToRoute('ville');
    }

}
