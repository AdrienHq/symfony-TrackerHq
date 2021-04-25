<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Plan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('firstname')
            ->add('name')
            ->add('email')
            ->add('weight')
            ->add('height')
            ->add('age')
            ->add('activity', ChoiceType::class, [
                'choices' => $this->getChoicesActivity()
            ])   
            ->add('plan', EntityType::class, [
                'class' => Plan::class,
                'choice_label' => 'name'
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    private function getChoicesGender()
    {
        $choices = User::GENDER;
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }

    private function getChoicesActivity()
    {
        $choices = User::ACTIVITY;
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
