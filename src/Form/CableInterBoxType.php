<?php

namespace App\Form;

use App\Entity\Box;
use App\Entity\CableInterBox;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CableInterBoxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateInstallation', null, [
                'widget' => 'single_text',
            ])
            ->add('source1', EntityType::class, [
                'class' => Box::class,
                'choice_label' => 'adresse',
            ])
            ->add('source2', EntityType::class, [
                'class' => Box::class,
                'choice_label' => 'adresse',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CableInterBox::class,
        ]);
    }
}
