<?php

namespace App\Form;

use App\Entity\CategoryIngredient;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('categoryIngredient',EntityType::class,[
                'class'=>CategoryIngredient::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true,
            ])
            ->add('quantity')
            ->add('carbohydrate')
            ->add('fat')
            ->add('protein')
            ->add('sugar')
            ->add('energy')
            ->add('created_by')
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
