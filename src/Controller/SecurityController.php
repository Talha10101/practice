<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
//    /**
//     * @Route("/login", name="app_login")
//     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        die;
        // if ($this->getUser()) {
        //    $this->redirectToRoute('target_path');
        // }








        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
//        $user = $this->getDoctrine()->getManager()->getRepository("App\Entity\User")->findAll();
        $lastUsername = $authenticationUtils->getLastUsername();
//        var_dump($user->getpassword());die();

//        $token = new UsernamePasswordToken($user, $user->getpassword(), 'main', $user->getRoles());

//        $this->get('security.token_storage')->setToken($token);
        return $this->render('/security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
