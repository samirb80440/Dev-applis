<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre nom.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z\s]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres et des espaces.',
                    ]),
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre prénom.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z\s]+$/',
                        'message' => 'Le prénom ne doit contenir que des lettres et des espaces.',
                    ]),
                ]
            ])
            ->add('telephone', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre numéro de téléphone.',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9\s]+$/',
                        'message' => 'Le numéro de téléphone ne doit contenir que des chiffres et des espaces.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre numéro de téléphone doit contenir au moins {{ limit }} chiffres.',
                        'max' => 15,
                        'maxMessage' => 'Votre numéro de téléphone ne doit pas contenir plus de {{ limit }} chiffres.',
                    ]),
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre adresse.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre adresse doit contenir au moins {{ limit }} caractères.',
                        'max' => 100,
                        'maxMessage' => 'Votre adresse ne doit pas contenir plus de {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9\s]+$/',
                        'message' => 'L\'adresse ne doit contenir que des lettres, des chiffres et des espaces.',
                    ]),
                ]
            ])

            ->add('cp', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre code postal.',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]{5}$/',
                        'message' => 'Le code postal doit être composé de 5 chiffres.',
                    ]),
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre ville.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre ville doit contenir au moins {{ limit }} caractères.',
                        'max' => 50,
                        'maxMessage' => 'Votre ville ne doit pas contenir plus de {{ limit }} caractères.',
                    ]),
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre adresse e-mail.',
                    ]),
                    new Regex([
                        'pattern' => '/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/',
                        'message' => 'Veuillez entrer une adresse e-mail valide.',
                    ]),
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos termes.',
                    ]),
                ],
            ])
            ->add('Password', PasswordType::class, [
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, $this->setRole(...))
            ->add('Save', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn color-B09595 rounded-pill'
                ],
                'row_attr' => [
                    'class' => 'd-flex justify-content-end'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function setRole(PostSubmitEvent $event): void
    {
        $data = $event->getData();
        $data->setRoles(['ROLE_CLIENT']);
    }
}
