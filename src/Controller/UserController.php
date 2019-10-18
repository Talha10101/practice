<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\AppStudentType;
use App\Form\Type\StudentType;

use App\Entity\Student;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class UserController extends Controller

{

    public function studentRigAction(Request $request)
    {
        $task = new Student();
        $user = new User();
//         ...


        $form = $this->createForm(AppStudentType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            var_dump($form->getData());die;
//            var_dump($form->getData());die;
            $this->saveData( $form->getData(),$request);

            return $this->redirectToRoute('login');
        }
        return $this->render('student/std_registration.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function viewUserDataAction(){

        return $this->render('student/login.html.twig');

    }


    public function saveData($form,$request)
    {
        $entityManager = $this->getDoctrine()->getManager();
//        $userManager = $this->get('fos_user.util.user_manipulator');
//        $user = $userManager->createUser();
//        $user->setUsername($username);
//        $user->setEmail($email);
//        $user->setPlainPassword($password);
//        $user->setEnabled((bool) $active);
//        $user->setSuperAdmin((bool) $superadmin);


        $user = new User();
//        var_dump($form->getUser()->getpassword());die;
//        $pass = $this->get(UserPasswordEncoder::class)->encodePassword(12345);

        $passwordEncoder = $this->container->get('security.password_encoder');
        $pass =  $passwordEncoder->encodePassword($user,$form->getUser()->getpassword() );

        $user->setUsername($form->getUser()->getEmail());
        $user->setEmail($form->getUser()->getEmail());
        $user->setPassword($pass);
//        $this->get(UserManager::class)
        $user->setRoles(array('Student'));
        $user->setEnabled(1);
        $entityManager->persist($user);
        $entityManager->flush();

//        $userManager->updateUser($user);

//        $event = new UserEvent($user, $request);
//        $this->get('debug.event_dispatcher')->dispatch(FOSUserEvents::USER_CREATED, $event);

//        var_dump($user->getId());die;
//        var_dump(($form->getUser()->getid()));die;

        $student= new Student();
        $student->setProgram($form->getProgram());
        $student->setAge($form->getAge());
        $student->setGender($form->getGender());
        $student->setPhone($form->getPhone());
        $student->setUser($user);
//        var_dump($student);die;
//        var_dump();die;
        $entityManager->persist($student);
        $entityManager->flush();
        return $student;

    }
}