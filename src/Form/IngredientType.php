<?php

namespace App\Form;

use App\Entity\CategoryIngredient;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'form.ingredient.name'])
            ->add('description', null, ['label' => 'form.ingredient.description'])
            ->add('quantity', CheckboxType::class, ['label' =>'form.ingredient.quantity' , 'required' => false])
            ->add('categoryIngredient',EntityType::class,[
                'class'=>CategoryIngredient::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true,
            ])
            ->add('carbohydrate', null, ['label' => 'form.ingredient.carbohydrate'])
            ->add('fat', null, ['label' => 'form.ingredient.fat'])
            ->add('protein', null, ['label' => 'form.ingredient.protein'])
            ->add('sugar', null, ['label' => 'form.ingredient.sugar'])
            ->add('energy', null, ['label' => 'form.ingredient.energy'])
            ->add('created_by', null, ['label' => 'form.ingredient.createdby'])
            ->add('imageFile', FileType::class,[
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Ingredient::TYPE;
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
