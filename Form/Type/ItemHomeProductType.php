<?php

namespace ZIMZIM\CategoryProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZIMZIM\CategoryProductBundle\Doctrine\ItemHomeManager;

class ItemHomeProductType extends AbstractType
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
                'product',
                null,
                array('label' => 'adminitemhome.entity.product', 'translation_domain' => 'ZIMZIMCategoryProduct')
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => $this->itemHomeManager->getClassName('product'),
                'attr' => array(
                ),
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
        return 'zimzim_categoryproductbundle_itemhomeproducttype';
    }

    public function getParent(){
        return $this->itemHomeManager->getFormName(null);
    }
}
