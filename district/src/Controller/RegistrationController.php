<?php

namespace App\Controller;

// Importation des classes et interfaces nécessaires
use App\Entity\User;
use App\Repository\CommandeRepository;
use App\Form\RegistrationFormType;
use App\Repository\DetailRepository;
use App\Repository\PlatRepository;
use App\Security\UserFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
     // Propriétés privées pour stocker les instances de repository
    private $userRepository;
    private $commandeRepository;
    private $detailRepository;

     // Constructeur pour injecter les instances de repository
    public function __construct(UserRepository $userRepository,CommandeRepository $commandeRepository,DetailRepository $detailRepository)
    {
        $this->userRepository = $userRepository;
        $this->commandeRepository = $commandeRepository;
        $this->detailRepository = $detailRepository;
    }


    // Action d'inscription
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
         // Création d'une nouvelle instance de User
        $user = new User();
          // Création d'une instance de formulaire pour l'entité User
        $form = $this->createForm(RegistrationFormType::class, $user);
        // Traitement de la soumission du formulair
        $form->handleRequest($request);

        // Vérification si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
             // Récupération du mot de passe en clair à partir du formulaire
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // Hachage du mot de passe en clair
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            // Persistance de l'entité User
            $entityManager->persist($user);
            $entityManager->flush();

            
            // Ajout d'un message flash pour notifier l'utilisateur
            $this->addFlash('success','Votre compte client a bien été crées');
             // Connexion de l'utilisateur à l'aide de l'authentificateur UserFormAuthenticator
            return $security->login($user, UserFormAuthenticator::class, 'main');
        }

        // Rendu du template de formulaire d'inscription
        return $this->render('security/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    // Action de détails de l'utilisateur
    #[Route('/{nom}-{prenom}', name: 'app_utilisateur')]
    public function DetailsUser(): Response
        {
             // Vérification si l'utilisateur est entièrement authentifié
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            
            // Récupération de l'instance de l'utilisateur actuel
            /** @var \App\Entity\User */
            $user = $this->getUser();
            // Récupération des commandes de l'utilisateur
            $commandes = $this->commandeRepository->findBy(['user' => $user->getId()]);
             // Rendu du template de détails de l'utilisateur
            return $this->render('connexion/detail.html.twig',[
                'user'=> $user,
                'commandes'=> $commandes
            ]);
        }
        
         // Action de modification du profil de l'utilisateur
        #[Route('/{nom}-{prenom}/edit', name: 'app_editprofil')]
        public function EditUser(Request $request,EntityManagerInterface $em): Response
        {
             // Vérification si l'utilisateur est entièrement authentifié
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    
            // Récupération de l'instance de l'utilisateur actuel
            /** @var \App\Entity\User*/
            $user = $this->getUser();

            // Création d'une instance de formulaire pour l'entité User
            $form = $this->createForm(RegistrationFormType::class, $user);
            // Traitement de la soumission du formulaire
            $form->handleRequest($request);

             // Vérification si le formulaire est soumis et valide
            if ($form->isSubmitted() && $form->isValid()){
                // Flush des modifications dans la base de données
                $em->flush();
                // Redirection vers la page de détails de l'utilisateur
                return $this->redirectToRoute('app_utilisateur' , [
                    'nom' => $user->getNom(),
                    'prenom' => $user->getPrenom()
                ]);
                }
            
            // Rendu du template de modification de profil
            return $this->render('connexion/edit.html.twig',[
                'user'=> $user,
                'form' => $form
            ]);
        }
    }