<?php

namespace App\Form;

use App\Entity\Base\Cabane;
use App\Entity\Base\Images;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\CountValidator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CabaneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $cabane = $builder->getData();

        $builder
            ->add('nom',TextType::class)
            ->add('destination',TextType::class)
            ->add('nbrPlace',IntegerType::class)
            ->add('dateDisponible',DateType::class, [
                'format' => 'dd-MM-yyyy ',
                'data' => $cabane->getDateDisponible() ? $cabane->getDateDisponible() : new \DateTime(),
                'years' => range(date('Y')-1, date('Y')+5),
            ])
            ->add('dateNondisponible',DateType::class, [
                'format' => 'dd-MM-yyyy',
                'data' => $cabane->getDateNondisponible() ? $cabane->getDateNondisponible() : new \DateTime(),
                'years' => range(date('Y')-1, date('Y')+5),
            ])
        
            ->add('type',ChoiceType::class, [
                'choices' => [
                    'cabane dans les arabes' => 'Cabane dans les arabes',
                    'cabane flottant' => 'Cabane flottant',
                    'yourte' => 'Yourte',
                    'habitat Insolite' =>'Habitat Insolite'
                ]
            ])
            ->add('hauteur',NumberType::class)
            ->add('equipment',TextType::class, [
                'attr' => [
                 'placeholder' => "Exemple: chauffage,salle de sport , 4 lit , cuisine équipé "
                  ]
                ])
            ->add('activite',TextareaType::class, [
                'attr' => [
                 'placeholder' => "Exemple: soirée inclus , visite des endroits  en groupe,...... "
                  ]
                ])
            ->add('commentaire',TextareaType::class, [
                'attr' => [
                 'placeholder' => "décrire votre projet en quelques lignes"

                    ]
                ])
            ->add('prix',IntegerType::class)
            ->add('seRestaurer',TextareaType::class, [
                'attr' => [
                 'placeholder' => "Exmp:Petit déjeuner inclus , repas inclus , buffet à volonté le soir ...."
                  ]
                ])
               /*->add('images', FileType::class, [
                    'label' => 'files',
                    'multiple' => true,
                    'constraints' => [
                        new Count(['max' => 5]),
                        new All([
                            new File([
                                'maxSize' => '2048k',
                                 ])
                             ])
                         ]
                    
                ]);*/
              
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
            'data_class' => Cabane::class,
        ]);
    }
}
