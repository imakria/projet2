<?php

namespace App\Controller;

use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @param FlashyNotifier $flashy
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils, FlashyNotifier $flashy): Response
    {
         if ($this->getUser()) {
//             $flashy->success('Event created!', 'http://your-awesome-link.com');
             $this->addFlash('success', $this->getUser()->getUsername());
             return $this->redirectToRoute('homeParticipant', [
                 'participant' => $this->getUser()->getUsername(),
             ]);
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
