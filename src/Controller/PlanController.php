<?php

namespace App\Controller;

use App\Entity\Plan;
use App\Repository\PlanRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PlanController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PlanRepository $repository, EntityManagerInterface $em )
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/plan", name="plan.index")
     * @param PlanRepository $planRepo
     * @return Response
     */
    public function index(PlanRepository $planRepo): Response
    {
        /*
        $plan = new Plan();
        $plan->setName('Normal')->setType(1)->setDescription('Stabilisation');
        $em = $this->getDoctrine()->getManager();
        $em->persist($plan);
        $em->flush();
        */
        $plans = $planRepo->findAll(); 
        return $this->render('plan/plan.html.twig', [
            'plans' => $plans,
            'current_menu' => 'plans'
        ]);
    }
}