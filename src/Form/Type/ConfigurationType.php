<?php

namespace Aality\SyliusReassuranceBundle\Form\Type;

use Aality\SyliusReassuranceBundle\Entity\Configuration\Configuration;
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
                'label' => 'aality_reassurance.form.choose_theme_label',
                'placeholder' => 'aality_reassurance.form.choose_theme_placeholder',
                'required' => true,
                'attr' => [
                    'style' => 'max-width: 200px;',
                ]
            ])
            ->add('backgroundColor', ColorType::class, [
                'required' => false,
                'label' => 'aality_reassurance.form.background_color_label',
            ])
            ->add('titleColor', ColorType::class, [
                'required' => false,
                'label' => 'aality_reassurance.form.title_color_label',
            ])
            ->add('textColor', ColorType::class, [
                'required' => false,
                'label' => 'aality_reassurance.form.text_color_label',
            ])
            ->add('iconSize', NumberType::class, [
                'required' => false,
                'label' => 'aality_reassurance.form.icon_size_label',
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
