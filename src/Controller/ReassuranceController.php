<?php

namespace Aality\SyliusReassuranceBundle\Controller;

use Aality\SyliusReassuranceBundle\Entity\Configuration\Configuration;
use Aality\SyliusReassuranceBundle\Entity\Reassurance\Reassurance;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ReassuranceController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em)
    {

    }

    public function index(): Response
    {

        $reassurances  = $this->em->getRepository(Reassurance::class)->findAll();
        $configuration = $this->em->getRepository(Configuration::class)->find(1);
        if ($configuration instanceof Configuration) {
            $theme = $configuration->getReassuranceTheme();
        } else {
            return new Response('');
        }

        return $this->render(
            '@SyliusReassuranceBundle/shop/reassurance.html.twig',
            ['reassurances' => $reassurances, 'configuration' => $configuration, 'theme' => $theme]
        );
    }

}
