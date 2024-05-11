<?php

namespace App\Form;

use App\Entity\Olt;
use App\Entity\Projet;
use App\Entity\TypeOlt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OltType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('loc')
            ->add('gps')
            ->add('adresse')
            ->add('dateInstallation', null, [
                'widget' => 'single_text',
            ])
            ->add('vlanManagement')
            ->add('portMetro')
            ->add('capacitePortMetro')
            ->add('adresseManagement')
            ->add('projet', EntityType::class, [
                'class' => Projet::class,
                'choice_label' => 'nom',
            ])
            ->add('type', EntityType::class, [
                'class' => TypeOlt::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Olt::class,
        ]);
    }
}
