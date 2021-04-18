<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
}