<?php

namespace App\Form;

use App\Entity\Purchase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CartConfirmationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Nome Cliente',
                'attr' => [
                    'placeholder' => 'nome completo per la consegna...'
                ]
            ])
            ->add('address', TextareaType::class, [
                'label' => 'Indirizzo del cliente',
                'attr' => [
                    'placeholder' => 'Indirizzo  di consegna'
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'codice postale',
                'attr' => [
                    'placeholder' => 'codice postale....'
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'codice postale',
                'attr' => [
                    'placeholder' => 'codice postale....'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Città',
                'attr' => [
                    'placeholder' => 'città ....'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Purchase::class
        ]);
    }
}
