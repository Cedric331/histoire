<?php

namespace App\Form;

use App\Entity\Personnage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
               'label_attr' => [
                  'class'=> 'my-1',
               ]
            ])
            ->add('birth', NumberType::class, [
               'label' => 'Année de naissance :',
               'label_attr' => [
                  'class'=> 'my-1',
               ]
            ])
            ->add('death', NumberType::class, [
               'label' => 'Année du décès :',
               'label_attr' => [
                  'class'=> 'my-1',
               ]
            ])
            ->add('people', TextType::class, [
               'label' => 'Peuple : ',
               'label_attr' => [
                  'class'=> 'my-1',
               ]
            ])
            ->add('imageFile', VichImageType::class, [
               'label' => 'Image :',
               'delete_label' => 'Supprimer l\'image' ,
               'image_uri' => false,
               'download_uri' => false,
               'label_attr' => [
                  'class'=> 'my-1',
               ]
            ])
            ->add('history', TextareaType::class, [
               'label' => 'Histoire : ',
               'label_attr' => [
                  'class'=> 'my-1',
               ]
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
