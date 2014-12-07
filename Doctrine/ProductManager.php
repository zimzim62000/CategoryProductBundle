<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine;

use ZIMZIM\ToolsBundle\Doctrine\Manager;

class ProductManager extends Manager
{
    public function findBySlug($slug){

        return $this->getRepository()->findOneBy(array('slug' => $slug));
    }

    public function findByCategory($category){

        return $this->getRepository()->getByCategory($category);
    }
}
