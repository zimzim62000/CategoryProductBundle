<?php

namespace ZIMZIM\CategoryProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZIMZIM\CategoryProductBundle\Doctrine\ItemHomeManager;

class ItemHomeCategoryType extends AbstractType
{
    private $itemHomeManager;

    public function  __construct(ItemHomeManager $itemHomeManager)
    {
        $this->itemHomeManager = $itemHomeManager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'category',
                null,
                array(
                    'label' => 'adminitemhome.entity.category',
                    'translation_domain' => 'ZIMZIMCategoryProduct',
                    'empty_value' => false
                )
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => $this->itemHomeManager->getClassName('category'),
                'attr' => array(),
                'cascade_validation' => true,
                'translation_domain' => 'ZIMZIMCategoryProduct'
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_categoryproductbundle_itemhomecategorytype';
    }

    public function getParent()
    {
        return $this->itemHomeManager->getFormName(null);
    }
}
