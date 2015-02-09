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

                for ($i = 1; $i < 7; $i++) {
                    $tmpFileName = '';
                    $methodName = 'getWebPath' . $i;
                    if ($product->getId() !== null) {
                        $tmpFileName = $product->$methodName();
                    }
                    $form->add(
                        'file' . $i,
                        'zimzim_toolsbundle_zimzimimage',
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
                        'path' . $i,
                        null,
                        array(
                            'label' => 'adminproduct.entity.path',
                            'translation_domain' => 'ZIMZIMCategoryProduct'
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
                $extension = false;
                if ($product->getId() !== null) {
                    $extension= substr(strrchr($product->getAbsolutePathPj(),'.'), 1);
                }

                $form->add(
                    'filePj',
                    'zimzim_toolsbundle_zimzimupload',
                    array(
                        'label' => 'adminproduct.entity.filepj',
                        'translation_domain' => 'ZIMZIMCategoryProduct',
                        'attr' => array(
                            'extension' => $extension,
                            'label-inline' => 'label-inline'
                        )
                    )
                );

                $form->add(
                    'pathPj',
                    null,
                    array(
                        'label' => 'adminproduct.entity.pathpj',
                        'translation_domain' => 'ZIMZIMCategoryProduct'
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
