<?php

namespace ZIMZIM\CategoryProductBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;

use ZIMZIM\CategoryProductBundle\Entity\Category;
use ZIMZIM\CategoryProductBundle\Form\CategoryType;

/**
 * Category controller.
 *
 */
class CategoryController extends MainController
{

    /**
     * Lists all Category entities.
     *
     */
    public function indexAction()
    {
        $data = array(
            'entity' => 'ZIMZIMCategoryProductBundle:Category',
            'show' => 'zimzim_categoryproduct_category_show',
            'edit' => 'zimzim_categoryproduct_category_edit'
        );

        return $this->gridList($data);
    }

    /**
     * Creates a new Category entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Category();
        $form = $this->createCreateForm($entity);
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
    private function createCreateForm(Category $entity)
    {
        $form = $this->createForm(
            new CategoryType(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_categoryproduct_category_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create', 'translation_domain' => 'ZIMZIMCategoryProduct'));

        return $form;
    }

    /**
     * Displays a form to create a new Category entity.
     *
     */
    public function newAction()
    {
        $entity = new Category();
        $form = $this->createCreateForm($entity);

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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMCategoryProductBundle:Category')->find($id);

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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMCategoryProductBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMCategoryProductBundle:Category:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
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
    private function createEditForm(Category $entity)
    {
        $form = $this->createForm(
            new CategoryType(),
            $entity,
            array(
                'action' => $this->generateUrl(
                        'zimzim_categoryproduct_category_update',
                        array('id' => $entity->getId())
                    ),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update', 'translation_domain' => 'ZIMZIMCategoryProduct'));

        return $form;
    }

    /**
     * Edits an existing Category entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZIMZIMCategoryProductBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $originalCategoryProducts = new ArrayCollection();
        foreach ($entity->getCategoryproducts() as $CategoryProduct) {
            $originalCategoryProducts->add($CategoryProduct);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->preUpload();

            foreach ($entity->getCategoryproducts() as $CategoryProduct) {
                if($CategoryProduct->getCategory() === null){
                    $CategoryProduct->setCategory($entity);
                }
            }

            foreach($originalCategoryProducts as $CategoryProduct){
                if($entity->getCategoryproducts()->contains($CategoryProduct) === false){
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
            $entity = $em->getRepository('ZIMZIMCategoryProductBundle:Category')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Category entity.');
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
            ->add('submit', 'submit', array('label' => 'button.delete', 'translation_domain' => 'ZIMZIMCategoryProduct'))
            ->getForm();
    }


    public function listCategoryBySlugAction($slug = null){
        
        $em = $this->getDoctrine()->getManager();

        if(isset($slug)){
            $entity = $em->getRepository('ZIMZIMCategoryProductBundle:Category')->findOneBy(array('slug' => $slug));
        }else{
            $entity = $em->getRepository('ZIMZIMCategoryProductBundle:Category')->find(1);
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
}
