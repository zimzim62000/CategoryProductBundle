<?php

namespace ZIMZIM\CategoryProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
            ->add('title',
                null,
                array('label' => 'adminproduct.entity.title', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add('description',
                null,
                array('label' => 'adminproduct.entity.description', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add('file1',
                null,
                array('label' => 'adminproduct.entity.image', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add('altPath1',
                null,
                array('label' => 'adminproduct.entity.altpath', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add('file2',
                null,
                array('label' => 'adminproduct.entity.image', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add('altPath2',
                null,
                array('label' => 'adminproduct.entity.altpath', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add('file3',
                null,
                array('label' => 'adminproduct.entity.image', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add('altPath3',
                null,
                array('label' => 'adminproduct.entity.altpath', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add('file4',
                null,
                array('label' => 'adminproduct.entity.image', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add('altPath4',
                null,
                array('label' => 'adminproduct.entity.altpath', 'translation_domain' => 'ZIMZIMCategoryProduct')
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
