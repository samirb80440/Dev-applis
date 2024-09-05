<?php

namespace App\Form;

use App\Form;
use App\Entity\Recipe;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
              'empty_data' => ''
            ])
            ->add('slug', TextType::class,[
              'required'=> false,
             
            ])
            ->add('content', TextareaType::class, [
              'empty_data' => ''
            ])
            ->add('duration')
            ->add('save', SubmitType::class, [
               'label' => 'Envoyer'

            ])
            ->addEventListener(FormEvents::PRE_SUBMIT,$this->autoSlug(... ))
            ->addEventListener(FormEvents::POST_SUBMIT,$this->attachTimestamps(... ))
        ;
    }
    
    public function autoSlug(PreSubmitEvent $event): void
    {   
      $data = $event->getData();
      if (empty($data['slug'])){
       $slugger = new ASciiSlugger();
       $data['slug'] =strtolower($slugger->slug($data['title']));
       $event->setData($data);

      }
    
      
    }

    public function attachTimestamps(PostSubmitEvent $event) : void
    {
       $data =$event->getData();
       if(!($data instanceof Recipe)){
          return;
       }
         $data->setUpdatedAt(new \DateTimeImmutable());
         if (!$data->getId()) {
            $data->setCreatedAt(new \DateTimeImmutable());
         }
    }




    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
            //'validation_groups' => ['Default','Extra']//
        ]);
    }
}
