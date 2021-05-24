<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminIngredientController extends AbstractController
{
    /**
     * @var IngredientRepository
     */
    private $repository;

    public function __construct(IngredientRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/{_locale}/admin/ingredient", name="admin.ingredient.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $ingredients = $this->repository->findAll();
        return $this->render('admin/ingredient/index.html.twig', compact('ingredients'));
    }

    /**
     * @Route("/{_locale}/admin/ingredient/create", name="admin.ingredient.new")
     */
    public function new(Request $request)
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($ingredient);
            $this->em->flush();
            $this->addFlash('success', 'Creation successful');
            return $this->redirectToRoute('admin.ingredient.index');
        }
        return $this->render('admin/ingredient/new.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{_locale}/admin/ingredient/{id}", name="admin.ingredient.edit", methods="GET|POST")
     */
    public function edit(Ingredient $ingredient, Request $request)
    {
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Edit successful');
            return $this->redirectToRoute('admin.ingredient.index');
        }
        return $this->render('admin/ingredient/edit.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/{_locale}/admin/ingredient/{id}", name="admin.ingredient.delete", methods="DELETE")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Request $request, Ingredient $ingredient)
    { 
        if($this->isCsrfTokenValid('delete'.$ingredient->getId(), $request->get('_token'))) {
            $this->em->remove($ingredient);
            $this->em->flush();
            $this->addFlash('success', 'Deletion successful');
            return $this->redirectToRoute('admin.ingredient.index');
        }
        return $this->redirectToRoute('admin.ingredient.index');
    }
}