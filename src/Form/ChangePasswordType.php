<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, ['label'=>'Email','disabled'=>true])
            // ->add('roles')
            // ->add('password')
            ->add('firstName',TextType::class, ['label'=>'Prenom','disabled'=>true])
            ->add('lastName',TextType::class, ['label'=>'Nom','disabled'=>true])
            ->add('oldPassword', PasswordType::class, ['required' => false ,
                'label' => 'Ancien mot de passe',
                'attr' => ['placeholder' => '●●●●●●●●●●'],
            ])
            ->add('newPassword', PasswordType::class, ['required' => false ,
                'label' => 'Nouveau mot de passe',
                'attr' => ['placeholder' => '●●●●●●●●●●'],
            ])
            ->add('confirmNewPassword', PasswordType::class, ['required' => false ,
                'label' => 'Confirmer le nouveau mot de passe',
                'attr' => ['placeholder' => '●●●●●●●●●●'],
            ])
            ->add('submit', SubmitType::class, ['label' => "Modifier mot de passe", 'attr' => ['class' => 'btn btn-success col-12']]);
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
