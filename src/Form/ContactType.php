<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Entreprise;
use App\Entity\Promotion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Nom du contact','title'=>'Entrez le nom','autocomplete'=>'given-name']
            ])
            ->add('prenom', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Prénom du contact','title'=>'Entrez le prénom','autocomplete'=>'given-name']
            ])
            ->add('adresse', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Adresse du contact','title'=>'Entrez l\'adresse','autocomplete'=>'given-name']
            ])
            ->add('ville', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Location du contact','title'=>'Entrez la ville','autocomplete'=>'given-name']
            ])
            ->add('codePostal', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'CP du contact','title'=>'Entrez le code postal','autocomplete'=>'given-name']
            ])
            ->add('telephone', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Numéro du contact','title'=>'Entrez le numéro de téléphone','autocomplete'=>'given-name']
            ])
            ->add('email', EmailType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Email du contact','title'=>'Entrez l\'email','autocomplete'=>'given-name']
            ])
            ->add('fonction', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Fonction du contact','title'=>'Entrez le fonction','autocomplete'=>'given-name']
            ])
            ->add('entreprise', EntityType::class,[
                'required'   => false,
                'attr' => ['placeholder' => 'Entreprise du contact','title'=>'Entrez l\'entreprise','autocomplete'=>'given-name'],
                'class' => Entreprise::class
            ])
            ->add('promotion', EntityType::class,[
                'required'   => false,
                'attr' => ['placeholder' => 'Promotion du contact','title'=>'Entrez la promotion','autocomplete'=>'given-name'],
                'class' => Promotion::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
