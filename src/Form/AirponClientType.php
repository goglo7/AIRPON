<?php

namespace App\Form;

use App\Entity\AirponClient;
use App\Entity\Box;
use App\Entity\Client;
use App\Entity\ModemOnt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AirponClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('port')
            ->add('longueur')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'nom',
            ])
            ->add('box', EntityType::class, [
                'class' => Box::class,
                'choice_label' => 'adresse',
            ])
            ->add('modemOnt', EntityType::class, [
                'class' => ModemOnt::class,
                'choice_label' => 'numSerie',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AirponClient::class,
        ]);
    }
}
