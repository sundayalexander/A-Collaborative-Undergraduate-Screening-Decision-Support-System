<?php

namespace App\Form;

use App\Entity\HealthService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HealthServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lab_test', FileType::class,[
                "attr" => ["class"=>"form-control1","accept"=>"image/jpg,image/jpeg,image/png"],
                "label" => "Lab Test"
            ])
            ->add('x_ray', FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"],
                "label" => "X-Ray"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HealthService::class,
        ]);
    }
}
