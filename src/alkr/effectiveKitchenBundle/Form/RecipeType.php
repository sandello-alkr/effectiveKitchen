<?php

namespace alkr\effectiveKitchenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use alkr\effectiveKitchenBundle\Form\FlowType;

class RecipeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('flows', 'collection', ['allow_add'=>true, 'allow_delete'=>true, 'type'=>new FlowType()])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'data_class' => 'alkr\effectiveKitchenBundle\Entity\Recipe'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
