<?php

namespace ZIMZIM\CategoryProductBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('zimzim_categoryproduct');

        $rootNode
            ->children()
                ->integerNode('max_element')->defaultValue(5)->end()
                ->scalarNode('category_class')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('category_repo')->defaultValue('ZIMZIM\CategoryProductBundle\Model\CategoryRepository')->end()
                ->scalarNode('category_form')->defaultValue('zimzim_categoryproductbundle_categorytype')->end()
                ->scalarNode('categoryproduct_class')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('categoryproduct_repo')->defaultValue('ZIMZIM\CategoryProductBundle\Model\CategoryProductRepository')->end()
                ->scalarNode('categoryproduct_form')->defaultValue('zimzim_categoryproductbundle_categoryproducttype')->end()
                ->scalarNode('product_class')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('product_repo')->defaultValue('ZIMZIM\CategoryProductBundle\Model\ProductRepository')->end()
                ->scalarNode('product_form')->defaultValue('zimzim_categoryproductbundle_producttype')->end()
                ->scalarNode('itemhome_class')->isRequired()->defaultValue('ZIMZIM\CategoryProductBundle\Model\ItemHome')->end()
                ->scalarNode('itemhome_repo')->defaultValue('ZIMZIM\CategoryProductBundle\Model\ItemHomeRepository')->end()
                ->scalarNode('itemhome_form')->defaultValue('zimzim_categoryproductbundle_itemhometype')->end()
                ->arrayNode('itemhome_data')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('category_class')->defaultValue('ZIMZIM\CategoryProductBundle\Model\ItemHomeCategory')->cannotBeEmpty()->end()
                        ->scalarNode('category_form')->defaultValue('zimzim_categoryproductbundle_itemhomecategorytype')->cannotBeEmpty()->end()
                        ->scalarNode('product_class')->defaultValue('ZIMZIM\CategoryProductBundle\Model\ItemHomeProduct')->cannotBeEmpty()->end()
                        ->scalarNode('product_form')->defaultValue('zimzim_categoryproductbundle_itemhomeproducttype')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
