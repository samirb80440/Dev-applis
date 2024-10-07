<?php

// Espace de noms pour les abonnés d'événements de l'application
namespace App\EventSubscriber;

// Importation des classes et interfaces nécessaires
use App\Event\CommandeEvent;
use App\Event\ContactEvent;
use App\Service\MailService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

// Classe d'abonné d'événements pour les emails
class MailingSubscriber implements EventSubscriberInterface
{
    // Propriété privée pour stocker le service d'envoi d'emails
    private $mailservice;

    // Constructeur pour initialiser le service d'envoi d'emails
    public function __construct(MailService $mailservice)
    {
        $this->mailservice = $mailservice;
    }

    // Méthode pour envoyer un email lors d'un événement de commande
    public function SendMailEventCommande(CommandeEvent $event)
    {
        // Récupération de l'objet Commande associé à l'événement
        $commande = $event->getCommande();

        // Définition des paramètres pour l'email
        $parameters = [
            "user" => $commande->getUser(),
            "commande" => $commande,
            "details" => $commande->getDetails(),
            "datejour" => date("d-m-Y"),
            "dateheure" => date("H:m"),
            "datelivraison" => date('H:i:s', strtotime('+30 minutes', strtotime(date('H:i:s'))))
        ];

        // Envoi de l'email de commande
        $this->mailservice->sendMailCommande(
            'District_@gmail.com',
            $commande->getUser(),
            'Commande N°' . $commande->getId(),
            CommandeEvent::TEMPLATE_COMMANDE,
            $parameters
        );
    }

    // Méthode pour envoyer un email lors d'un événement de contact
    public function SendMailEventContact(ContactEvent $event)
    {
        // Récupération de l'objet Contact associé à l'événement
        $contact = $event->getContact();

        // Définition des paramètres pour l'email
        $parameters = [
            "contact" => $contact,
            "Demande" => $contact->getDemande(),
        ];

        // Envoi de l'email de contact
        $this->mailservice->sendMailContact(
            'random@gmail.com',
            $contact->getEmail(),
            $contact->getNom(),
            ContactEvent::TEMPLATE_Contact,
            $parameters
        );
    }

    // Méthode pour définir les événements auxquels l'abonné est inscrit
    public static function getSubscribedEvents(): array
    {
        return [
            CommandeEvent::class => [
                ['SendMailEventCommande', 1]
            ],
            ContactEvent::class => [
                ['SendMailEventContact', 2]
            ]
        ];
    }
}
