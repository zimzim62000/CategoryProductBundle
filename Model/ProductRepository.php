<?php

namespace ZIMZIM\CategoryProductBundle\Model;

use APY\DataGridBundle\Grid\Source\Entity;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
abstract class ProductRepository extends EntityRepository implements ApyDataGridRepositoryInterface
{
    public function getList(Entity $source)
    {
        $source->addHint(Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker');
        return $source;
    }
}
