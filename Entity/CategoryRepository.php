<?php

namespace ZIMZIM\CategoryProductBundle\Entity;

use Doctrine\ORM\Query;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends NestedTreeRepository implements iApyDataGridRepository
{
    public function getList($source)
    {
        $source->addHint(Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker');
        return $source;
    }
}
