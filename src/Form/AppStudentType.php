<?php

namespace App\Form;

use App\Entity\Student;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('age',\Symfony\Component\Form\Extension\Core\Type\NumberType::class)
            ->add('program', ChoiceType::class, array('required' => false,
                'choices' => array('Nine' => 'ine ', 'Tenth' => 'tenth','Intermediate'=>'inter','BSCS'=>'BSCS','NTS'=>'NTS','CSS'=>'CSS')))

//            ->add('program')
            ->add('phone',\Symfony\Component\Form\Extension\Core\Type\IntegerType::class)
            ->remove('password',PasswordType::class)
            ->add('gender', ChoiceType::class, array('required' => false, 'choices' => array('male' => 'Male', 'female' => 'Female')))
            ->add('user', UserType::class)

//            ->add('gender',TextType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
