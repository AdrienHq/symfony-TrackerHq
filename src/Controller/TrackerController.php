<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrackerController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @param IngredientRepository $ingRepo
     * @return Response
     */
    public function index(IngredientRepository $ingRepo) : Response
    {
        $ingredients = $ingRepo->findLatest(); 
        return $this->render('tracker/home.html.twig', [
            'ingredients' => $ingredients
        ]);
    }


}
