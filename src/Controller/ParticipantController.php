<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ProfilType;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/participant", name="participant")
     */
    public function index(): Response
    {
        return $this->render('participant/index.html.twig', [
            'controller_name' => 'ParticipantController',
        ]);
    }

    /**
     * @Route("/myProfile/", name="myProfile")
     * @param EntityManagerInterface $em
     * @param Request $rq
     * @param SluggerInterface $slugger
     * @param ParticipantRepository $repository
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function myProfile(EntityManagerInterface $em, Request $rq, SluggerInterface $slugger, ParticipantRepository $repository, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $participant = new Participant();
        $participantForm = $this->createForm(ProfilType::class, $participant);
        $participantConnected = $this->getUser();

        $participant = $participantConnected;

        $repository->findByPseudo($participant);
//        $participantDetails->setAdministrateur(false);
//        $participantDetails->setActif(true);
//
        $participantForm->handleRequest($rq);
        if($participantForm->isSubmitted() && $participantForm->isValid())
        {
            /** @var UploadedFile $file */
            $file = $participantForm->get('picture')->getData();
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('uploads_dir'),
                    $newFilename
                );
                $participantConnected->setPicture($newFilename);

                $participantConnected->setPseudo($participantForm->get('pseudo')->getData());
                $participantConnected->setNom($participantForm->get('nom')->getData());
                $participantConnected->setPrenom($participantForm->get('prenom')->getData());
                $participantConnected->setTelephone($participantForm->get('telephone')->getData());
                $participantConnected->setMail($participantForm->get('mail')->getData());
                $participantConnected->setMotPasse($passwordEncoder->encodePassword($participant, $participantForm->get('motPasse')->getData()));
                $participantConnected->setCampus($participantForm->get('campus')->getData());
            }
            $em->persist($participantConnected);
            $em->flush();
            $this->addFlash('success', 'Added successfully');
            return $this->redirectToRoute('home');
        }

        return $this->render('participant/myProfile.html.twig', [
//            'participantDetails' => $participantDetails,
            'participantForm' => $participantForm->createView(),
            'participantConnected' => $participantConnected,
        ]);
    }
}
