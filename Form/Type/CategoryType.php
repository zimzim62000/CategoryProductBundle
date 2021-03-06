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
                'zimzim_toolsbundle_zimzimtinymce',
                array(
                    'label' => 'admincategory.entity.content',
                    'translation_domain' => 'ZIMZIMCategoryProduct'
                )
            );


        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $category = $event->getData();
                $form = $event->getForm();
                $addParent = true;
                $id_category = null;

                $url = '';
                if ($category && $category->getId() !== null) {

                    $url = $category->getWebPath();

                    $id_category = $category->getId();
                    if ($id_category === 1) {
                        $addParent = false;
                    }
                }

                $form->add(
                    'file',
                    'zimzim_toolsbundle_zimzimimage',
                    array(
                        'label' => 'admincategory.entity.image',
                        'translation_domain' => 'ZIMZIMCategoryProduct',
                        'attr' => array(
                            'url' => $url,
                            'label-inline' => 'label-inline'
                        )
                    )
                );

                $repository = $this->categoryManager->getRepository();
                if ($addParent) {

                    $tabIds = array();
                    foreach($category->getAllChildrens() as $child){
                        $tabIds[] = $child->getId();
                    }

                    $form->
                    add(
                        'parent',
                        'entity',
                        array(
                            'class' => $this->categoryManager->getClassName(),
                            'property' => 'indentedTitle',
                            'query_builder' => function () use ($id_category, $repository, $tabIds) {
                                $query = $repository->createQueryBuilder('c');
                                if (isset($id_category)) {
                                    $query->where($query->expr()->notIn('c.id', ':ids'))
                                        ->setParameter('ids', $tabIds);

                                }
                                $query->orderBy('c.root', 'ASC')
                                    ->addOrderBy('c.lft', 'ASC');

                                return $query;
                            },
                            'label' => 'admincategory.entity.parent',
                            'translation_domain' => 'ZIMZIMCategoryProduct'
                        )
                    );
                }


                if ($category && $category->getId() !== null) {
                    $form->add(
                        'categoryproducts',
                        'zimzim_toolsbundle_zimzimcollection',
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
