<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('firstName', TextType::class, ['label' => 'Prénom', 'attr' => ['placeholder' => 'Louis']])
            ->add('lastName', TextType::class, ['label' => 'Nom', 'attr' => ['placeholder' => 'Jean Dubois']])
            ->add('email')
            // ->add('roles')

            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => ['placeholder' => '●●●●●●●●●●'],
            ])
            ->add('passwordConfirm', PasswordType::class, [
                'label' => 'Confirmer le mot de passe',
                'attr' => ['placeholder' => '●●●●●●●●●●'],
            ])

            ->add('submit', SubmitType::class, ['label' => "S'inscrire", 'attr' => ['class' => 'btn btn-success col-12']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
