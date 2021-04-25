<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
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
     * @Route("/user", name="user.show")
     * @return Response
     */
    public function index() : Response
    {
        $user = $this->security->getUser();
        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'current_menu' => 'profile'
        ]);
    }


}