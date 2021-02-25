<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Etat;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Form\CancelSortieType;
use App\Form\SearchFormluraireType;
use App\Form\SortieType;
use App\Repository\EtatRepository;
use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use ContainerEfB3UxC\getSortieControllerService;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

        $data = $sortieRepository->recherche($datas, $id, $date);
//        dd($data);
        $dataFilter = $paginator->paginate(
            $data,
            $rq->query->getInt('page', 1),
            5
        );

        $inscrit = false;




        return $this->render('sortie/index.html.twig', [
            'participant' => $participant,
            'sorties' => $dataFilter,
            'rechercheForm' => $rechercheForm->createView(),
            'inscrit' => $inscrit,
            'date' => $date
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
        $organisateur = $this->getUser();

        $sortieForm->handleRequest($rq);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
//            dd($sortieForm);
            $sortie->setOrganisateur($organisateur);
            $sortie->setNom($sortieForm->get('nom')->getData());
            $sortie->setDateHeureDebut($sortieForm->get('dateHeureDebut')->getData());
            $sortie->setDuree($sortieForm->get('duree')->getData());
            $sortie->setDateLimiteInscription($sortieForm->get('dateLimiteInscription')->getData());
            $sortie->setNbInscriptionMax($sortieForm->get('nbInscriptionMax')->getData());
            $sortie->setInfosSortie($sortieForm->get('infosSortie')->getData());
            $sortie->setCampus($sortieForm->get('campus')->getData());
            $sortie->setVille($sortieForm->get('ville')->getData());
            $sortie->setLieu($sortieForm->get('lieu')->getData());

            if ($sortieForm->get('enregistrer')->isClicked()) {
                $sortie->setEtat($em->find(Etat::class, 91));
//                dd($sortie);
            } elseif ($sortieForm->get('publier')->isClicked()) {
                $sortie->setEtat($em->find(Etat::class, 92));
            } else {
                return $this->redirectToRoute('home');
            }

            $em->persist($sortie);
            $em->flush();
            return $this->redirectToRoute('home');

        }


        return $this->render('sortie/addSortie.html.twig', [
            'controller_name' => 'SortieController',
            'participant' => $organisateur,
            'sortieForm' => $sortieForm->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param SortieRepository $sortieRepository
     * @Route("/showSortie/{id}", name="showSortie")
     */
    public function showSortie(Request $request, SortieRepository $sortieRepository)
    {
        $id = $request->get('id');
        $sortie = new Sortie();
        $sortie = $sortieRepository->find($id);


        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);


        return $this->render('sortie/showSortie.html.twig', [
            'sortie' => $sortie,
            'sortieForm' => $sortieForm->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param SortieRepository $sortieRepository
     * @Route("/modifySortie/{id}", name="modifySortie")
     */
    public function modifySortie(ParticipantRepository $repository, Request $rq, EntityManagerInterface $em, SortieRepository $sortieRepository): Response
    {

        $id = $rq->get('id');
        $sortie = $sortieRepository->find($id);

        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $organisateur = $this->getUser();

        $sortieForm->handleRequest($rq);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            $sortie->setOrganisateur($organisateur);
            $sortie->setNom($sortieForm->get('nom')->getData());
            $sortie->setDateHeureDebut($sortieForm->get('dateHeureDebut')->getData());
            $sortie->setDuree($sortieForm->get('duree')->getData());
            $sortie->setDateLimiteInscription($sortieForm->get('dateLimiteInscription')->getData());
            $sortie->setNbInscriptionMax($sortieForm->get('nbInscriptionMax')->getData());
            $sortie->setInfosSortie($sortieForm->get('infosSortie')->getData());
            $sortie->setCampus($sortieForm->get('campus')->getData());
            $sortie->setVille($sortieForm->get('ville')->getData());
            $sortie->setLieu($sortieForm->get('lieu')->getData());

            if ($sortieForm->get('enregistrer')->isClicked()) {
                $sortie->setEtat($em->find(Etat::class, 91));
//                dd($sortie);
            } elseif ($sortieForm->get('publier')->isClicked()) {
                $sortie->setEtat($em->find(Etat::class, 92));
            } elseif ($sortieForm->get('supprimer')->isClicked()) {

//                $em->remove($sortie);
//                $em->flush();
//                dd($this);
                return $this->redirectToRoute('cancelSortie', [
                    'id' => $id
                ]);

            } else {
                return $this->redirectToRoute('home');
            }
            $em->persist($sortie);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('sortie/modifySortie.html.twig', [
            'controller_name' => 'SortieController',
            'participant' => $organisateur,
            'sortieForm' => $sortieForm->createView(),
            'sortie' => $sortie
        ]);
    }


    /**
     * @param EntityManagerInterface $em
     * @param SortieRepository $sortieRepository
     * @param ParticipantRepository $participantRepository
     * @param $id
     * @Route("/inscription/{id}", name="inscription", requirements={"id": "\d+"})
     */
    public function Inscription(EntityManagerInterface $em, SortieRepository $sortieRepository, ParticipantRepository $participantRepository, $id)
    {

        $idUtilisateur = $this->getUser()->getId();

        $sortie = $sortieRepository->find($id);
        $participant = $participantRepository->find($idUtilisateur);
        $role = $this->getUser()->getRoles();

//        dd($participant);
//        dd($sortie);

        // Les controles pour l'inscription

        //La date limite
        $dateLimite = $sortie->getDateLimiteInscription();
        if ($dateLimite < new DateTime()) {
            $this->addFlash('error', "Les inscriptions sont closes");
            return $this->redirectToRoute('home');
        }

        //Place limite
        $nbrePlaces = $sortie->getNbInscriptionMax();
        $nbreInscris = count($sortie->getParticipants());
        if ($nbreInscris >= $nbrePlaces) {
            $this->addFlash('error', "Il n'y a plus de place disponible");
            return $this->redirectToRoute('home');
        }

        // Etat hors ouverte
        $etat = $sortie->getEtat()->getId();
        if ($etat = !92) {
            $this->addFlash('error', "Les inscriptions ne sont pas ouverts");
            return $this->redirectToRoute('home');
        }


        $nbreParticipant = count($sortie->getParticipants());

        $sortie->addParticipant($participant);

        $em->persist($sortie);
        $em->flush();

        return $this->redirectToRoute('home');

    }

    /**
     * @param EntityManagerInterface $em
     * @param SortieRepository $sortieRepository
     * @param ParticipantRepository $participantRepository
     * @param $id
     * @return RedirectResponse
     * @Route("/desister/{id}", name="desister", requirements={"id": "\d+"})
     */
    public function Desister(EntityManagerInterface $em, SortieRepository $sortieRepository, ParticipantRepository $participantRepository, $id)
    {

        $idUtilisateur = $this->getUser()->getId();

        $sortie = $sortieRepository->find($id);
        $participant = $participantRepository->find($idUtilisateur);

//        dd($participant);
//        dd($sortie);

        $nbrePlaces = $sortie->getNbInscriptionMax();
        $nbreParticipant = count($sortie->getParticipants());

        if ($sortie->getEtat()->getId() == 94) {
            $this->addFlash('error', "La sortie est en cours, vous ne pouvez pas vous désister");
            return $this->redirectToRoute('home');
        }

        $sortie->deleteParticipant($participant);
        $em->flush();

        return $this->redirectToRoute('home');

    }

    /**
     * @param EntityManagerInterface $em
     * @param Request $rq
     * @param EtatRepository $etatRepository
     * @return RedirectResponse|Response
     * @Route("cancelSortie/{id}", name="cancelSortie")
     */
    public function deleteSortie(EntityManagerInterface $em, Request $rq, EtatRepository $etatRepository)
    {

        $id = $rq->get('id');
        $sortie = $em->find(Sortie::class, $id);

        $idUser = $this->getUser()->getId();
        $idOrganisateur = $sortie->getOrganisateur()->getId();
        $role = $this->getUser()->getRoles();
        $roleUser = $role[0];

        $infoSortie = $sortie->getInfosSortie();

        $sortieNew = new Sortie();
        //Formulaire annulation
        $form = $this->createForm(CancelSortieType::class, $sortieNew);
        $form->handleRequest($rq);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoSortieCancel = $sortieNew->getInfosSortie();
            $infoSortieNew = $infoSortieCancel;

            $sortie->setInfosSortie($infoSortieCancel);
            $etat = new Etat();
            $etat = $etatRepository->find(96);
            $sortie->setEtat($etat);

            $em->persist($sortie);
            $em->flush();

            return $this->redirectToRoute('home');
        }
//        else {
//            return $this->redirectToRoute('home');
//        }

        return $this->render('sortie/cancelSortie.html.twig', [
            "sortie" => $sortie,
            "cancelForm" => $form->createView()
        ]);
    }


}
