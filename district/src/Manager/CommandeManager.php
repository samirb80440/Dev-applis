<?php

// Espace de noms pour les gestionnaires de l'application
namespace App\Manager;

// Importation des classes et interfaces nécessaires
use App\Entity\Commande;
use App\Event\CommandeEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

// Classe de gestionnaire pour les commandes
class CommandeManager
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

    // Méthode pour enregistrer une commande
    public function setCommande($commande)
    {
        // Vérification si l'objet passé est une instance de Commande
        if ($commande instanceof Commande) {
            // Persistance de la commande dans la base de données
            $this->em->persist($commande);
            // Flush pour sauvegarder les modifications
            $this->em->flush();
            // Création d'un événement de commande
            $event = new CommandeEvent($commande);
            // Dispatch de l'événement pour déclencher les actions associées
            $this->eventDispatcherInterface->dispatch($event);
        }
    }

    // Méthode pour envoyer un email de commande (commentée)
    // public function setMail($commande){
    //     // Vérification si l'objet passé est une instance de Commande
    //     if($commande instanceof Commande){
    //         // Création d'un événement de commande
    //         $event = new CommandeEvent($commande);
    //         // Dispatch de l'événement pour déclencher les actions associées
    //         $this->eventDispatcherInterface->dispatch($event);
    //     }
    // }
}
