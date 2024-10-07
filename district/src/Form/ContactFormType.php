<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;


class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'contraintes' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre nom.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre nom doit contenir au moins {{ limit }} caractères.',
                        'max' => 50,
                        'maxMessage' => 'Votre nom ne doit pas contenir plus de {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('Prenom', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'contraintes' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre prénom.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre prénom doit contenir au moins {{ limit }} caractères.',
                        'max' => 50,
                        'maxMessage' => 'Votre prénom ne doit pas contenir plus de {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('Email', EmailType::class, [
                'attr' => [
                    'class' => 'col-3 form-control texte'
                ],
                'contraintes' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre adresse e-mail.',
                    ]),
                    new Email([
                        'message' => 'Veuillez entrer une adresse e-mail valide.',
                    ]),
                ],
            ])
            ->add('Telephone', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'contraintes' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre numéro de téléphone.',
                    ]),
                    new Regex([
                        'pattern' => '/^(0|0033)[1-9]([-. ]?\d{2}){4}$/',
                        'message' => 'Veuillez entrer un numéro de téléphone valide.',
                    ]),
                ],
            ])
            ->add('Demande', TextareaType::class, [
                'label' => 'Votre Demande',
                'attr' => [
                    'class' => 'col-3 form-control'
                ],
                'contraintes' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre demande.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre demande doit contenir au moins {{ limit }} caractères.',
                        'max' => 500,
                        'maxMessage' => 'Votre demande ne doit pas contenir plus de {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('Save', SubmitType::class, [
                'label' => 'Envoyer',
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
            'data_class' => Contact::class,
        ]);
    }
}
