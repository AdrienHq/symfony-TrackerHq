<?php

namespace App\Form;

use App\Entity\Meal;
use App\Entity\Recipe;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'form.meal.type',
                'choices' => $this->getChoicesType()
            ])
            ->add('mealIngredient',EntityType::class,[
                'label' => 'form.meal.ingredient',
                'class'=>Ingredient::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true,
            ])
            ->add('mealRecipes',EntityType::class,[
                'label' => 'form.meal.recipes',
                'class'=>Recipe::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Meal::class,
        ]);
    }

    private function getChoicesType()
    {
        $choices = Meal::TYPE; 
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
