<?php

namespace App\Form;

use App\Entity\Citation;
use App\Entity\Personnage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CitationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('citation', TextareaType::class, [
               'label' => 'Citation :',
               'label_attr' => [
                  'class'=> 'my-1',
               ]
            ])
            ->add('personnage', EntityType::class, [
               'class' => Personnage::class,
               'label' => "Personnage :",
               'label_attr' => [
                  'class'=> 'my-1',
               ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Citation::class,
        ]);
    }
}
