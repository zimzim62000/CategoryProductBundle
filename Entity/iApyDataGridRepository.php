<?php


namespace ZIMZIM\CategoryProductBundle\Entity;

interface iApyDataGridRepository{

    /** @return source */
    public function getList($source);

}