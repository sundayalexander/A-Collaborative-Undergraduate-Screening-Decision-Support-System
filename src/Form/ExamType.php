<?php

namespace App\Form;

use App\Entity\Exam;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class,[
                "attr" => ["class"=>"form-control1"],
                "choices" => ["--Select Exam Type--"=>"null",
                    "WAEC" => "WAEC", "NECO" => "NECO"]])
            ->add('result', FileType::class,[
                "attr" => ["class" => "form-control1",
                    "accept"=>"image/jpg,image/jpeg,image/png"],
                "label"=>"Result (jpeg, jpg, png)"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exam::class,
        ]);
    }
}
