<?php

// Espace de noms pour les services de l'application
namespace App\Service;

// Importation des classes et interfaces nécessaires
use App\Entity\Commande;
use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

// Classe de service pour l'envoi de mails
class MailService
{
    // Propriété privée pour stocker l'interface de mailer
    private $mailer;

    // Propriété privée pour stocker l'environnement Twig
    private $twig;

    // Constructeur pour initialiser les propriétés
    public function __construct(MailerInterface $mailer, Environment $twig){
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    // Méthode pour envoyer un mail de contact
    public function sendMailContact(string $emailpros ,string $emailclient, string $Nom,string $template,array $parameters){
        
        // Création d'un objet Email
        $email = (new Email())
        ->from($emailpros) // Définition de l'expéditeur
        ->to($emailclient) // Définition du destinataire
        ->subject($Nom) // Définition du sujet
        ->html( // Définition du contenu HTML
            $this->twig->render($template, $parameters) // Rendu du template Twig
        );

        // Envoi de l'email
        $this->mailer->send($email);
    }

    // Méthode pour envoyer un mail de commande
    public function sendMailCommande(string $emailpros,User  $user,string $subject,
    string $template,array $parameters){
        
        // Création d'un objet Email
        $email = (new Email())
        ->from($emailpros) // Définition de l'expéditeur
        ->to($user->getEmail()) // Définition du destinataire
        ->subject($subject) // Définition du sujet
        ->html( // Définition du contenu HTML
            $this->twig->render($template, $parameters) // Rendu du template Twig
        );

        // Envoi de l'email
        $this->mailer->send($email);
    }
}