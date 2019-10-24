<?php

namespace App\Form;

use App\Entity\Student;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppStudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->remove('name',TextType::class)
            ->remove('email',EmailType::class)
            ->add('user', UserType::class)
            ->add('age',\Symfony\Component\Form\Extension\Core\Type\NumberType::class)
            ->add('program')
            ->add('phone',\Symfony\Component\Form\Extension\Core\Type\IntegerType::class)
            ->remove('password',PasswordType::class)
            ->add('gender',TextType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
