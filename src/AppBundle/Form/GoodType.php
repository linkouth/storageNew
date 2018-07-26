<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 21.07.18
 * Time: 23:02
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoodType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', null, ['label' => 'Тип: '])
            ->add('name', null, ['label' => 'Название: '])
            ->add('weight', null, ['label' => 'Вес: '])
            ->add('loader', null, ['label' => 'Грузчик: ']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Good'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_good';
    }

}