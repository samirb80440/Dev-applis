<?php

namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class CommandeType extends AbstractType
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
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre nom doit contenir au moins {{ limit }} caractères.',
                        'max' => 50,
                        'maxMessage' => 'Votre nom ne doit pas contenir plus de {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z\s]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres et des espaces.',
                    ]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre prénom.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre prénom doit contenir au moins {{ limit }} caractères.',
                        'max' => 50,
                        'maxMessage' => 'Votre prénom ne doit pas contenir plus de {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z\s]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres et des espaces.',
                    ]),
                ],
            ])
            ->add('telephone', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre numéro de téléphone.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre numéro de téléphone doit contenir au moins {{ limit }} caractères.',
                        'max' => 15,
                        'maxMessage' => 'Votre numéro de téléphone ne doit pas contenir plus de {{ limit }} caractères.',
                    ]),
                ],
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
                        'pattern' =>  '/^[a-zA-Z0-9\s]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres et des espaces.',
                    ]),
                ],
            ])
            ->add('cp', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre code postal.',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Votre code postal doit contenir au moins {{ limit }} caractères.',
                        'max' => 10,
                        'maxMessage' => 'Votre code postal ne doit pas contenir plus de {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]{5}$/',
                        'message' => 'Le code postal doit être composé de 5 chiffres.',
                    ]),
                ],
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
                    new Regex([
                        'pattern' => '/^[a-zA-Z\s]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres et des espaces.',
                    ]),
                ],
            ])
            ->add('adresse_facturation', TextareaType::class, [
                'attr' => ['class' => 'col-3 form-control']
            ])
            ->add('mode_paiement', ChoiceType::class, [
                'attr' => ['class' => 'col-3 form-control'],
                'choices' => [
                    'Visa' => 'Visa',
                    'MasterCard' => 'MasterCard',
                    'Paypal' => 'Paypal',
                ],
                'expanded' => false,

                'multiple' => false,
                'placeholder' => 'Sélectionnez un moyen de paiement.'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos termes.',
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Commander',
                'attr' => [
                    'class' => 'btn color-B09595 rounded-pill '
                ],
                'row_attr' => [
                    'class' => 'd-flex justify-content-end'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
