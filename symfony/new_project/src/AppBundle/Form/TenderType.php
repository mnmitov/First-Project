<?php

namespace AppBundle\Form;

use AppBundle\Entity\Tender;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TenderType extends AbstractType
{
      public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('name', TextType::class)
        ->add('city', TextType::class)
        ->add('type', TextType::class)
        ->add('money', IntegerType::class)
        ->add('deadline', DateType::class, [
          'widget' => 'single_text',
          'html5' => false,
          'attr' => ['class' => 'bootstrap-datetimepicker.min.js']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(
        [
          'data_class' => Tender::class
        ]
      );
    }


}
