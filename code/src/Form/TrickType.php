<?php

namespace App\Form;

use App\Entity\Trick;
use App\Service\TrickService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TrickType extends AbstractType
{
    private $service;

    public function __construct(TrickService $service)
    {
        $this->service = $service;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $trickGroups = $this->service->getTrickGroups();
        $trickChoices = [];
        foreach ($trickGroups as $trickGroup) {
            $trickChoices[$trickGroup->getName()] = $trickGroup;
        }

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
            ->add('trickGroup', ChoiceType::class, [
                'label' => 'Groupe de figure *',
                'choices' => $trickChoices
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
