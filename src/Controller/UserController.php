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
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Security
     */
    private $security;


    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @Route("/{_locale}/user", name="user.show")
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
     * @Route("/{_locale}/user/{id}", name="user.modify", methods="GET|POST")
     */
    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $brm = ( ($user->getWeight()*10)+($user->getHeight()*6.25)-(5*$user->getAge())+5);
            if( $user->getGender() == 0 ){
                $brm += 5;
            } else {
                $brm -= 161;
            }
            if($user->getActivity() == 0){
                $brm *= 1.2;
            } 
            if( $user->getActivity() == 1){
                $brm *= 1.55;
            }
            if( $user->getActivity() == 2){
                $brm *= 1.725;
            }  
            if( $user->getActivity() == 3){
                $brm *= 1.9;
            }
            $user->setBrm($brm);


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