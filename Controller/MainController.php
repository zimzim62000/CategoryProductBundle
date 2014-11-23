<?php

namespace ZIMZIM\CategoryProductBundle\Controller;


use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Source\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{

    protected $grid;

    protected function gridList($data, $setSource = true)
    {

        $grid = $this->get('grid');

        $type = 'default';
        if (isset($data['type'])) {
            $type = $data['type'];
        }

        $source = new Entity($data['entity'], $type);

        if (isset($data['show'])) {
            $rowAction = new RowAction("ZIMZIMCategoryProduct.button.show", $data['show']);
            $grid->addRowAction($rowAction);
        }

        if (isset($data['edit'])) {
            $rowAction = new RowAction("ZIMZIMCategoryProduct.button.update", $data['edit']);
            $grid->addRowAction($rowAction);
        }


        if (isset($data['deletemass'])) {
            $massAction = new MassAction('ZIMZIMCategoryProduct.button.delete', $data['deletemass']);
            $grid->addMassAction($massAction);
        }

        if ($setSource) {
            $grid->setSource($source);
        }

        $em = $this->container->get('doctrine.orm.entity_manager');

        $em->getRepository($data['entity'])->getList($source);

        $source->manipulateRow(
            function ($row) use ($em) {
                if (method_exists($row->getEntity(), 'getListAttrImg')) {
                    foreach ($row->getEntity()->getListAttrImg() as $attr) {
                        $method = 'get' . ucfirst($attr);
                        $methodWeb = 'getWeb' . ucfirst($attr);
                        if ($row->getEntity()->{$method}() !== null) {
                            $row->setField(
                                $attr,
                                '<img style="max-height:50px;"  src="/' . $row->getEntity()->{$methodWeb}() . '"/>'
                            );
                        }
                    }
                }

                return $row;
            }
        );

        $this->grid = $grid;

        return $this->grid->getGridResponse($data['entity'] . ':index.html.twig');
    }

    protected function createSuccess()
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => 'flashbag.success.create'
            )
        );
    }

    protected function updateSuccess()
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => 'flashbag.success.update'
            )
        );
    }

    protected function deleteSuccess()
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => 'flashbag.success.delete'
            )
        );
    }

    private function addFlashMessage($data)
    {

        $this->get('session')->getFlashBag()->add(
            $data['type'],
            $data['message']
        );
    }

    protected function displayError($message)
    {
        $this->addFlashMessage(
            array(
                'type' => 'errors',
                'message' => $message
            )
        );
    }

    protected function displaySuccess($message)
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => $message
            )
        );
    }
}