<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Form\SearchFormluraireType;
use App\Form\SortieType;
use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PaginatorInterface $paginator
     * @param ParticipantRepository $repository
     * @param Request $rq
     * @param SortieRepository $sortieRepository
     * @return Response
     */
    public function index(PaginatorInterface $paginator, ParticipantRepository $repository, Request $rq, SortieRepository $sortieRepository): Response
    {

        $participant = $this->getUser();


        $datas = new SearchData();


        $rechercheForm = $this->createForm(SearchFormluraireType::class, $datas);
        $rechercheForm->handleRequest($rq);

        $date = (new \DateTime('now'));
        $id = $this->getUser()->getId();

        dump($rechercheForm);
        dump($datas);
        dump($id);

        $data = $sortieRepository->recherche($datas, $id, $date);
        $dataFilter = $paginator->paginate(
            $data,
            $rq->query->getInt('page', 1),
            5
        );


        return $this->render('sortie/index.html.twig', [
            'controller_name' => 'SortieController',
            'participant' => $participant,
            'sorties' => $dataFilter,
            'rechercheForm' => $rechercheForm->createView()
        ]);
    }

    /**
     * @Route("/addSortie", name="addSortie")
     * @param ParticipantRepository $repository
     * @param Request $rq
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function addSortie(ParticipantRepository $repository, Request $rq, EntityManagerInterface $em): Response
    {
        $sortie = new Sortie();
        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $participantConnected = $this->getUser();

        $sortieForm->handleRequest($rq);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            $sortie->setNom($sortieForm->get('nom')->getData());
            $sortie->setDateHeureDebut($sortieForm->get('dateHeureDebut')->getData());
            $sortie->setDuree($sortieForm->get('duree')->getData());
            $sortie->setDateLimiteInscription($sortieForm->get('dateLimiteInscription')->getData());
            $sortie->setNbInscriptionMax($sortieForm->get('nbInscriptionMax')->getData());
            $sortie->setInfosSortie($sortieForm->get('infosSortie')->getData());
            $sortie->setCampus($sortieForm->get('campus')->getData());
            $sortie->setVille($sortieForm->get('ville')->getData());
            $sortie->setLieu($sortieForm->get('lieu')->getData());
            $em->persist($sortie);
            $em->flush();
            return $this->redirectToRoute('home');

        }


        return $this->render('sortie/addSortie.html.twig', [
            'controller_name' => 'SortieController',
            'participant' => $participantConnected,
            'sortieForm' => $sortieForm->createView(),
        ]);
    }


}
