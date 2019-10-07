<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email', EmailType::class)
            ->add('birthday', DateType::class, ['widget' => 'single_text'])
            ->add('isEnabled', null, ['label' => 'Compte activé'])
            ->add('points')
            //->add('createdAt') // on va pas demander à quelqu'un de saisir la date de création, c'est automatique

            // pour afficher une entité dans le formulaire, vous pouvez préciser au form quel propriété doit être affichée
            //->add('team', null, ['choice_label' => 'name'])

            // ou alors on peut (re)définir la méthode __toString() de l'entité concernée
            ->add('team', null, ['expanded' => false])

            // pour créer des entrées, c'est une collection dont il faut préciser le FormType correspodant
            // de l'entité associée
            ->add('addresses', CollectionType::class, [
                'entry_type' => AddressType::class,
                'prototype' => true,
                'allow_add' => true,
                'label' => false,
                'by_reference' => false
            ])


            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
