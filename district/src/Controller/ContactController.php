<?php
// Définition du namespace pour le contrôleur
namespace App\Controller;

// Importation des classes nécessaires
use App\Entity\Contact;
use App\Manager\ContactManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManager;

// Définition de la classe ContactController qui hérite de AbstractController
class ContactController extends AbstractController
{
    // Définition de la route pour la page de contact
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, ContactManager $cm, EntityManagerInterface $em): Response
    {
        // Vérification que l'utilisateur a le rôle de client
        $this->denyAccessUnlessGranted('ROLE_CLIENT');

       
        $user = $this->getUser();

        // Création d'un formulaire de contact
        $form = $this->createForm(ContactFormType::class, $user);

        // Traitement du formulaire
        $form->handleRequest($request);

        // Vérification que le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement du contact
            $cm->setContact($user);

            // Ajout d'un message de succès pour informer l'utilisateur que son message a été envoyé
            $this->addFlash('success', 'Vous allez être contacter sous peu');

            // Redirection vers la page d'accueil
            return $this->redirectToRoute('app_index');
        } else {
            // Rendu de la vue du formulaire de contact si le formulaire n'a pas été soumis ou est invalide
            return $this->render('contact/index.html.twig', [
                'form' => $form
            ]);
        }
    }

    // Définition de la route pour la page de politique de confidentialité
    #[Route('/politique_de_confidentialite', name: 'app_pdf')]
    public function politiqueconf(): Response
    {
        // Rendu de la vue de politique de confidentialité
        return $this->render('contact/politique_de_confidentialite.html.twig');
    }

    // Définition de la route pour la page de mention légale
    #[Route('/mention_legale', name: 'app_mention_legale')]
    public function mention_legale(): Response
    {
        // Rendu de la vue de mention légale
        return $this->render('contact/mention_legale.html.twig');
    }
}
