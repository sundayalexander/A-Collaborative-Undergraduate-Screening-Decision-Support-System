<?php

namespace App\Form;

use App\Entity\AdminUnit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminUnitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class,[
                "attr" => ["class" => "form-control","placeholder"=>"e.g John"]
            ])
            ->add('middle_name', TextType::class,[
                "attr" => ["class" => "form-control","placeholder"=>"e.g Doe"]]
            )
            ->add('last_name', TextType::class,[
                "attr" => ["class" => "form-control","placeholder"=>"e.g Smith"]]
            )
            ->add('dob', DateType::class,[
                "attr" => ["class" => "form-control"],
                    "label" => "Date Of Birth"]
            )
            ->add('email', EmailType::class, [
                "attr" => ["class" => "form-control","placeholder"=>"e.g johndoe@domain.example"]]
            )
            ->add('phone_number', TelType::class,[
                "attr" => ["class" => "form-control","placeholder"=>"e.g +2348xxxxx"]]
            )
            ->add('r_address', TextType::class,[
                "attr" => ["class" => "form-control","placeholder"=>"e.g Block C 45..."],
                "label" => "Residential Address"]
            )
            ->add('p_address', TextType::class,[
                "attr" => ["class" => "form-control","placeholder"=>"e.g No. 28..."],
                "label" => "Home Address"]
            )
            ->add('putme_score', IntegerType::class,[
                "attr" => ["class" => "form-control","placeholder"=>"e.g 45"],
                    "label" => "PUTME score"]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdminUnit::class,
        ]);
    }
}
