<?php


namespace ZIMZIM\CategoryProductBundle\Model;

use APY\DataGridBundle\Grid\Source\Entity;

interface ApyDataGridRepositoryInterface{

    /** @return source */
    public function getList(Entity $source);

}
