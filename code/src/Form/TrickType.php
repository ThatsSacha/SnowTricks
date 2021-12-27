<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la figure *',
                'help' => 'Le nom de la figure doit être unique',
                'attr' => array(
                    'placeholder' => 'Ex: Truck driver'
                )
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de la figure *',
                'attr' => array(
                    'placeholder' => 'Ex: saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)...'
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
