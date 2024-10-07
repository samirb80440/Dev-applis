<?php

// Espace de noms pour les services de l'application
namespace App\Service;

// Importation des classes et interfaces nécessaires
use App\Entity\Commande;
use App\Entity\Plat;
use App\Entity\User;
use App\Repository\PlatRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

// Classe de service pour la gestion du panier
class PanierService
{
    // Propriété privée pour stocker la pile de requêtes
    private $requestStack;

    // Propriété privée pour stocker le repository de plats
    private $platRepository;

    // Constructeur pour initialiser les propriétés
    public function __construct(RequestStack $requestStack, PlatRepository $platRepository)
    {
        $this->requestStack = $requestStack;
        $this->platRepository = $platRepository;
    }

    // Méthode pour afficher le contenu du panier
    public function showPanier(): array
    {
        // Récupération de la session
        $session = $this->requestStack->getSession();

        // Récupération du panier
        return $session->get('panier', []);
    }

    // Méthode pour afficher les données du panier
    public function showDataPanier(): array
    {
        // Récupération du panier
        $panier = $this->showPanier();
        $dataPanier = [];

        // Boucle pour parcourir les plats du panier
        foreach ($panier as $id => $quantite) {
            // Récupération du plat
            $plat = $this->platRepository->find($id);
            if ($plat) {
                // Ajout du plat au tableau de données
                $dataPanier[] = [
                    "plat" => $plat,
                    "quantite" => $quantite
                ];
            }
        }

        // Retour du tableau de données
        return $dataPanier;
    }

    // Méthode pour calculer le total du panier
    public function getTotal(): int
    {
        // Récupération du panier
        $panier = $this->showPanier();
        $total = 0;

        // Boucle pour parcourir les plats du panier
        foreach ($panier as $id => $quantite) {
            // Récupération du plat
            $plat = $this->platRepository->find($id);
            if ($plat) {
                // Ajout du prix du plat au total
                $total += $plat->getPrix() * $quantite;
            }
        }

        // Retour du total
        return $total;
    }

    // Méthode pour ajouter un plat au panier
    public function addOneDish(Plat $plat): void
    {
        // Récupération de la session
        $session = $this->requestStack->getSession();
        // Récupération du panier
        $panier = $session->get('panier', []);
        // Récupération de l'ID du plat
        $id = $plat->getId();

        // Vérification si le plat est déjà dans le panier
        if (!empty($panier[$id])) {
            // Incrémentation de la quantité
            $panier[$id]++;
        } else {
            // Ajout du plat au panier
            $panier[$id] = 1;
        }

        // Mise à jour du panier
        $session->set('panier', $panier);
    }

    // Méthode pour retirer une quantité d'un plat du panier
    public function removeOneQuantity(Plat $plat): void
    {
        // Récupération de la session
        $session = $this->requestStack->getSession();
        // Récupération du panier
        $panier = $session->get('panier', []);
        // Récupération de l'ID du plat
        $id = $plat->getId();

        // Vérification si le plat est dans le panier
        if (!empty($panier[$id])) {
            // Vérification si la quantité est supérieure à 1
            if ($panier[$id] > 1) {
                // Décrémentation de la quantité
                $panier[$id]--;
            } else {
                // Suppression du plat du panier
                unset($panier[$id]);
            }
        }

        // Mise à jour du panier
        $session->set('panier', $panier);
    }

    // Méthode pour supprimer un plat du panier
    public function deleteOneDish(Plat $plat): void
    {
        // Récupération de la session
        $session = $this->requestStack->getSession();
        // Récupération du panier
        $panier = $session->get('panier', []);
        // Récupération de l'ID du plat
        $id = $plat->getId();

        // Vérification si le plat est dans le panier
        if (!empty($panier[$id])) {
            // Suppression du plat du panier
            unset($panier[$id]);
        }

        // Mise à jour du panier
        $session->set('panier', $panier);
    }

    // Méthode pour supprimer tous les plats du panier
    public function deleteAllDish(): void
    {
        // Récupération de la session
        $session = $this->requestStack->getSession();
        // Réinitialisation du panier
        $session->set('panier', []);
    }
}
