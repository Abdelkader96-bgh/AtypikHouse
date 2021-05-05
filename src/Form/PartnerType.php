<?php

namespace App\Form;

use App\Entity\Base\Partner;
use Symfony\Component\Form\AbstractType;
use App\Entity\Base\Images;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
           ->add('nom',TextType::class ,[
            'attr' => [
             'placeholder' => "garder le même nom "
              ]
            ])
            ->add('prenom',TextType::class, [
                'attr' => [
                 'placeholder' => " garder le même prénom "
                  ]
                ])
            //->add('password',PasswordType::class)
            ->add('email',EmailType::class, [
                'attr' => [
                 'placeholder' => " garder le même email  "
                  ]
                ])
           // ->add('confirm_password',PasswordType::class)
            ->add('telephone',NumberType::class)
            ->add('nom_entreprise',TextType::class)
            ->add('statut',ChoiceType::class,[
                'choices' => [
                    'particulier' => 'Particulier',
                    'professionnel' => 'Profetionnel',
                ]
            ])
            ->add('codePostal',NumberType::class)
            ->add('ville',TextType::class)
            ->add('departement',ChoiceType::class, [
                'choices' => [
                    'val-doise' => 'Val-de-loise',
                    'val-de-marne' => 'Val-de-Marne',
                    'essone' => 'Essonne',
                    'seine-saint-denis' =>'Seine-Saint-Denis',
                ],
                'attr' => [
                    'placeholder' => "Veuillez sélectionner un département "
                ]
            ])
            ->add('regeion',ChoiceType::class, [
                'choices' => [
                    'bretagne' => 'Bretagne',
                    'corse' => 'Corse',
                    'ile-de-france' => 'ile-de-France',
                    'la réunion' =>'La Réunion'
                ],
                    'attr' => [
                     'placeholder' => "Veuillez sélectionner une région "
             ]

            ])

            ->add('typologie',ChoiceType::class, [
                'choices' => [
                    'cabane dans les arabes' => 'Cabane dans les arabes',
                    'cabane flottant' => 'Cabane flottant',
                    'yourte' => 'Yourte',
                    'habitat Insolite' =>'Habitat Insolite'
                ],
                'expanded' => true,
                'multiple'=> true  ,
            ])
            ->add('commentaire',TextareaType::class, [
                'attr' => [
                 'placeholder' => "Détailer les équipements et les services disponibles Exp: (petit déjeuner à volonté, linge de lit...) "
         ]
                ])
            ->add('partenaire',ChoiceType::class, [
                'choices' => [
                    'airbnb' => 'AirBnb',
                    'booking' => 'Booking',
                    'cabane de france' => 'Cabanes de France',
                    'abritel' =>'Abritel'
                ],
                'expanded' => true,
                'multiple'=> true  ,
            ])
            ->add('images', FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                 'constraints' => [
                        new All([
                            new File([
                                'maxSize' => '2000M',
                                 ])
                             ])
               ]
        ]); 
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
