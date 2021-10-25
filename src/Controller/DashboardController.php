<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Meal;
use App\Entity\User;
use App\Entity\Recipe;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use App\Repository\MealRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;;

use Symfony\Component\Validator\Constraints\Length;

class DashboardController extends AbstractController
{

    /**
     * @var Security
     */
    private $security;


    public function __construct(Security $security, UserRepository $userRepo)
    {
        $this->security = $security;
        $this->userRepo = $userRepo;
    }

    /**
     * @Route("/{_locale}/dashboard", name="dashboard.index")
     * @param MealRepository $mealRepo
     * @return Response
     */
    public function showDashboard(MealRepository $mealRepo, UserRepository $userRepo)
    {

        $date = new \DateTime('today');
        $user = $this->security->getUser();
        $userData = $user->getBrm();
        $allUserMeal = $mealRepo->findMealByUser($user, $date);

        $calories = 0;
        $carbohydrate = 0;
        $fat = 0;
        $protein = 0;
        $sugar = 0;
        $energy = 0;

        foreach ($allUserMeal as $meal){
            foreach($meal->getMealIngredient()->getValues() as $ingredient){
                $calories += ($ingredient->getProtein()*4)+($ingredient->getCarbohydrate()*4)+($ingredient->getFat()*9);
                $carbohydrate += $ingredient->getCarbohydrate();
                $fat += $ingredient->getFat();
                $protein += $ingredient->getProtein();
                $sugar += $ingredient->getSugar();
                $energy += $ingredient->getEnergy();
            }
            foreach($meal->getMealRecipes()->getValues() as $recipe){
                foreach($recipe->getIngredients() as $IngredientQuantity){
                    dump($IngredientQuantity->getGrams());
                    if($IngredientQuantity->getIngredient()->getQuantity())
                    {
                        $calories += ($IngredientQuantity->getIngredient()->getProtein()*4)+($IngredientQuantity->getIngredient()->getCarbohydrate()*4)+($IngredientQuantity->getIngredient()->getFat()*9);
                        $carbohydrate += $IngredientQuantity->getIngredient()->getCarbohydrate();
                        $fat += $IngredientQuantity->getIngredient()->getFat();
                        $protein += $IngredientQuantity->getIngredient()->getProtein();
                        $sugar += $IngredientQuantity->getIngredient()->getSugar();
                        $energy += $IngredientQuantity->getIngredient()->getEnergy();
                    }else{
                        $calories += ($IngredientQuantity->getIngredient()->getProtein()*4)+($IngredientQuantity->getIngredient()->getCarbohydrate()*4)+($IngredientQuantity->getIngredient()->getFat()*9)*$IngredientQuantity->getGrams();
                        $carbohydrate += $IngredientQuantity->getIngredient()->getCarbohydrate()*$IngredientQuantity->getGrams();
                        $fat += $IngredientQuantity->getIngredient()->getFat()*$IngredientQuantity->getGrams();
                        $protein += $IngredientQuantity->getIngredient()->getProtein()*$IngredientQuantity->getGrams();
                        $sugar += $IngredientQuantity->getIngredient()->getSugar()*$IngredientQuantity->getGrams();
                        $energy += $IngredientQuantity->getIngredient()->getEnergy()*$IngredientQuantity->getGrams();

                    }
                    
                }
            }
        }

        $col = new ColumnChart();
        $col->getData()->setArrayToDataTable(
            [
                ['Element', ['legend' => 'none'],['role' => 'style' ]],
                ['BMR', $userData, '#8ED3F4'],
                ['Macro', $calories, '#8A8683'],
            ]
        );
        $col->getOptions()->setTitle('Bmr / Macros');
        $col->getOptions()->getLegend()->setPosition('none');
        $col->getOptions()->getAnnotations()->setAlwaysOutside(true);
        $col->getOptions()->getAnnotations()->getTextStyle()->setFontSize(14);
        $col->getOptions()->getAnnotations()->getTextStyle()->setColor('#000');
        $col->getOptions()->getAnnotations()->getTextStyle()->setAuraColor('none');
        $col->getOptions()->setWidth(520);
        $col->getOptions()->setHeight(600);


        $bar = new BarChart();
        $bar->getData()->setArrayToDataTable([
            ['Quantité',  ['legend' => 'none'],['role' => 'style' ]],
            ['Carbohydrates', $carbohydrate, '#8ED3F4'],
            ['Graisses', $fat, '#328DAA'],
            ['Protéines', $protein, '#8A8683'],
            ['Sucre', $sugar, '#5A4D4C'],
            ['Energie', $energy, '#78D6AC']
        ]);
        $bar->getOptions()->setTitle('Consommation affichée en grammes');
        $bar->getOptions()->getLegend()->setPosition('none');
        $bar->getOptions()->getHAxis()->setMinValue(0);
        $bar->getOptions()->setWidth(530);
        $bar->getOptions()->setHeight(600);


        return $this->render('dashboard/dashboard.html.twig',[
            'calories' => $calories,
            'col' => $col,
            'bar' => $bar,
            'allUserMeal' => $allUserMeal,
            'user' => $user,
            'current_menu' => 'dashboard'
        ]);
    }

}