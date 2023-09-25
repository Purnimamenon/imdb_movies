<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\AdminType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class RegisterController extends AbstractController
{

    private $entityManager;
    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    
    }



    #[Route('/', name: 'index')]
    public function register(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->persist($user);
            $this->entityManager->flush();


            return $this->redirectToRoute('login');

        }

        return $this->render('user/user_register.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/login', name: 'admin')]
    public function login(Request $request ,SessionInterface $session): Response
    {

        $user = new User();
        
        $form = $this->createForm(AdminType::class, $user);

        $form->handleRequest($request);

    
        if ($form->isSubmitted() && $form->isValid()) {
    
            $user = $this->userRepository->findOneByEmail($form->get('email')->getData());
            // var_dump($user->getRoles());
            // die;
            if(!$user){
                $this->addFlash('notice', 'Invalid user credentials.Please Register here');
                return $this->redirectToRoute('index');
                
            }
            else if ($user->getRoles() == 'User') {


                // $session = $this->get('session');
                // $session->set('user_id', $user->getId());

                // Get the user ID from the session.
                $userId = $user->getId();
            
                return $this->redirectToRoute('user_dashboard', ['userId' => $userId]);
            }
            else if($user->getRoles() == 'Admin'){
                

                return $this->render('admin/dashboard.html.twig');
                
                //$this->addFlash('error', 'Invalid user credentials.');
            }

           
        }
    
        return $this->render('user/login.html.twig', [
            'form' => $form->createView(),
        ]);
        
      
    }


    public function logout(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        // Invalidate the session.
        $request->getSession()->invalidate();

        // Redirect the user to the homepage.
        return $this->redirectToRoute('index');
    }


}
