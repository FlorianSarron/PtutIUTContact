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
                'attr' => ['placeholder' => 'Nom du contact']
            ])
            ->add('prenom', TextType::class,[
                'attr' => ['placeholder' => 'Prénom du contact']
            ])
            ->add('adresse', TextType::class,[
                'attr' => ['placeholder' => 'Adresse du contact']
            ])
            ->add('ville', TextType::class,[
                'attr' => ['placeholder' => 'Location du contact']
            ])
            ->add('codePostal', TextType::class,[
                'attr' => ['placeholder' => 'CP du contact']
            ])
            ->add('telephone', TextType::class,[
                'attr' => ['placeholder' => 'Numéro du contact']
            ])
            ->add('email', EmailType::class,[
                'attr' => ['placeholder' => 'Email du contact']
            ])
            ->add('fonction', TextType::class,[
                'attr' => ['placeholder' => 'Fonction du contact']
            ])
            ->add('entreprise', TextType::class,[
                'attr' => ['placeholder' => 'Entreprise du contact']
            ])
            ->add('promotion', TextType::class,[
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
