<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\AppStudentType;
use App\Form\Type\StudentType;

use App\Entity\Student;
use App\Repository\StudentRepository;
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
             $this->saveData( $form->getData(),$request);
            return $this->redirectToRoute('login');
        }
        return $this->render('student/std_registration.html.twig', [
            'form' => $form->createView()
        ]);

    }
    public function homeAction(Request $request)
    {

        return $this->render('student/home.html.twig');

    }

    public function viewUserDataAction(){

          $id = $this->getUser();
          $user = $this->getDoctrine()->getManager()->getRepository( Student::class)->findUsers($id);
        return $this->render('student/login.html.twig',array('data'=>$user));

    }

    public function UserdashboardAction(){

        $id = $this->getUser();
        $user = $this->getDoctrine()->getManager()->getRepository( Student::class)->findUsers($id);
        if($id->hasrole('ROLE_STUDENT')){

             return $this->render('student/login.html.twig',array('data'=>$user));

        }elseif($id->hasrole('ROLE_Tutor')){
            return $this->render('student/login.html.twig',array('data'=>$user));
         }elseif($id->hasrole('ROLE_Academic')){
            return $this->render('student/login.html.twig',array('data'=>$user));
         }
            return $this->render('student/login.html.twig',array('data'=>$user));

//         var_dump($id);die;

    }


    public function saveData($form,$request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $roleobj=$request->request->get('app_student');
//        var_dump($roleobj);
//
//        echo $roleobj['user']['roles'];
//        die;
        $user = new User();;
//        $role = $form->get('roles')->getData();

        $passwordEncoder = $this->container->get('security.password_encoder');
        $pass =  $passwordEncoder->encodePassword($user,$form->getUser()->getpassword() );
        $user->setUsername($form->getUser()->getEmail());
        $user->setEmail($form->getUser()->getEmail());
        $user->setPassword($pass);
        $user->setRoles(array($roleobj['user']['roles']));
        $user->setEnabled(1);
        $entityManager->persist($user);
        $entityManager->flush();
        $student= new Student();
        $student->setProgram($form->getProgram());
        $student->setAge($form->getAge());
        $student->setGender($form->getGender());
        $student->setPhone($form->getPhone());
        $student->setUser($user);
        $entityManager->persist($student);
        $entityManager->flush();
        return $student;

    }

    public  function updateStudent( Request $request ){




        $id = $this->getUser()->getid();
        $em=$this->getDoctrine()->getManager();
        $student=$em->getRepository(Student::class)->findOneBy(['user'=>$id]);
        $form=$this->createForm(StudentType  ::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $article = $request->request->all();
            $studentdata = $student;
            $studentdata->setAge($article['student']['age']);
            $studentdata->setProgram($article['student']['program']);
            $studentdata->setPhone($article['student']['phone']);
            $studentdata->setGender($article['student']['gender']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($studentdata);
            $entityManager->flush();
            $this->addFlash('success', 'Your profile has been update');

            return $this->redirectToRoute('login_student',array('data'=>$studentdata) );

        }

        return $this->render(
            'student/Update_Student.html.twig',
            array('student' => $form->createView())
        );





    }
}