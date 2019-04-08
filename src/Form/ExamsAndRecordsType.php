<?php

namespace App\Form;

use App\Entity\ExamsAndRecords;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamsAndRecordsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jambLetter',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"],
                "label" => "Jamb Admission Letter"])
            ->add('aauaLetter', FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"],
                "label" => "AAUA Admission Letter"])
            ->add('birthCertificate',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"]])
            ->add('stateOfOrigin',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"]])
            ->add('attestationLetter',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"]])
            ->add('jambResult',FileType::class,[
                "attr" => ["class" => "form-control1","accept"=>"image/jpg,image/jpeg,image/png"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ExamsAndRecords::class,
        ]);
    }
}
