<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 22.07.18
 * Time: 15:27
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoaderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Имя: '])
            ->add('surname', null, ['label' => 'Фамилия: '])
            ->add('goods', null, ['label' => 'Товары: '])
            ->add('foreman', null, ['label' => 'Прораб: ']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Loader'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_loader';
    }
}