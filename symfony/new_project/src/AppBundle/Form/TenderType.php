<?php

namespace AppBundle\Form;

use AppBundle\Entity\Tender;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class TenderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('name')
        ->add('city')
        ->add('type')
        ->add('money')
        ->add('deadline')
        ->add('addedOn');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(
        [
          'data_class' => Tender::class
        ]
      );
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_tender_type';
    }
}
