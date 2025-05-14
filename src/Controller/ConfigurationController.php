<?php

namespace Aality\SyliusReassuranceBundle\Controller;

use Aality\SyliusReassuranceBundle\Entity\Configuration\Configuration;
use Aality\SyliusReassuranceBundle\Form\Type\ConfigurationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigurationController extends AbstractController
{
    public function configure(Request $request, EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Configuration::class);
        $config = $repository->find(1);

        if (!$config) {
            $config = new Configuration();
        }

        $form = $this->createForm(ConfigurationType::class, $config);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($config);
            $em->flush();

            $this->addFlash('success', 'aality_reassurance.flash.settings_saved');

            return $this->redirectToRoute('aality_reassurance_admin_configuration');
        }

        $aalityBanner = file_get_contents('https://www.aality.fr/embed/sylius/module-header.html');

        return $this->render('@SyliusReassuranceBundle/admin/reassurance-dashboard.html.twig', [
            'form' => $form->createView(),
            'aalityBanner' => $aalityBanner,
        ]);
    }
}
