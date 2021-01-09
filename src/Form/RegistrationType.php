<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'email',
                'attr' => [
                    'placeholder' => 'scrivere il mail de connessione'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'password',
                'attr' => [
                    'placeholder' => 'scrivere la password'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'le password sono diverse, inserisci password identiche.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Ripeti la password'],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Nome',
                'attr' => [
                    'placeholder' => 'scrivere il nome ......'
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Cognome',
                'attr' => [
                    'placeholder' => 'scrivere  il cognome ......'
                ]
            ])
            ->add('avatar', UrlType::class, [
                'label' => 'Foto profilo',
                'attr' => [
                    'placeholder' => 'scegli una fotor il tuo profilo'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
