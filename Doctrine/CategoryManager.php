<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine;


class CategoryManager extends Manager
{
    public function findBySlug($slug){

        return $this->getRepository()->findOneBy(array('slug' => $slug));
    }
}