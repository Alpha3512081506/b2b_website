<?php

namespace App\Form;

use App\Entity\Prodotto;
use App\Entity\Categoria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProdottoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomeStile', TextType::class, [
                'label' => 'Nome del Prodotto',
                'attr' => [
                    'placeholder' => 'Nome del stile del prodottto',
                    'class' => 'form-control'
                ]
            ])
            ->add('marca', TextType::class, [
                'label' => 'Marca del Prodotto',
                'attr' => [
                    'placeholder' => 'marca del prodotto',
                    'class' => 'form-control'
                ]
            ])
            ->add('modelloCPU', TextType::class, [
                'label' => 'Modello del Prodotto',
                'attr' => [
                    'placeholder' => 'modello prodotto',
                    'class' => 'form-control'
                ]
            ])
            ->add('dimensioniRAM', TextType::class, [
                'label' => 'Dimensioni RAM del Prodotto',
                'attr' => [
                    'placeholder' => 'dimesioni del RAM',
                    'class' => 'form-control'
                ]
            ])
            ->add('colore', TextType::class, [
                'attr' => [
                    'placeholder' => 'color del prodotto',
                    'class' => 'form-control'
                ]
            ])
            ->add('coverImage', FileType::class, [
                'label' => false,
                'multiple' => false,
                'mapped' => false,
                'required' => true
            ])
            ->add('dimensioniSchermo', TextType::class, [
                'label' => 'Dimensioni dello Schermo del Prodotto',
                'attr' => [
                    'placeholder' => 'dimensioni dello schermo del prodotto',
                    'class' => 'form-control'
                ]
            ])
            ->add('commento', TextareaType::class, [
                'label' => 'Descrizione del Prodotto',
                'attr' => [
                    'placeholder' => 'un commento sul prodotto',
                    'class' => 'form-control'
                ]
            ])
            ->add('prezzo', MoneyType::class, [
                'label' => 'Prezzo del Prodotto',
                'attr' => [
                    'placeholder' => 'prezzo del prodotto',
                    'class' => 'form-control'
                ]
            ])

            ->add('categoria', EntityType::class, [
                'class' => Categoria::class,
                'choice_label' => function (Categoria $categoria) {
                    return strtoupper($categoria->getNomeCategoria());
                },
                'placeholder' => '--Scegli una categoria--',
                'attr' => ['class' => 'form-control']

            ]);
        /* ->add('imaggines', CollectionType::class, [
                'label' => 'imaggine legate al prodotto',
                'entry_type' => ImageType::class,
                'allow_add' => true

            ]); */
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prodotto::class,
        ]);
    }
}
