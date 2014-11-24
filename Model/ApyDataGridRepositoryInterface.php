<?php


namespace ZIMZIM\CategoryProductBundle\Model;

interface ApyDataGridRepositoryInterface{

    /** @return source */
    public function getList($source);

}