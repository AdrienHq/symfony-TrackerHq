<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\RecipeRepository;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

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

     /**
     * @Route("/user/{id}", name="user.modify", methods="GET|POST")
     */
    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Edit successful');
            return $this->redirectToRoute('user.show');
        }
        return $this->render('user/modify.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }


}