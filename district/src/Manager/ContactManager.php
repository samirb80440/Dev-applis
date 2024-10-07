<?php

// Espace de noms pour les gestionnaires de l'application
namespace App\Manager;

// Importation des classes et interfaces nécessaires
use App\Entity\Contact;
use App\Event\ContactEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

// Classe de gestionnaire pour les contacts
class ContactManager
{
    // Propriété privée pour stocker l'interface de gestion d'entités
    private $em;

    // Propriété privée pour stocker l'interface de dispatch d'événements
    private $eventDispatcherInterface;

    // Constructeur pour initialiser les propriétés
    public function __construct(EntityManagerInterface $em, EventDispatcherInterface $eventDispatcherInterface)
    {
        $this->em = $em;
        $this->eventDispatcherInterface = $eventDispatcherInterface;
    }

    // Méthode pour enregistrer un contact
    public function setContact($Contact)
    {
        // Vérification si l'objet passé est une instance de Contact
        if ($Contact instanceof Contact) {
            // Persistance du contact dans la base de données
            $this->em->persist($Contact);
            // Flush pour sauvegarder les modifications
            $this->em->flush();
            // Création d'un événement de contact
            $event = new ContactEvent($Contact);
            // Dispatch de l'événement pour déclencher les actions associées
            $this->eventDispatcherInterface->dispatch($event);
        }
    }
}
