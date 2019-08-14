<?php

namespace AppBundle\Form;

use AppBundle\Entity\Tender;
use Symfony\Component\Finder\Comparator\NumberComparator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use function Sodium\add;

class TenderType extends AbstractType
{
      public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('name', TextType::class)
        ->add('city', TextType::class)
        ->add('type', TextType::class)
        ->add('money')
        ->add('deadline');
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
