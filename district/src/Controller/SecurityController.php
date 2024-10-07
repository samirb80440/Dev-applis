<?php

namespace App\Controller;

// Importation des classes et interfaces nécessaires
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationFormType;
use App\Entity\User;

// Contrôleur de sécurité
class SecurityController extends AbstractController
{
    // Action de connexion
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Si l'utilisateur est déjà connecté, rediriger vers la page cible
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // Récupération de l'erreur de connexion si elle existe
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupération du dernier nom d'utilisateur saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        // Rendu du template de connexion
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    // Action de déconnexion
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Cette méthode peut être vide car elle sera interceptée par la clé de déconnexion du pare-feu
        throw new \LogicException('Cette méthode peut être vide - elle sera interceptée par la clé de déconnexion du pare-feu.');
    }
}
