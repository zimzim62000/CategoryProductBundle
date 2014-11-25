<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine;


class ProductManager extends Manager
{
    public function findBySlug($slug){

        return $this->getRepository()->findOneBy(array('slug' => $slug));
    }
}