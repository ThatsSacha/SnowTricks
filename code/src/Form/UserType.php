<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail *',
                'help' => 'Format attendu : prefixe@domaine.com',
                'attr' => array(
                    'placeholder' => 'Ex: mail@snowtricks.com'
                )
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe *',
                'help' => 'Doit contenir minimum 8 caractères et au moins 1 chiffre',
                'attr' => array(
                    'placeholder' => '*******',
                    'autocomplete' => 'new-password'
                )
            ])
            ->add('pseudo', null, [
                'label' => 'Pseudo *',
                'help' => 'Les espaces seront supprimés',
                'attr' => array(
                    'placeholder' => 'Ex: JamesDupont9',
                )
            ])
            ->add('cover', FileType::class, [
                'label' => 'Photo de profile *',
                'help' => 'Extensions autorisées : jpg, jpeg & png',
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
