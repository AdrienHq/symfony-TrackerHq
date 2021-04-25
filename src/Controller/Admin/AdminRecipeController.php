<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Form\IngredientType;
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

class AdminRecipeController extends AbstractController
{
    /**
     * @var RecipeRepository
     */
    private $repository;

    public function __construct(RecipeRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/recipe", name="admin.recipe.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $recipes = $this->repository->findAll();
        return $this->render('admin/recipe/index.html.twig', compact('recipes'));
    }

    /**
     * @Route("/admin/recipe/create", name="admin.recipe.new")
     */
    public function new(Request $request)
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($recipe);
            $this->em->flush();
            $this->addFlash('success', 'Creation successful');
            return $this->redirectToRoute('admin.recipe.index');
        }
        return $this->render('admin/recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/recipe/{id}", name="admin.recipe.edit", methods="GET|POST")
     */
    public function edit(Recipe $recipe, Request $request)
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Edit successful');
            return $this->redirectToRoute('admin.recipe.index');
        }
        return $this->render('admin/recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/admin/recipe/{id}", name="admin.recipe.delete", methods="DELETE")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Request $request, Recipe $recipe)
    { 
        if($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->get('_token'))) {
            $this->em->remove($recipe);
            $this->em->flush();
            $this->addFlash('success', 'Deletion successful');
            return $this->redirectToRoute('admin.recipe.index');
        }
        return $this->redirectToRoute('admin.recipe.index');
    }
}