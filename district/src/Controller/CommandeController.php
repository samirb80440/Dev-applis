<?php

// Définition du namespace pour le contrôleur
namespace App\Controller;

// Importation des classes nécessaires
use App\Entity\Commande;
use App\Entity\Detail;
use App\Manager\CommandeManager;
use App\Form\CommandeType;
use App\Manager\DetailManager;
use App\Repository\PlatRepository;
use App\Service\PanierService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\EventSubvriber\MailCommandeSubscriber;

// Définition de la classe CommandeController qui hérite de AbstractController
class CommandeController extends AbstractController
{
    // Définition de propriétés privées pour stocker les instances des repositories et services
    private $PlatRepo;
    private $ps;
    private $cm;
    private $dm;

    // Constructeur de la classe, qui injecte les instances des repositories et services
    public function __construct(PlatRepository $PlatRepo, PanierService $panierService, CommandeManager $cm, DetailManager $dm)
    {
        $this->PlatRepo = $PlatRepo;
        $this->ps = $panierService;
        $this->cm = $cm;
        $this->dm = $dm;
    }

    // Définition de la route pour la page de commande
    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request, EntityManagerInterface $em, SessionInterface $session): Response
    {
        // Récupération du contenu du panier
        $panier = $this->ps->ShowPanier();

        // Vérification que le panier n'est pas vide
        if (!empty($panier)) {
            // Vérification que l'utilisateur a le rôle de client
            $this->denyAccessUnlessGranted('ROLE_CLIENT');

            // Récupération de l'utilisateur connecté
            $user = $this->getUser();

            // Création d'un formulaire de commande pour l'utilisateur
            $form = $this->createForm(CommandeType::class, $user);
            $form->handleRequest($request);

            // Vérification que le formulaire a été soumis et est valide
            if ($form->isSubmitted() && $form->isValid()) {
                // Récupération du total du panier
                $total = $this->ps->getTotal();

                // Création d'une nouvelle commande
                $commande = new Commande();
                $commande->setDateCommande(new \DatetimeImmutable());
                $commande->setTotal($total);
                $commande->setEtat(0);
                $commande->setUser($user);

                // Enregistrement de la commande
                $this->cm->setCommande($commande);

                // Boucle sur les éléments du panier pour créer les détails de la commande
                foreach ($panier as $id => $quantite) {
                    $plat = $this->PlatRepo->find($id);

                    $detail = new Detail();
                    $detail->setQuantite($quantite);
                    $detail->setCommande($commande);
                    $detail->setPlat($plat);

                    // Enregistrement des détails de la commande
                    $em->persist($detail);
                }

                // Flush des données en base de données
                $em->flush();

                // Suppression du contenu du panier
                $this->ps->DeleteAllDish();

                // Ajout d'un message de succès pour informer l'utilisateur que la commande a été prise en compte
                $this->addFlash('success', 'Vous allez être livré sous peu');

                // Redirection vers la page d'accueil
                return $this->redirectToRoute('app_index');
            } else {
                // Rendu de la vue du formulaire de commande si le formulaire n'a pas été soumis ou est invalide
                return $this->render('commande/index.html.twig', [
                    'form' => $form
                ]);
            }
        } else {
            // Redirection vers la page du panier si le panier est vide
            return $this->redirectToRoute('app_panier');
        }
    }
}
