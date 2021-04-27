<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Meal;
use App\Form\MealType;
use App\Repository\MealRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class MealController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Security
     */
    private $security;

    public function __construct(MealRepository $repository, EntityManagerInterface $em, Security $security )
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @Route("/meal/create", name="meal.new")
     * * @return Response
     */
    public function new(Request $request)
    {
        $meal = new Meal();
        $user = $this->security->getUser();
        $form = $this->createForm(MealType::class, $meal);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $date = new \DateTime('today');
            $meal->setDate($date); 
            $meal->setUserMeal($user);
            $this->em->persist($meal);
            $this->em->flush();
            $this->addFlash('success', 'Creation successful');
            return $this->redirectToRoute('meal.new');
        }
        return $this->render('/meal/new.html.twig', [
            'meal' => $meal,
            'form' => $form->createView(),
            'current_menu' => 'meal'
        ]);
    }


}