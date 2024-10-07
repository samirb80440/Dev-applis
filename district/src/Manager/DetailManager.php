<?php

// Espace de noms pour les gestionnaires de l'application
namespace App\Manager;

// Importation des classes et interfaces nécessaires
use App\Entity\Detail;
use Doctrine\ORM\EntityManagerInterface;

// Classe de gestionnaire pour les détails
class DetailManager
{
    // Propriété privée pour stocker l'interface de gestion d'entités
    private $em;

    // Constructeur pour initialiser la propriété
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Méthode pour enregistrer un détail
    public function setDetail($Detail)
    {
        // Vérification si l'objet passé est une instance de Detail
        if ($Detail instanceof Detail) {
            // Persistance du détail dans la base de données
            $this->em->persist($Detail);
            // Flush pour sauvegarder les modifications
            $this->em->flush();
        }
    }
}
