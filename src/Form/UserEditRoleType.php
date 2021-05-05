<?php

namespace App\Form;

use App\Entity\Base\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            ->add( 'roles',ChoiceType:: class,[
                'choices' => [
                'Propriètaire' =>'ROLE_HOTE',
                ],
                'expanded' => true,
                'multiple'=> true  ,
                'label'  => 'Rôles'
                ]);
     
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}