<?php

namespace ZIMZIM\CategoryProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZIMZIM\CategoryProductBundle\Doctrine\ProductManager;

class ProductType extends AbstractType
{
    private $productmanager;

    public function  __construct(ProductManager $productmanager)
    {
        $this->productmanager = $productmanager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                null,
                array('label' => 'adminproduct.entity.name', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add(
                'title',
                null,
                array('label' => 'adminproduct.entity.title', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add(
                'description',
                null,
                array('label' => 'adminproduct.entity.description', 'translation_domain' => 'ZIMZIMCategoryProduct')
            );

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $product = $event->getData();
                $form = $event->getForm();

                for ($i = 1; $i < 5; $i++) {
                    $tmpFileName = '';
                    if ($product->getId() !== null) {
                        $methodName = 'getWebPath' . $i;
                        $tmpFileName = $product->$methodName();
                    }
                    $form->add(
                        'file' . $i,
                        'zimzim_categoryproductbundle_zimzimimage',
                        array(
                            'label' => 'adminproduct.entity.image',
                            'translation_domain' => 'ZIMZIMCategoryProduct',
                            'attr' => array(
                                'url' => $tmpFileName,
                                'label-inline' => 'label-inline'
                            )
                        )
                    );
                    $form->add(
                        'altPath' . $i,
                        null,
                        array(
                            'label' => 'adminproduct.entity.altpath',
                            'translation_domain' => 'ZIMZIMCategoryProduct'
                        )
                    );
                }
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
                'data_class' => $this->productmanager->getClassName(),
                'attr' => array(),
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
