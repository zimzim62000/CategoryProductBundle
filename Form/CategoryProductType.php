<?php

namespace ZIMZIM\CategoryProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('product');
        $builder->add('position');

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $categoryproduct = $event->getData();
                $form = $event->getForm();
                $category = null;
                if (isset($categoryproduct) && $categoryproduct->getCategory() === null) {
                    $form->remove('product');
                    $form->remove('position');
                };
            }
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'ZIMZIM\CategoryProductBundle\Entity\CategoryProduct',
                'label' => '__name__label__',
                'attr' => array(
                    'class' => 'zimzim-panel',
                     'no-label' => 'no-label'
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
        return 'zimzim_categoryproductbundle_categoryproducttype';
    }
}
