<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('email', EmailType::class)
      ->add('firstName', TextType::class)
      ->add('lastName', TextType::class)
      ->add('bornDate', BirthdayType::class, [
        'widget' => 'single_text',]
      )
      ->add('password', RepeatedType::class, array(
        'type' => PasswordType::class,
        'first_options' => array('label' => 'Password'),
        'second_options' => array('label' => 'Repeat password')))
      ->add('additInfo', TextareaType::class)
      ->add('gender', ChoiceType::class, [
        'choices' => [
          'Male' => 'Male',
          'Female' => 'Female',
        ]
      ])
      ->add('livingPlace', ChoiceType::class, [
        'choices' => [
          'Sofia' => 'Sofia',
          'Plovdiv' => 'Plovdiv',
          'Varna' => 'Varna',
          'Burgas' => 'Burgas',
          'Stara Zagora' => 'Stara Zagora',
          'Ruse' => 'Ruse',
          'Dobrich' =>'Dobrich',
        ]
      ])
      ->add('submit', SubmitType::class);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(
      [
        'data_class' => User::class
      ]
    );
  }
}
