<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matric_number', TextType::class,[
                "attr"=>["placeholder" => "e.g: 14xxxxxxx", "class" => "form-control1"],
                "label" => "Matric Number/Jamb Reg."])
            ->add('password', PasswordType::class,[
                "attr"=>["placeholder" => "e.g: minimum of 8 characters", "class" => "form-control1"]])
            ->add('confirmPassword', PasswordType::class,[
                "attr"=>["placeholder" => "Enter matched password", "class" => "form-control1"],
                "label" => "Confirm Password"]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
