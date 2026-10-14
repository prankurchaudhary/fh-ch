<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Pimcore\Model\DataObject\WebsiteUser\Listing;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\DataObject\WebsiteUser;



class LoginController extends AbstractController
{
    #[Route('/login', name: 'frontend_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        
        // get login error if any
        $error = $authenticationUtils->getLastAuthenticationError();

        // last entered username (email)
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('frontend/auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            
        ]);
    }

    #[Route('/fe_logout', name: 'frontend_logout')]
    public function logout()
    {
        throw new \LogicException('Handled by firewall');
        // symfony handles logout automatically
    }

    #[Route('/ajax/login', name: 'ajax_login', methods: ['POST'])]
    public function ajaxLogin(Request $request): JsonResponse
    {
        // This route is handled by the firewall
        // If authentication fails → Symfony returns 401
        // If success → we reach here

        return new JsonResponse([
            'success' => true
        ]);
    }

    

}
