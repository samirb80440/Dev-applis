<?php

// Espace de noms pour la sécurité de l'application
namespace App\Security;

// Importation des classes et interfaces nécessaires
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

// Classe d'authentification pour les formulaires de connexion
class UserFormAuthenticator extends AbstractLoginFormAuthenticator
{
    // Utilisation du trait pour gérer les chemins de redirection
    use TargetPathTrait;

    // Constante pour la route de connexion
    public const LOGIN_ROUTE = 'app_login';

    // Constructeur pour initialiser l'interface de génération d'URL
    public function __construct(private UrlGeneratorInterface $urlGenerator) {}

    // Méthode pour authentifier l'utilisateur
    public function authenticate(Request $request): Passport
    {
        // Récupération de l'adresse email de l'utilisateur
        $email = $request->getPayload()->getString('email');

        // Enregistrement de l'adresse email dans la session
        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        // Création d'un passeport pour l'authentification
        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->getPayload()->getString('password')),
            [
                new CsrfTokenBadge('authenticate', $request->getPayload()->getString('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    // Méthode pour gérer la réussite de l'authentification
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Vérification si un chemin de redirection est défini
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            // Redirection vers le chemin défini
            return new RedirectResponse($targetPath);
        }

        // Redirection vers la page d'accueil par défaut
        // For example:
        // return new RedirectResponse($this->urlGenerator->generate('some_route'));
        return new RedirectResponse($this->urlGenerator->generate('app_index'));
    }

    // Méthode pour récupérer l'URL de connexion
    protected function getLoginUrl(Request $request): string
    {
        // Génération de l'URL de connexion
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
