<?php

namespace App\Form;

use App\Entity\Base\CabaneSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CabaneSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrix',IntegerType::class,[
                'required'=> false,
                'label'=> false,
                 'attr'=> [
                    'placeholder'=>"le prix max par personne"
                 ]
            ])
            ->add('maxCapacite',IntegerType::class,[
                'required'=> false,
                'label'=> false,
                'attr'=>[
                    'placeholder'=>"la capacité maximale d'accueil"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CabaneSearch::class,
            'method'=>'get',
            'csrf_protection'=> false
        ]);
    }

     public function getBlockPrefix()
     {
         return '';
    }
}
