<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface 
    */
    private $passwordEncoder;

    public function __construct(UserRepository $repository, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

   /**
     * @Route("/inscription", name="inscription")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
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
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
            $user->setBrm($brm);
            $user->setRoles(['ROLE_USER']);
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'Creation successful');
            return $this->redirectToRoute('home');
        }
        return $this->render('security/registration.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}