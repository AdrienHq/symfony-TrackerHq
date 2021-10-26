<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/{_locale}/recipe", name="recipe.index")
     * @param RecipeRepository $recipeRepo
     * @return Response
     */
    public function index(RecipeRepository $recipeRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $recipes = $recipeRepo->findAll();
        return $this->render('recipe/index.html.twig',[
            'recipes' => $recipes,
            'current_menu' => 'recipe'
        ]);
    }

    /**
     * @Route("/{_locale}/recipe/{slug}-{id}", name="recipe.show", requirements={"slug": "[a-z0-ç\-]*"})
     * @return Response
     */
    public function show(Recipe $recipe, string $slug): Response
    { 
        $this->denyAccessUnlessGranted('ROLE_USER');
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

    /**
     * @Route("/{_locale}/recipe/create", name="recipe.new")
     */
    public function new(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($recipe);
            $this->em->flush();
            $this->addFlash('success', 'Creation successful');
            return $this->redirectToRoute('recipe.index');
        }
        return $this->render('/recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView()
        ]);
    }

}