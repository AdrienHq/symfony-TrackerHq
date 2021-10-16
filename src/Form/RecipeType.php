<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\IngredientQuantityInRecipe;
use App\Entity\Recipe;
use App\Form\IngredientQuantityInRecipeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'form.recipe.name'])
            ->add('description', null, ['label' => 'form.recipe.description'])
            /*
            ->add('ingredients',EntityType::class,[
                'class'=>IngredientQuantityInRecipe::class,
                'choice_label'=>'grams',
                'multiple'=>true,
                'expanded'=>true,
            ])
            */
            
            ->add('ingredients', CollectionType::class, [
                'entry_type' => IngredientQuantityInRecipeType::class
            ])
            
            /*
            ->add('ingredients',CollectionType::class,[
                'label' => 'form.meal.ingredient',
                'class'=>Ingredient::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true,
            ])
            */
            /*
            ->add('gramsInRecipe', CollectionType::class, [
                'entry_type' => IngredientQuantityInRecipeType::class,
                'allow_add' => true,
                'by_reference' => false,
            ])
            */
            
            ->add('imageFile', FileType::class,[
                'required' => false
            ])        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
