<?php

namespace App\Form;

use App\Entity\Direction;
use App\Entity\TypeDirection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DirectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('designation')
            ->add('type', EntityType::class, [
                'class' => TypeDirection::class,
                'choice_label' => 'name',
            ])
            ->add('parent', EntityType::class, [
                'class' => Direction::class,
                'choice_label' => 'designation',
                "required" => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Direction::class,
        ]);
    }
}
