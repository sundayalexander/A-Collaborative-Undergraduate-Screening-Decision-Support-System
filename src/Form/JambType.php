<?php

namespace App\Form;

use App\Entity\Jamb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;

class JambType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $subjects = ["English Language" => "English Language",
            "Mathematics" =>"Mathematics",
            "Chemistry" => "Chemistry",
            "Physics" => "Physics",
            "Economics" => "Economics"];
        $builder
            ->add('jambNumber', TextType::class,[
                "attr"=> ["class"=>"form-control1","placeholder"=>"e.g: 453xxxxx"]
            ])
            ->add('subject_1', ChoiceType::class,[
                "attr" => ["class" => "form-control1"],
                "choices" => array_merge(["--Select Subject--" => "null"], $subjects),
                "constraints" =>[new Choice(["choices"=>array_values($subjects),
                    "message"=>"Please select a valid subject"])]
            ])
            ->add('subject_2', ChoiceType::class,[
                "attr" => ["class" => "form-control1"],
                "choices" => array_merge(["--Select Subject--" => "null"], $subjects),
                "constraints" =>[new Choice(["choices"=>array_values($subjects),
                    "message"=>"Please select a valid subject"])]
            ])
            ->add('subject_3', ChoiceType::class,[
                "attr" => ["class" => "form-control1"],
                "choices" => array_merge(["--Select Subject--" => "null"], $subjects),
                "constraints" =>[new Choice(["choices"=>array_values($subjects),
                    "message"=>"Please select a valid subject"])]
            ])
            ->add('subject_4', ChoiceType::class,[
                "attr" => ["class" => "form-control1"],
                "choices" => array_merge(["--Select Subject--" => "null"], $subjects),
                "constraints" =>[new Choice(["choices"=>array_values($subjects),
                    "message"=>"Please select a valid subject"])]
            ])
            ->add("score1", IntegerType::class,[
                "attr" => ["class" => "form-control1"],
                "label" => "Score:",
                "constraints" =>[new GreaterThanOrEqual(0), new LessThanOrEqual(100)]])
            ->add("score2", IntegerType::class,[
                "attr" => ["class" => "form-control1"],
                "label" => "Score:",
                "constraints" =>[new GreaterThanOrEqual(0), new LessThanOrEqual(100)]])
            ->add("score3", IntegerType::class,[
                "attr" => ["class" => "form-control1"],
                "label" => "Score:",
                "constraints" =>[new GreaterThanOrEqual(0), new LessThanOrEqual(100)]])
            ->add("score4", IntegerType::class,[
                "attr" => ["class" => "form-control1"],
                "label" => "Score:",
                "constraints" =>[new GreaterThanOrEqual(0), new LessThanOrEqual(100)]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jamb::class,
        ]);
    }
}
