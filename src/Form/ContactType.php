<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Nom du contact']
            ])
            ->add('prenom', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Prénom du contact']
            ])
            ->add('adresse', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Adresse du contact']
            ])
            ->add('ville', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Location du contact']
            ])
            ->add('codePostal', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'CP du contact']
            ])
            ->add('telephone', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Numéro du contact']
            ])
            ->add('email', EmailType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Email du contact']
            ])
            ->add('fonction', TextType::class,[
                'required'   => true,
                'attr' => ['placeholder' => 'Fonction du contact']
            ])
            ->add('entreprise', TextType::class,[
                'required'   => false,
                'attr' => ['placeholder' => 'Entreprise du contact']
            ])
            ->add('promotion', TextType::class,[
                'required'   => false,
                'attr' => ['placeholder' => 'Promotion du contact']
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
