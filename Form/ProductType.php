<?php

namespace ZIMZIM\CategoryProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('title')
            ->add('description')
            ->add('feature')
            ->add('listing')
            ->add('specification')
            ->add('file1')
            ->add('altPath1')
            ->add('file2')
            ->add('altPath2')
            ->add('file3')
            ->add('altPath3')
            ->add('file4')
            ->add('altPath4');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'ZIMZIM\CategoryProductBundle\Entity\Product',
                'attr' => array(
                    'class' => 'zimzim-panel'
                ),
                'cascade_validation' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_categoryproductbundle_producttype';
    }
}
