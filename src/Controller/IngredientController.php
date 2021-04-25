<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class IngredientController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(IngredientRepository $repository, EntityManagerInterface $em )
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/ingredients", name="ingredient.index")
     * @param IngredientRepository $ingRepo
     * @return Response
     */
    public function index(IngredientRepository $ingRepo): Response
    {
        
        /* --$ingredient = new Ingredient();
        $ingredient->setName('Steak')->setType(1)->setDescription('Du poulet')->setQuantity(100)->setCarbohydrate(3.57)->setFat(8.93)->setProtein(16.07)->setSugar(1.79)->setEnergy(161)->setCreatedBy('');
        $em = $this->getDoctrine()->getManager();
        $em->persist($ingredient);
        $em->flush();
        */
        $ingredients = $ingRepo->findAll(); 
        return $this->render('ingredient/ingredient.html.twig', [
            'ingredients' => $ingredients,
            'current_menu' => 'ingredients'
        ]);
    }

    /**
     * @Route("/ingredients/{slug}-{id}", name="ingredient.show", requirements={"slug": "[a-z0-ç\-]*"})
     * @return Response
     */
    public function show(Ingredient $ingredient, string $slug): Response
    { 
        if($ingredient->getSlug() !== $slug){
            return $this->redirectToRoute('ingredient.show', [
                'id' => $ingredient->getId(),
                'slug' => $ingredient->getSlug()
            ], 301 );
        }
        return $this->render('ingredient/show.html.twig', [
            'ingredient' => $ingredient,
            'current_menu' => 'ingredients'
        ]);
    }


    /**
     * @Route("/ingredient/create", name="ingredient.new")
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
            return $this->redirectToRoute('ingredient.index');
        }
        return $this->render('/ingredient/new.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView()
        ]);
    }
}