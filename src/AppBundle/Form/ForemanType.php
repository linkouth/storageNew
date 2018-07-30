<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 24.07.18
 * Time: 14:58
 */

namespace AppBundle\Form;


use AppBundle\Entity\Loader;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForemanType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Имя: '])
            ->add('surname', null, ['label' => 'Фамилия: '])
            ->add('email', null, ['label' => 'Email: '])
            ->add('password', PasswordType::class, ['label' => 'Пароль: '])
            ->add('salt', null, ['label' => 'Соль: '])
            ->add('loaders', CollectionType::class, array(
                'entry_type' => Loader::class,
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Foreman'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_foreman';
    }
}