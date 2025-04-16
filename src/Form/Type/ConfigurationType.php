<?php

namespace Aality\ReassuranceBundle\Form\Type;

use Aality\ReassuranceBundle\Entity\Configuration\Configuration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('backgroundColor', ColorType::class, [
                'required' => false,
                'label' => 'Couleur de fond',
            ])
            ->add('textColor', ColorType::class, [
                'required' => false,
                'label' => 'Couleur du texte',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Configuration::class,
        ]);
    }
}