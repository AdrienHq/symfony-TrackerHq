<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class RecipeController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(RecipeRepository $recipeRepo, EntityManagerInterface $em )
    {
        $this->recipeRepo = $recipeRepo;
        $this->em = $em;
    }

    /**
     * @Route("/recipe", name="recipe.index")
     * @param RecipeRepository $recipeRepo
     * @return Response
     */
    public function index(RecipeRepository $recipeRepo): Response
    {
        $recipes = $recipeRepo->findAll();
        return $this->render('recipe/index.html.twig',[
            'recipes' => $recipes,
            'current_menu' => 'recipe'
        ]);
    }

    /**
     * @Route("/recipe/{slug}-{id}", name="recipe.show", requirements={"slug": "[a-z0-ç\-]*"})
     * @return Response
     */
    public function show(Recipe $recipe, string $slug): Response
    { 
        if($recipe->getSlug() !== $slug){
            return $this->redirectToRoute('recipe.show', [
                'id' => $recipe->getId(),
                'slug' => $recipe->getSlug()
            ], 301 );
        }
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'current_menu' => 'recipe'
        ]);

    }

}