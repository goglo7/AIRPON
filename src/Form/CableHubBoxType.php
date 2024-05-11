<?php

namespace App\Form;

use App\Entity\Box;
use App\Entity\CableHubBox;
use App\Entity\Hub;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CableHubBoxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('longueur')
            ->add('dateInstallation', null, [
                'widget' => 'single_text',
            ])
            ->add('hub', EntityType::class, [
                'class' => Hub::class,
                'choice_label' => 'adresse',
            ])
            ->add('box', EntityType::class, [
                'class' => Box::class,
                'choice_label' => 'adresse',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CableHubBox::class,
        ]);
    }
}
