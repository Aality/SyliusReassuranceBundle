<?php

namespace Aality\ReassuranceBundle\Controller;

use Aality\ReassuranceBundle\Entity\Configuration\Configuration;
use Aality\ReassuranceBundle\Entity\Reassurance\Reassurance;
use Aality\ReassuranceBundle\Form\Type\ReassuranceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;

final class ReassuranceController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em)
    {

    }

    public function index(): Response
    {

        $reassurances = $this->em->getRepository(Reassurance::class)->findAll();
        $configuration = $this->em->getRepository(Configuration::class)->find(1);

        return $this->render('@ReassuranceBundle/shop/reassurance.html.twig',
            ['reassurances' => $reassurances, 'configuration' => $configuration]
        );
    }

}
