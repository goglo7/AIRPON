<?php

namespace App\Form;

use App\Entity\Direction;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserType extends AbstractType
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('cin')
            ->add('role', ChoiceType::class, [
                'choices' => ["ROLE_ADMIN", "ROLE_RESPONSABLE", "ROLE_CLIENTELE"],
                'choice_label' => fn($choice) => $choice,
                'choice_value' => fn($choice) => $choice,
                'getter' => fn(User $user) => $user->getRole(),
                'setter' => fn(User $user, $value) => $user->setRoles([$value])
            ])
            ->add("motDePasse", PasswordType::class, [
                'getter' => fn() => '',
                'setter' => fn(User $user, $value) => $user->setPassword($this->hasher->hashPassword($user, $value))
            ])
            ->add('matricule')
            ->add('postTravail')
            ->add('adressePersonelle')
            ->add('adresseProfessionelle')
            ->add('telFixe')
            ->add('telPortable')
            ->add('direction', EntityType::class, [
                'class' => Direction::class,
                'choice_label' => 'designation',
                "required" => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
