<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine;


use ZIMZIM\CategoryProductBundle\Model\Category;
use ZIMZIM\ToolsBundle\Doctrine\Manager;

class CategoryManager extends Manager
{
    public function findBySlug($slug)
    {
        return $this->getRepository()->findOneBy(array('slug' => $slug));
    }

    public function moveUp(Category $entity, $number)
    {
        return $this->getRepository()->moveUp($entity, $number);
    }

    public function verify()
    {
        return $this->getRepository()->verify();
    }

}
