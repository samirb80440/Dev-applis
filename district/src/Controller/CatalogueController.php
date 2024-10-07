<?php
// Définition du namespace pour le contrôleur
namespace App\Controller;

// Importation des classes nécessaires
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;

// Définition de la classe CatalogueController qui hérite de AbstractController
class CatalogueController extends AbstractController
{
    // Définition de propriétés privées pour stocker les instances des repositories
    private $categorieRepo;
    private $platRepo;

    // Constructeur de la classe, qui injecte les instances des repositories
    public function __construct(CategorieRepository $categorieRepo, PlatRepository $platRepo)
    {
        $this->categorieRepo = $categorieRepo;
        $this->platRepo = $platRepo;
    }

    // Définition de la route pour la page d'accueil
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        // Récupération de toutes les catégories et de tous les plats
        $categories = $this->categorieRepo->findAll();
        $plat = $this->platRepo->findAll();

        // Rendu de la vue index.html.twig avec les catégories et les plats
        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'categories' => $categories,
            'plat' => $plat,
        ]);
    }

    // Définition de la route pour la page des plats
    #[Route('/plats', name: 'app_plat')]
    public function Showplats(): Response
    {
        // Récupération de tous les plats
        $plat = $this->platRepo->findAll();

        // Rendu de la vue plat.html.twig avec les plats
        return $this->render('catalogue/plat.html.twig', [
            'controller_name' => 'CatalogueController',
            'plat' => $plat,
        ]);
    }

    // Définition de la route pour la page des plats par catégorie
    #[Route('/plats/{categorie_id}', name: 'app_platcat', requirements: ['categorie_id' => '\d+'])]
    public function Showplatscat(int $categorie_id): Response
    {
        // Récupération de la catégorie correspondant à l'ID passé en paramètre
        $categorie = $this->categorieRepo->find($categorie_id);

        // Récupération des plats correspondant à la catégorie
        $plat = $this->platRepo->findBy(['categorie' => $categorie->getId()]);

        // Rendu de la vue platcat.html.twig avec les plats et la catégorie
        return $this->render('catalogue/platcat.html.twig', [
            'controller_name' => 'CatalogueController',
            'plat' => $plat,
            'categorie' => $categorie
        ]);
    }

    // Définition de la route pour la page des catégories
    #[Route('/categories', name: 'app_category')]
    public function Showcat(): Response
    {
        // Récupération de toutes les catégories
        $categories = $this->categorieRepo->findAll();

        // Rendu de la vue category.html.twig avec les catégories
        return $this->render('catalogue/category.html.twig', [
            'controller_name' => 'CatalogueController',
            'categories' => $categories,
        ]);
    }
}
