<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('username')
        ->add('password')
        ->add('email');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(
        [
          'data_class' => User::class
        ]
      );
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_user_type';
    }
}
