<?php

namespace Aality\SyliusReassuranceBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Aality\SyliusReassuranceBundle\Entity\Reassurance\Reassurance;

class ReassuranceType extends AbstractResourceType
{
    public function __construct(private string $projectDir)
    {
        parent::__construct(Reassurance::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'aality_reassurance.reassurance_form.title_label',
            ])
            ->add('text', TextareaType::class, [
                'label' => 'aality_reassurance.reassurance_form.text_label',
            ])
            ->add('image', FileType::class, [
                'label' => 'aality_reassurance.reassurance_form.image_label',
                'required' => false,
                'mapped' => false, // Pour éviter de mapper directement sur l'entité
            ])
            ->add('image_name_display', TextType::class, [
                'mapped' => false,
                'data' => $options['data']->getImage(),
                'label' => 'aality_reassurance.reassurance_form.image_name_display_label',
                'required' => false,
                'disabled' => true,
            ])
            ->add('remove_image_checkbox', CheckboxType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'aality_reassurance.reassurance_form.remove_image_label',
            ]);


        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            /** @var Reassurance $reassurance */
            $reassurance = $event->getData();
            $form = $event->getForm();

            /** @var UploadedFile|null $file */
            $file = $form->get('image')->getData();

            if ($file instanceof UploadedFile) {
                $uploadDir = $this->projectDir . '/public/uploads/reassurances';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $filename = $file->getClientOriginalName();
                $file->move($uploadDir, $filename);
                $reassurance->setImage($filename);
            }

            if ($form->get('remove_image_checkbox')->getData()) {
                $reassurance->setImage(null);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
    }
}
