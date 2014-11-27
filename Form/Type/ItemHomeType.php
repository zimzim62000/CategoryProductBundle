<?php

namespace ZIMZIM\CategoryProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZIMZIM\CategoryProductBundle\Doctrine\ItemHomeManager;

class ItemHomeType extends AbstractType
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
                'position',
                null,
                array('label' => 'admincategory.entity.name', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add(
                'title',
                null,
                array('label' => 'admincategory.entity.name', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add(
                'description',
                null,
                array('label' => 'admincategory.entity.name', 'translation_domain' => 'ZIMZIMCategoryProduct')
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => $this->itemHomeManager->getClassName(),
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
        return 'zimzim_categoryproductbundle_itemhometype';
    }
}
