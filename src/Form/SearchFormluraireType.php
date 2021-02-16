<?php

namespace App\Form;

use App\Entity\Campus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormluraireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('campus', TextType::class, [
                'label' => 'Campus : ',
                'required' => false,

//                'placeholder' => ' choisir un campus : ',
            ])
            ->add('nomContient', TextType::class, [
                'label' => 'Le nom de la sortie contient : ',
                'required' => false,
//                'placeholder' => '...'
            ])
            ->add('dateDebut', DateTimeType::class, [
                'label' => 'Entre : ',
                "date_widget" => "single_text",
                "time_widget" => "single_text",
                'required' => false,
            ])
            ->add('dateFin', DateTimeType::class, [
                'label' => 'et : ',
                "date_widget" => "single_text",
                "time_widget" => "single_text",
                'required' => false,
            ])
            ->add('organisateur', CheckboxType::class, [
                'label' => 'Sorties dont je suis l\'organisateur/trice',
                'required' => false,
            ])
            ->add('inscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je suis inscrit/e',
                'required' => false,
            ])
            ->add('pasInscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je ne suis pas inscrit/e',
                'required' => false,
            ])
            ->add('sortiesPassees', CheckboxType::class, [
                'label' => 'Sorties passées',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                "label" => "Rechercher",
                'attr' => [
                    'class' => 'btn '
                ]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
