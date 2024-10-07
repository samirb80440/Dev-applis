<?php

// Espace de noms pour les événements de l'application
namespace App\Event;

// Importation des classes et interfaces nécessaires
use App\Entity\Contact;
use Symfony\Contracts\EventDispatcher\Event;

// Classe d'événement pour les contacts
class ContactEvent extends Event
{
    // Constante pour le chemin du template d'email de contact
    const TEMPLATE_Contact = "email/contactemail.html.twig";

    // Propriété privée pour stocker l'objet Contact
    private $Contact;

    // Constructeur pour initialiser l'objet Contact
    public function __construct(Contact $Contact)
    {
        $this->Contact = $Contact;
    }

    // Méthode pour récupérer l'objet Contact
    public function getContact(): Contact
    {
        return $this->Contact;
    }
}
