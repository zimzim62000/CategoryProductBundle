<?php

namespace ZIMZIM\CategoryProductBundle\Factory;

class ItemHomeFactory{

    private $category;
    private $product;
    private $categoryName;
    private $productName;
    private $categoryFormName;
    private $productFormName;

    public function __construct($categoryName, $productName, $categoryFormName, $productFormName){
        $this->categoryFormName = $categoryFormName;
        $this->productFormName = $productFormName;
        $this->categoryName = $categoryName;
        $this->productName = $productName;
        $this->category = new $categoryName();
        $this->product = new $productName();
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
}