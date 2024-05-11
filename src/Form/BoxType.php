<?php

namespace App\Form;

use App\Entity\Box;
use App\Entity\CableInterBox;
use App\Entity\CType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gps')
            ->add('adresse')
            ->add('dateInstallation', null, [
                'widget' => 'single_text',
            ])
            ->add('cType', EntityType::class, [
                'class' => CType::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Box::class,
        ]);
    }
}
