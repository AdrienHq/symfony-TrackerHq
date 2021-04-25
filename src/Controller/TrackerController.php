<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrackerController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @param IngredientRepository $ingRepo
     * @param RecipetRepository $recipeRepo
     * @return Response
     */
    public function index(IngredientRepository $ingRepo, RecipeRepository $recipeRepo) : Response
    {
        $ingredients = $ingRepo->findLatest(); 
        $recipes = $recipeRepo->findLatest();
        return $this->render('tracker/home.html.twig', [
            'ingredients' => $ingredients,
            'recipes' => $recipes
        ]);
    }


}
