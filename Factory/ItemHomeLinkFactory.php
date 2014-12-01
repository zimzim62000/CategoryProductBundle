<?php

namespace ZIMZIM\CategoryProductBundle\Factory;

use Symfony\Component\Routing\Router;

class ItemHomeLinkFactory
{
    private $router;
    private $linkCategory;
    private $linkProduct;


    public function __construct(Router $router, $linkCategory, $linkProduct){
        $this->router = $router;
        $this->linkCategory = $linkCategory;
        $this->linkProduct = $linkProduct;
    }

    public function getLink($entity){

        switch($entity::TYPE_ITEMHOME){
            case 'product':
                $link = $this->router->generate($this->linkProduct, $entity->getAttributeLink());
                break;
            case 'category':
                $link = $this->router->generate($this->linkCategory, $entity->getAttributeLink());
                break;
        }
        return $link;

    }

}
