<?php

namespace ZIMZIM\CategoryProductBundle\Controller;

use APY\DataGridBundle\Grid\Source\Entity;
use Symfony\Component\HttpFoundation\Request;
use ZIMZIM\CategoryProductBundle\Model\ItemHome;
use ZIMZIM\ToolsBundle\Controller\MainController;

/**
 * ItemHome controller.
 *
 */
class ItemHomeController extends MainController
{

    public function indexPublicAction(){

        $manager = $this->container->get('zimzim_categoryproduct_itemhomemanager');

        $linker = $this->container->get('zimzim_categoryproduct_factory_itemhomelink');

        $entities = $manager->findByPosition();

        return $this->render(
            'ZIMZIMCategoryProductBundle:ItemHome:indexpublic.html.twig',
            array('entities' => $entities, 'linker' => $linker)
        );
    }

    /**
     * Lists all ItemHome entities.
     *
     */
    public function indexAction()
    {

        $manager = $this->container->get('zimzim_categoryproduct_itemhomemanager');

        $data = array(
            'manager' => $manager,
            'dir' => 'ZIMZIMCategoryProductBundle:ItemHome',
            'show' => 'zimzim_categoryproduct_itemhome_show',
            'edit' => 'zimzim_categoryproduct_itemhome_edit'
        );

        $this->gridList($data);

        return $this->grid->getGridResponse('ZIMZIMCategoryProductBundle:ItemHome:index.html.twig');
    }

    protected function setSource($data)
    {
        $type = 'default';
        if (isset($data['type'])) {
            $type = $data['type'];
        }

        return new Entity($data['manager']->getClassName(null), $type);
    }

    /**
     * Creates a new ItemHome entity.
     *
     */
    public function createAction(Request $request, $type)
    {
        $manager = $this->container->get('zimzim_categoryproduct_itemhomemanager');

        $entity = $manager->createEntity($type);
        $form = $this->createCreateForm($entity, $manager, $type);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('zimzim_categoryproduct_itemhome_show', array('id' => $entity->getId()))
            );
        }

        return $this->render(
            'ZIMZIMCategoryProductBundle:ItemHome:new.html.twig',
            array(
                'entity' => $entity,
                'form'   => $form->createView(),
                'type'   => $type
            )
        );
    }

    /**
     * Creates a form to create a ItemHome entity.
     *
     * @param ItemHome $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ItemHome\ItemHomeInterface $entity, $manager, $type)
    {
        $form = $this->createForm(
            $manager->getFormName($type),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_categoryproduct_itemhome_create', array('type' => $type)),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new ItemHome entity.
     *
     */
    public function newAction($type)
    {
        $manager = $this->container->get('zimzim_categoryproduct_itemhomemanager');

        $entity = $manager->createEntity($type);
        $form = $this->createCreateForm($entity, $manager, $type);

        return $this->render(
            'ZIMZIMCategoryProductBundle:ItemHome:new.html.twig',
            array(
                'entity' => $entity,
                'form'   => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a ItemHome entity.
     *
     */
    public function showAction($id)
    {
        $manager = $this->container->get('zimzim_categoryproduct_itemhomemanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemHome entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMCategoryProductBundle:ItemHome:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing ItemHome entity.
     *
     */
    public function editAction($id)
    {
        $manager = $this->container->get('zimzim_categoryproduct_itemhomemanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemHome entity.');
        }

        $editForm = $this->createEditForm($entity, $manager);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMCategoryProductBundle:ItemHome:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a ItemHome entity.
     *
     * @param ItemHome $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ItemHome\ItemHomeInterface $entity, $manager)
    {
        $form = $this->createForm(
            $manager->getFormName($entity::TYPE_ITEMHOME),
            $entity,
            array(
                'action' => $this->generateUrl(
                    'zimzim_categoryproduct_itemhome_update',
                    array('id' => $entity->getId())
                ),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Edits an existing ItemHome entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $manager = $this->container->get('zimzim_categoryproduct_itemhomemanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemHome entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity, $manager);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->preUpload();

            $this->updateSuccess();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_categoryproduct_itemhome_edit', array('id' => $id)));
        }

        return $this->render(
            'ZIMZIMCategoryProductBundle:ItemHome:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a ItemHome entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $manager = $this->container->get('zimzim_categoryproduct_itemhomemanager');
            $entity = $manager->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ItemHome entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_categoryproduct_itemhome'));
    }

    /**
     * Creates a form to delete a ItemHome entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_categoryproduct_itemhome_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm();
    }
}
