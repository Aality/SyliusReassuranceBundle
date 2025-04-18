<?php

namespace Aality\ReassuranceBundle\Form\Type;

use Aality\ReassuranceBundle\Entity\Configuration\Configuration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reassuranceTheme', ChoiceType::class, [
                'choices' => Configuration::REASSURANCE_THEMES,
                'label' => 'Thèmes',
                'placeholder' => 'Sélectionnez un thème',
                'required' => true,
                'attr' => [
                    'style' => 'max-width: 200px;',
                ]
            ])
            ->add('backgroundColor', ColorType::class, [
                'required' => false,
                'label' => 'Couleur de fond',
            ])
            ->add('titleColor', ColorType::class, [
                'required' => false,
                'label' => 'Couleur des titres',
            ])
            ->add('textColor', ColorType::class, [
                'required' => false,
                'label' => 'Couleur des textes',
            ])
            ->add('iconSize', NumberType::class, [
                'required' => false,
                'label' => 'Taille des icônes',
                'attr' => [
                    'style' => 'max-width: 100px;',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Configuration::class,
        ]);
    }
}