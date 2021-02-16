<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la sortie :'
            ])
            ->add('dateHeureDebut', DateTimeType::class, [
                'label' => 'Date et heure de la sortie :',
                'html5' => true,
                'attr' => ['class' => 'js-datepicker'],
                'widget' => 'single_text'
            ])
            ->add('duree', TimeType::class, [
                'label' => 'Duree :',
                'html5' => true,
                'attr' => ['class' => 'js-datepicker'],
                'widget' => 'single_text'
            ])
            ->add('dateLimiteInscription', DateType::class, [
                'label' => 'Date limite d\'inscription :',
                'html5' => true,
                'attr' => ['class' => 'js-datepicker'],
                'widget' => 'single_text'
            ])
            ->add('nbInscriptionMax', NumberType::class, [
                'label' => 'Nombre de places :'
            ])
            ->add('infosSortie', TextareaType::class, [
                'label' => 'Description et Information :'
            ])
            ->add('campus', EntityType::class, [
                'label' => 'Campus :',
                'placeholder' => 'choisir un campus',
                'class' => Campus::class,
            ])
            ->add('ville', EntityType::class, [
                'label' => 'Ville :',
                'placeholder' => 'choisir une ville',
                'class' => Ville::class,
//                'attr' => ['class' => 'test']
            ])
            ->add('lieu', EntityType::class, [
                'label' => 'Lieu :',
                'placeholder' => 'choisir une lieu',
                'class' => Lieu::class,
            ])
//            ->add('rue', TextType::class, [
//                'label' => 'Rue :',
//                'required' => false
//            ])
//            ->add('codePostal', TextType::class, [
//                'label' => 'CodePostal :'
//            ])
//            ->add('latitude', NumberType::class, [
//                'label' => 'Latitude :'
//            ])
//            ->add('longitude', NumberType::class, [
//                'label' => 'Longitude :'
//            ]);
            ->add('enregistrer', SubmitType::class, [
            'label' => 'Enregistrer',
                "attr"=>["value"=>"enregistrer"]
            ])
            ->add('publier', SubmitType::class, [
                'label' => 'Publier',
                "attr"=>["value"=>"publier"]
            ])
            ->add('annuler', SubmitType::class, [
                'label' => 'Annuler',
                "attr"=>["value"=>"annuler"]
            ])
            ->add('supprimer', SubmitType::class, [
                'label' => 'Supprimer',
                "attr"=>["value"=>"supprimer"]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
