<?php

namespace App\Form;

use App\Entity\Personnage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PersonnageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
               'label' => 'Nom :',
            ])
            ->add('birth', NumberType::class, [
               'label' => 'Année de naissance :',
            ])
            ->add('death', NumberType::class, [
               'label' => 'Année du décès :',
            ])
            ->add('people', TextType::class, [
               'label' => 'Peuple : ',
            ])
            ->add('history', TextareaType::class, [
               'label' => 'Histoire : ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnage::class,
        ]);
    }
}
