<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,
            [
                'required'   => true,
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Nom de l\'entreprise','title'=>'Entrez le nom','autocomplete'=>'given-name']
            ])
            ->add('adresse',TextType::class,
            [
                'required'   => true,
                'label' => 'Adresse',
                'attr' => ['placeholder' => 'Adresse de l\'entreprise','title'=>'Entrez l\'adresse','autocomplete'=>'given-name']
            ])
            ->add('ville',TextType::class,
            [
                'required'   => true,
                'label' => 'Ville',
                'attr' => ['placeholder' => 'Location de l\'entreprise','title'=>'Entrez la ville','autocomplete'=>'given-name']
            ])
            ->add('codePostal',TextType::class,
            [
                'required'   => true,
                'label' => 'Code Postal',
                'attr' => ['placeholder' => 'CP de l\'entreprise','title'=>'Entrez le code postal','autocomplete'=>'given-name']
            ])
            ->add('telephone',TextType::class,
            [
                'required'   => true,
                'label' => 'Téléphone',
                'attr' => ['placeholder' => 'Numéro de l\'entreprise','title'=>'Entrez le numéro de téléphone','autocomplete'=>'given-name']
            ])
            ->add('email',EmailType::class,
            [
                'required'   => true,
                'label' => 'E-mail',
                'attr' => ['placeholder' => 'E-mail de l\'entreprise','title'=>'Entrez l\'email','autocomplete'=>'given-name']
            ])
            ->add('typeEntreprise',ChoiceType::class,
            [
                'required'   => true,
                'label' => 'Type',
                'choices'  => [
                    'Entreprise Stage' => 0,
                    'Entreprise Alternance' => 1,
                    'Entreprise Stage & Alternance' => 2,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
