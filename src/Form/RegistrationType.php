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
            ->add('username', null, ['label' => 'form.user.username'])
            ->add('firstname', null, ['label' => 'form.user.firstname'])
            ->add('name', null, ['label' => 'form.user.name'])
            ->add('email', null, ['label' => 'form.user.email'])
            ->add('password', null, ['label' => 'form.user.password'])
            ->add('weight', null, ['label' => 'form.user.weight'])
            ->add('height', null, ['label' => 'form.user.height'])
            ->add('age', null, ['label' => 'form.user.age'])
            ->add('gender', ChoiceType::class, [
                'label' => 'form.user.gender',
                'choices' => $this->getChoicesGender()
            ])
            ->add('activity', ChoiceType::class, [
                'label' => 'form.user.activity',
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
