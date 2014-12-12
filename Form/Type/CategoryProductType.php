<?php

namespace ZIMZIM\CategoryProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZIMZIM\CategoryProductBundle\Doctrine\CategoryProductManager;

class CategoryProductType extends AbstractType
{
    private $categoryProductManager;

    public function  __construct(CategoryProductManager $categoryProductManager)
    {
        $this->categoryProductManager = $categoryProductManager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'product',
            null,
            array(
                'label' => 'admincategoryproduct.entity.product',
                'translation_domain' => 'ZIMZIMCategoryProduct'
            )
        )
            ->add(
                'position',
                null,
                array(
                    'label' => 'admincategoryproduct.entity.position',
                    'translation_domain' => 'ZIMZIMCategoryProduct'
                )
            );

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $categoryproduct = $event->getData();
                $form = $event->getForm();
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
                'data_class' => $this->categoryProductManager->getClassName(),
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
