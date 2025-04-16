<?php

namespace Aality\ReassuranceBundle\Controller;

use Aality\ReassuranceBundle\Entity\Configuration\Configuration;
use Aality\ReassuranceBundle\Form\Type\ConfigurationType;
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

            $this->addFlash('success', 'Réglages enregistrés avec succès.');

            return $this->redirectToRoute('aality_reassurance_admin_configuration');
        }

        return $this->render('@ReassuranceBundle/admin/reassurance-dashboard.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}