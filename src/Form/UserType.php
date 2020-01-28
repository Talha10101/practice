<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roles = array(
            'Student'        => 'Role_Student',
            'Academic'     => 'Role_Academic',
            'Tutor'     => 'Role_Tutor'
        );
        $builder

            ->add('username',TextType::class)
//            ->add('usernameCanonical')
            ->add('email',EmailType::class)
//            ->add('emailCanonical')
//            ->add('enabled')
//            ->add('salt')
            ->add('password', PasswordType::class)
//            ->add('lastLogin')
//            ->add('confirmationToken')
//            ->add('passwordRequestedAt')
//            ->add('roles',TextType::class)
//            ->add('roles', ChoiceType::class, array('required' => false, 'choices' => array('Role_Student' => 'Student', 'Role_Academic' => 'Academic', '' => 'Tutor')))
            ->add('roles', ChoiceType::class, array(
                'mapped' => false,
                'required' => true,
//                    'expanded'   => true,
                    'choices' => $roles

                )
               );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
