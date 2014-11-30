<?php

namespace ZIMZIM\CategoryProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
                'name',
                null,
                array('label' => 'adminitemhome.entity.name', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add(
                'title',
                null,
                array('label' => 'adminitemhome.entity.title', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add(
                'description',
                null,
                array('label' => 'adminitemhome.entity.description', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add(
                'position',
                null,
                array('label' => 'adminitemhome.entity.position', 'translation_domain' => 'ZIMZIMCategoryProduct')
            );

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $category = $event->getData();
                $form = $event->getForm();

                $url = '';
                if ($category && $category->getId() !== null) {
                    $url = $category->getWebPath();
                }

                $form->add(
                    'file',
                    'zimzim_categoryproductbundle_zimzimimage',
                    array(
                        'label' => 'adminitemhome.entity.image',
                        'translation_domain' => 'ZIMZIMCategoryProduct',
                        'attr' => array(
                            'url' => $url,
                            'label-inline' => 'label-inline'
                        )
                    )
                );
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
                'data_class' => $this->itemHomeManager->getClassName(null),
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
        return 'zimzim_categoryproductbundle_itemhometype';
    }
}
