<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Meal;
use App\Entity\User;
use App\Entity\Recipe;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use App\Repository\MealRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AbstractController
{

    /**
     * @var Security
     */
    private $security;


    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/dashboard", name="dashboard.index")
     * @param MealRepository $mealRepo
     * @return Response
     */
    public function showDashboard(MealRepository $mealRepo)
    {
        $date = new \DateTime('today');
        $user = $this->security->getUser();
        $allUserMeal = $mealRepo->findMealByUser($user, $date); 
        return $this->render('dashboard/dashboard.html.twig',[
            'allUserMeal' => $allUserMeal,
            'user' => $user,
            'current_menu' => 'dashboard'
        ]);      
    }
    
}