<?php

// Définition du namespace pour le contrôleur
namespace App\Controller;

// Importation des classes nécessaires
use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Plat;

// Définition de la classe PanierController qui hérite de AbstractController
class PanierController extends AbstractController
{
    // Définition d'une propriété privée pour stocker l'instance de PanierService
    private $PS;

    // Constructeur de la classe, qui injecte l'instance de PanierService
    public function __construct(PanierService $PanierService)
    {
        $this->PS = $PanierService;
    }

    // Définition de la route pour la page du panier
    #[Route('/panier', name: 'app_panier')]
    public function index(): Response
    {
        // Vérification que l'utilisateur a le rôle de client
        $this->denyAccessUnlessGranted('ROLE_CLIENT');

        // Récupération du contenu du panier
        $panier = $this->PS->ShowPanier();

        // Récupération des données du panier
        $dataPanier = $this->PS->ShowDataPanier();

        // Récupération du total du panier
        $total = $this->PS->getTotal();

        // Compte le nombre d'éléments dans le panier (non utilisé dans ce cas)
        count($dataPanier);

        // Rendu de la vue du panier avec les données du panier et le total
        return $this->render('panier/index.html.twig', compact("dataPanier", "total"));
    }

    // Définition de la route pour ajouter un plat au panier
    #[Route('/panier/ajout/{id}', name: 'app_ajout_panier', requirements: ['id' => '\d+'])]
    public function AjoutDish(Plat $plat): Response
    {
        // Ajout d'un plat au panier
        $this->PS->AddOneDish($plat);

        // Redirection vers la page du panier
        return $this->redirectToRoute('app_panier');
    }

    // Définition de la route pour enlever un plat du panier
    #[Route('/panier/enlever/{id}', name: 'app_enlever_panier', requirements: ['id' => '\d+'])]
    public function RemoveOneQuantity(Plat $plat): Response
    {
        // Enlèvement d'un plat du panier
        $this->PS->RemoveOneQuantity($plat);

        // Redirection vers la page du panier
        return $this->redirectToRoute('app_panier');
    }

    // Définition de la route pour supprimer un plat du panier
    #[Route('/panier/supprimer/{id}', name: 'app_supprimer_panier', requirements: ['id' => '\d+'])]
    public function DeleteOneDish(Plat $plat): Response
    {
        // Suppression d'un plat du panier
        $this->PS->DeleteOneDish($plat);

        // Redirection vers la page du panier
        return $this->redirectToRoute('app_panier');
    }

    // Définition de la route pour supprimer tous les plats du panier
    #[Route('/panier/supprimer/all', name: 'app_supprimer_panier_all')]
    public function DeleteAllDish(): Response
    {
        // Suppression de tous les plats du panier
        $this->PS->DeleteAllDish();

        // Ajout d'un message de succès pour informer l'utilisateur que le panier a été vidé
        $this->addFlash('success', 'Votre panier a été vidées');

        // Redirection vers la page du panier
        return $this->redirectToRoute('app_panier');
    }
}
