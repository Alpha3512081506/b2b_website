<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'label' => 'vecchia password',
                'attr' => [
                    'placeholder' => 'vecchia password ....'
                ]
            ])
            ->add('newPassword', PasswordType::class, [
                'label' => 'nuova password',
                'attr' => [
                    'placeholder' => 'vecchia password ....'
                ]
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirm password',
                'attr' => [
                    'placeholder' => 'vecchia password ....'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
