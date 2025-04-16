<?php

namespace Aality\ReassuranceBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Aality\ReassuranceBundle\Entity\Reassurance\Reassurance;

class ReassuranceType extends AbstractResourceType
{
    public function __construct(private string $projectDir)
    {
        parent::__construct(Reassurance::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('text')
            ->add('image', FileType::class, [
                'required' => false,
                'mapped' => false, // Pour éviter de mapper directement sur l'entité
            ]);
        ;

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
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
    }
}
