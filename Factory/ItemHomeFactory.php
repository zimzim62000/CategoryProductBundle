<?php

namespace ZIMZIM\CategoryProductBundle\Factory;

class ItemHomeFactory{

    private $category;
    private $product;
    private $categoryName;
    private $productName;
    private $categoryFormName;
    private $productFormName;

    public function __construct($categoryClass, $productClass, $categoryFormName, $productFormName){
        $this->categoryFormName = $categoryFormName;
        $this->productFormName = $productFormName;
        $this->categoryName = get_class($categoryClass);
        $this->productName = get_class($productClass);
        $this->category = $categoryClass;
        $this->product = $productClass;
    }

    public function createEntity($type){

        switch($type){
            case 'product':
                    $entity = $this->product;
                break;
            case 'category':
                    $entity = $this->category;
                break;
        }
        return clone $entity;
    }

    public function getCLassName($type){
        switch($type){
            case 'product':
                $name = $this->productName;
                break;
            case 'category':
                $name = $this->categoryName;
                break;
        }
        return $name;
    }


    public function getFormName($type){
        switch($type){
            case 'product':
                $name = $this->productFormName;
                break;
            case 'category':
                $name = $this->categoryFormName;
                break;
        }
        return $name;
    }

    public function getLink($type){
        switch($type){
            case 'product':
                $link = $this->product->getAttributeLink();
                break;
            case 'category':
                $link = $this->category->getAttributeLink();
                break;
        }
        return $link;
    }
}
