<?php

namespace ZIMZIM\CategoryProductBundle\Factory;

class ItemHomeFactory{

    private $category;
    private $product;

    public function __construct($categoryName, $productName){
        $this->category = new $categoryName();
        $this->product = new $productName();
    }

    public function create($type){

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

}