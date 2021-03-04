<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Entreprise;
use App\Entity\Promotion;
use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('stringSearch',TextType::class,[
                'label'=>'Rechercher',
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'Rechercher',
                    'title'=>'Entrez votre recherche',
                    'autocomplete'=>'given-name'
                ]
            ])
            ->add('entreprise',EntityType::class,[
                'label'=>'Entreprise',
                'required'=>false,
                'class'=>Entreprise::class,
            ])
            ->add('promotion',EntityType::class,[
                'label'=>'Promotion',
                'required'=>false,
                'class'=>Promotion::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection'=>false
        ]);
    }

    public function getBlockPrefix(){
        return '';
    }
}
