<?php

// Espace de noms pour les événements de l'application
namespace App\Event;

// Importation des classes et interfaces nécessaires
use App\Entity\Commande;
use Symfony\Contracts\EventDispatcher\Event;

// Classe d'événement pour les commandes
class CommandeEvent extends Event
{
    // Constante pour le chemin du template d'email de commande
    const TEMPLATE_COMMANDE = "email/commandemail.html.twig";

    // Propriété privée pour stocker l'objet Commande
    private $commande;

    // Constructeur pour initialiser l'objet Commande
    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    // Méthode pour récupérer l'objet Commande
    public function getCommande(): Commande
    {
        return $this->commande;
    }
}
