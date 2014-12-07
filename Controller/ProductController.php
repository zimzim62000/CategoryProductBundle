<?php

namespace ZIMZIM\CategoryProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\ToolsBundle\Controller\MainController;
/**
 * Product controller.
 *
 */
class ProductController extends MainController
{
    const DIR = 'ZIMZIMCategoryProductBundle:Product';

    /**
     * Lists all Product entities.
     *
     */
    public function indexAction()
    {
        $manager = $this->container->get('zimzim_categoryproduct_productmanager');

        $data = array(
            'manager' => $manager,
            'dir' => self::DIR,
            'show' => 'zimzim_categoryproduct_product_show',
            'edit' => 'zimzim_categoryproduct_product_edit'
        );

        return $this->gridList($data);
    }

    /**
     * Creates a new Product entity.
     *
     */
    public function createAction(Request $request)
    {
        $manager = $this->container->get('zimzim_categoryproduct_productmanager');

        $entity = $manager->createEntity();
        $form = $this->createCreateForm($entity, $manager);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('zimzim_categoryproduct_product_show', array('id' => $entity->getId()))
            );
        }

        return $this->render(
            'ZIMZIMCategoryProductBundle:Product:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm($entity, $manager)
    {
        $form = $this->createForm(
            $manager->getFormName(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_categoryproduct_product_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Product entity.
     *
     */
    public function newAction()
    {
        $manager = $this->container->get('zimzim_categoryproduct_productmanager');

        $entity = $manager->createEntity();
        $form = $this->createCreateForm($entity, $manager);

        return $this->render(
            'ZIMZIMCategoryProductBundle:Product:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a Product entity.
     *
     */
    public function showAction($id)
    {
        $manager = $this->container->get('zimzim_categoryproduct_productmanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMCategoryProductBundle:Product:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     */
    public function editAction($id)
    {
        $manager = $this->container->get('zimzim_categoryproduct_productmanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm = $this->createEditForm($entity, $manager);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMCategoryProductBundle:Product:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView()
            )
        );
    }

    /**
     * Creates a form to edit a Product entity.
     *
     * @param Product $entity The entity
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
                    'zimzim_categoryproduct_product_update',
                    array('id' => $entity->getId())
                ),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Edits an existing Product entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $manager = $this->container->get('zimzim_categoryproduct_productmanager');

        $em = $this->getDoctrine()->getManager();

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity, $manager);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->preUpload();
            $this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_categoryproduct_product_edit', array('id' => $id)));
        }

        return $this->render(
            'ZIMZIMCategoryProductBundle:Product:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView()
            )
        );
    }

    /**
     * Deletes a Product entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager = $this->container->get('zimzim_categoryproduct_productmanager');
            $em = $this->getDoctrine()->getManager();
            $entity = $manager->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Product entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_categoryproduct_product'));
    }

    /**
     * Creates a form to delete a Product entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_categoryproduct_product_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm();
    }


    public function showProductBySlugAction($slug)
    {
        $manager = $this->container->get('zimzim_categoryproduct_productmanager');

        $entity = $manager->findBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $category = false;
        if ($entity->getCategoryproducts()->first()) {
            $category = $entity->getCategoryproducts()->first()->getCategory();
        }

        return $this->render(
            'ZIMZIMCategoryProductBundle:Product:showslug.html.twig',
            array(
                'entity' => $entity,
                'category' => $category
            )
        );
    }
}
