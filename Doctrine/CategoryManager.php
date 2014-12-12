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

    public function moveUp($entity, $number)
    {
        $this->getRepository()->moveUp($entity, $number);

        $this->verify();

        return true;
    }

    public function moveDown($entity, $number)
    {
        $this->getRepository()->moveDown($entity, $number);

        $this->verify();

        return true;
    }

    public function verify()
    {
        $this->recover();

        $tmp = $this->getRepository()->verify();

        if(count($tmp)){
            var_dump($tmp);die;
        }
        return $tmp;
    }

    public function recover(){
        return $this->getRepository()->recover();
    }

}
