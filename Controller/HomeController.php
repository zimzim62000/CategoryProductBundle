<?php

namespace ZIMZIM\CategoryProductBundle\Controller;


class HomeController extends MainController
{
    public function indexAction()
    {

        $entities = array();

        return $this->render(
            'ZIMZIMCategoryProductBundle:Home:index.html.twig',
            array(
                'entities' => $entities,
            )
        );
    }
}