<?php

namespace ZIMZIM\CategoryProductBundle\Model;

use APY\DataGridBundle\Grid\Source\Entity;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends NestedTreeRepository implements ApyDataGridRepositoryInterface
{
    public function getList(Entity $source)
    {
        $tableAlias = $source->getTableAlias();
        $source->manipulateQuery(
            function (QueryBuilder $query) use ($tableAlias)
            {
                $query->addOrderBy($tableAlias . '.root', 'ASC')
                    ->addOrderBy($tableAlias . '.lft', 'ASC');
            }
        );
        $source->addHint(Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker');
        return $source;
    }
}
