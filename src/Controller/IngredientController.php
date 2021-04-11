<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{

    public function __construct(IngredientRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/ingredients", name="ingredient.index")
     */
    public function index(): Response
    {
        /**
         * $ingredient = new Ingredient();
         * $ingredient->setName('Chicken')->setType(1)->setDescription('Du poulet')->setQuantity(100)->setCarbohydrate(3.57)->setFat(8.93)->setProtein(16.07)->setSugar(1.79)->setEnergy(161)->setCreatedBy('');
         * $em = $this->getDoctrine()->getManager();
         * $em->persist($ingredient);
         * $em->flush();
         */
        $ingredient = $this->repository->findAll();
        dump($ingredient);
        return $this->render('tracker/ingredient.html.twig', [
            'current_menu' => 'ingredients'
        ]);
    }
}