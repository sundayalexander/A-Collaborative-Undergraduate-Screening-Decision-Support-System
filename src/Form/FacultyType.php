<?php

namespace App\Form;

use App\Entity\Faculty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FacultyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prospectus',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"]])
            ->add('matric_gown',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"],
                "label" => "Matric Gown"])
            ->add('due',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"],
                "label" => "Faculty Due"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Faculty::class,
        ]);
    }
}
