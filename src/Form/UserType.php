<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
//            ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
