<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,[
                "attr" => ["class" => "form-control1","placeholder"=>"e.g john.doe"]
            ])
            ->add('password', PasswordType::class,[
                "attr" => ["class" => "form-control1","placeholder"=>"minimum of 8 characters"]
            ])
            ->add('unit', ChoiceType::class,[
                "attr" => ["class" => "form-control1"],
                "choices" => [
                    "--Select a valid Unit--" => "null",
                    "Admission Unit" => "AdminUnit",
                    "University Health Service" => "HealthService",
                    "Faculty" => "Faculty",
                    "Student Affairs Unit" => "StudentAffairs",
                    "Exams and Records" => "ExamsAndRecords"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
