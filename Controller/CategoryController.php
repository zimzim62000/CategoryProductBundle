<?php

namespace ZIMZIM\CategoryProductBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Row;
use ZIMZIM\ToolsBundle\Controller\MainController;


/**
 * Category controller.
 *
 */
class CategoryController extends MainController
{
    const DIR = 'ZIMZIMCategoryProductBundle:Category';

    /**
     * Lists all Category entities.
     *
     */
    public function indexAction()
    {
        $manager = $this->container->get('zimzim_categoryproduct_categorymanager');

        $data = array(
            'manager' => $manager,
            'dir' => self::DIR,
            'show' => 'zimzim_categoryproduct_category_show',
            'edit' => 'zimzim_categoryproduct_category_edit'
        );

        return $this->gridList($data);
    }

    protected function manipulateRow(Row $row)
    {

        $row = parent::manipulateRow($row);
        $row->setField('name', $row->getEntity()->getIndentedTitle());

        return $row;
    }


    /**
     * Creates a new Category entity.
     *
     */
    public function createAction(Request $request)
    {
        $manager = $this->container->get('zimzim_categoryproduct_categorymanager');

        $entity = $manager->createEntity();
        $form = $this->createCreateForm($entity, $manager);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('zimzim_categoryproduct_category_show', array('id' => $entity->getId()))
            );
        }

        return $this->render(
            'ZIMZIMCategoryProductBundle:Category:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a Category entity.
     *
     * @param Category $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm($entity, $manager)
    {
        $form = $this->createForm(
            $manager->getFormName(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_categoryproduct_category_create'),
                'method' => 'POST',
            )
        );

        $form->add(
            'submit',
            'submit',
            array('label' => 'button.create', 'translation_domain' => 'ZIMZIMCategoryProduct')
        );

        return $form;
    }

    /**
     * Displays a form to create a new Category entity.
     *
     */
    public function newAction()
    {
        $manager = $this->container->get('zimzim_categoryproduct_categorymanager');

        $entity = $manager->createEntity();
        $form = $this->createCreateForm($entity, $manager);

        return $this->render(
            'ZIMZIMCategoryProductBundle:Category:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a Category entity.
     *
     */
    public function showAction($id)
    {
        $manager = $this->container->get('zimzim_categoryproduct_categorymanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMCategoryProductBundle:Category:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     */
    public function editAction($id)
    {
        $manager = $this->container->get('zimzim_categoryproduct_categorymanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $editForm = $this->createEditForm($entity, $manager);
        $deleteForm = $this->createDeleteForm($id);
        $moveUpForm = $this->createMoveUpForm($id);

        return $this->render(
            'ZIMZIMCategoryProductBundle:Category:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
                'moveup_form' => $moveUpForm->createView()
            )
        );
    }

    /**
     * Creates a form to edit a Category entity.
     *
     * @param Category $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm($entity, $manager)
    {
        $form = $this->createForm(
            $manager->getFormName(),
            $entity,
            array(
                'action' => $this->generateUrl(
                    'zimzim_categoryproduct_category_update',
                    array('id' => $entity->getId())
                ),
                'method' => 'PUT',
            )
        );

        $form->add(
            'submit',
            'submit',
            array('label' => 'button.update', 'translation_domain' => 'ZIMZIMCategoryProduct')
        );

        return $form;
    }

    /**
     * Edits an existing Category entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $manager = $this->container->get('zimzim_categoryproduct_categorymanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $originalCategoryProducts = new ArrayCollection();
        foreach ($entity->getCategoryproducts() as $CategoryProduct) {
            $originalCategoryProducts->add($CategoryProduct);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity, $manager);
        $moveUpForm = $this->createMoveUpForm($id);

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->preUpload();

            foreach ($entity->getCategoryproducts() as $CategoryProduct) {
                if ($CategoryProduct->getCategory() === null) {
                    $CategoryProduct->setCategory($entity);
                }
            }

            foreach ($originalCategoryProducts as $CategoryProduct) {
                if ($entity->getCategoryproducts()->contains($CategoryProduct) === false) {
                    $em->remove($CategoryProduct);
                }
            }
            $em->persist($entity);
            $this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_categoryproduct_category_edit', array('id' => $id)));
        }

        return $this->render(
            'ZIMZIMCategoryProductBundle:Category:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
                'moveup_form' => $moveUpForm->createView()
            )
        );
    }

    /**
     * Deletes a Category entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $manager = $this->container->get('zimzim_categoryproduct_categorymanager');
            $entity = $manager->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ' . $manager->getClassName() . ' entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_categoryproduct_category'));
    }

    /**
     * Creates a form to delete a Category entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_categoryproduct_category_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add(
                'submit',
                'submit',
                array('label' => 'button.delete', 'translation_domain' => 'ZIMZIMCategoryProduct')
            )
            ->getForm();
    }


    public function listCategoryBySlugAction($slug = null)
    {

        $manager = $this->container->get('zimzim_categoryproduct_categorymanager');

        if (isset($slug)) {
            $entity = $manager->findBySlug($slug);
        } else {
            $entity = $manager->find(1);
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return $this->render(
            'ZIMZIMCategoryProductBundle:Category:listid.html.twig',
            array(
                'entity' => $entity,
            )
        );
    }

    public function moveUpAction(Request $request, $id){

        $manager = $this->container->get('zimzim_categoryproduct_categorymanager');

        $em = $this->getDoctrine()->getManager();

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $moveUpForm = $this->createMoveUpForm($id);
        $moveUpForm->handleRequest($request);

        if ($moveUpForm->isValid()) {

            $manager->moveUp($entity, 1);
            $this->updateSuccess();
            $em->flush();
            $em->clear();

            return $this->redirect($this->generateUrl('zimzim_categoryproduct_category_edit', array('id' => $id)));
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity, $manager);

        return $this->render(
            'ZIMZIMCategoryProductBundle:Category:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    private function createMoveUpForm($id){
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_categoryproduct_category_moveup', array('id' => $id)))
            ->setMethod('PUT')
            ->add('submit', 'submit', array('label' => 'button.moveup', 'translation_domain' => 'ZIMZIMCategoryProduct'))
            ->getForm();
    }
}
