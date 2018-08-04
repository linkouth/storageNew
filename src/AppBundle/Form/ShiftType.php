<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 04.08.18
 * Time: 22:22
 */

namespace AppBundle\Form;


use AppBundle\Entity\Foreman;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            ->add('date', DateType::class, ['label' => 'Дата: '])
            ->add('foreman', CollectionType::class, array(
                'entry_type' => Foreman::class,
                'label' => 'Прораб: ',
            ))
            ->add('loaders', null, ['label' => 'Грузчики: ']);
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