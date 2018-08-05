<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 04.08.18
 * Time: 22:22
 */

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShiftType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, array(
                'label' => 'Дата: ',
                //'input' => "2011-06-05 01:01:00",
            ))
            ->add('foreman', EntityType::class, array(
                'class' => 'AppBundle\Entity\Foreman',
                'choice_label' => 'surname',
                'label' => 'Прораб: ',
            ))
            ->add('loaders', EntityType::class, array(
                'class' => 'AppBundle\Entity\Loader',
                'choice_label' => 'id',
                'label' => 'Грузчики: ',
                'multiple' => true,
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Shift'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_shift';
    }
}