<?php

namespace App\Form;

use App\Entity\StudentAffairs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentAffairsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('handbook',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"]])
            ->add('aaua_cd',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"],
                "label" => "AAUA CD"])
            ->add('mobile_platform',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"],
                "label" =>"Mobile Platform"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StudentAffairs::class,
        ]);
    }
}
