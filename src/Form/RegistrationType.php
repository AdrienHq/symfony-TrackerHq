<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('firstname')
            ->add('name')
            ->add('email')
            ->add('password')
            ->add('weight')
            ->add('height')
            ->add('age')
            ->add('gender', ChoiceType::class, [
                'choices' => $this->getChoicesGender()
            ])
            ->add('activity', ChoiceType::class, [
                'choices' => $this->getChoicesActivity()
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
