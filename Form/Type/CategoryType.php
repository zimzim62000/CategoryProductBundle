<?php

namespace ZIMZIM\CategoryProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZIMZIM\CategoryProductBundle\Doctrine\CategoryManager;
use ZIMZIM\CategoryProductBundle\Doctrine\CategoryProductManager;

class CategoryType extends AbstractType
{

    private $categoryManager;
    private $categoryProductManager;

    public function  __construct(CategoryManager $categoryManager, CategoryProductManager $categoryProductManager)
    {
        $this->categoryManager = $categoryManager;
        $this->categoryProductManager = $categoryProductManager;
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
                array('label' => 'admincategory.entity.name', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add(
                'title',
                null,
                array('label' => 'admincategory.entity.title', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add(
                'description',
                null,
                array('label' => 'admincategory.entity.desc', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->add(
                'content',
                null,
                array(
                    'attr' => array('contenteditable' => true),
                    'label' => 'admincategory.entity.content',
                    'translation_domain' => 'ZIMZIMCategoryProduct'
                )
            )
            ->add(
                'file',
                null,
                array('label' => 'admincategory.entity.image', 'translation_domain' => 'ZIMZIMCategoryProduct')
            );


        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $category = $event->getData();
                $form = $event->getForm();
                $id_category = null;
                if ($category && $category->getId() !== null) {
                    $id_category = $category->getId();
                    if ($id_category === 1) {
                        return;
                    }
                }
                $repository = $this->categoryManager->getRepository();
                $form->
                add(
                    'parent',
                    'entity',
                    array(
                        'class' => $this->categoryManager->getClassName(),
                        'property' => 'indentedTitle',
                        'query_builder' => function ($repository) use ($id_category) {
                            $query = $repository->createQueryBuilder('c');
                            if (isset($id_category)) {
                                $query->where('c.id <> :category')
                                    ->setParameter('category', $id_category);
                            }
                            $query->orderBy('c.root', 'ASC')
                                ->addOrderBy('c.lft', 'ASC');

                            return $query;
                        },
                        'label' => 'admincategory.entity.parent',
                        'translation_domain' => 'ZIMZIMCategoryProduct'
                    )
                );

                if ($category && $category->getId() !== null) {
                    $form->add(
                        'categoryproducts',
                        'zimzim_categoryproductbundle_zimzimcollection',
                        array(
                            'type' => $this->categoryProductManager->getFormname(),
                            'allow_add' => true,
                            'allow_delete' => true,
                            'by_reference' => true,
                            'label' => '__name__label__',
                            'attr' => array(
                                'no-label' => 'no-label',
                                'class' => 'small-block-grid-1 large-block-grid-2 container',
                                'datachildclass' => 'ulchildren',
                                'dataaddname' => 'form.type.collection.categoryproducts.add',
                                'dataname' => 'form.type.collection.categoryproducts.name',
                                'datadeletename' => 'form.type.collection.categoryproducts.delete'
                            )
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
                'data_class' => $this->categoryManager->getClassName(),
                'translation_domain' => 'ZIMZIMCategoryProduct'
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_categoryproductbundle_categorytype';
    }
}
