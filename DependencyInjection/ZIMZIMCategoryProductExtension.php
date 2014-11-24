<?php

namespace ZIMZIM\CategoryProductBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ZIMZIMCategoryProductExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter($this->getAlias().'.max_element', $config['max_element']);
        $container->setParameter($this->getAlias().'.category_class', $config['category_class']);
        $container->setParameter($this->getAlias().'.category_repo', $config['category_repo']);
        $container->setParameter($this->getAlias().'.category_form', $config['category_form']);
        $container->setParameter($this->getAlias().'.categoryproduct_class', $config['categoryproduct_class']);
        $container->setParameter($this->getAlias().'.categoryproduct_repo', $config['categoryproduct_repo']);
        $container->setParameter($this->getAlias().'.categoryproduct_form', $config['categoryproduct_form']);
        $container->setParameter($this->getAlias().'.product_class', $config['product_class']);
        $container->setParameter($this->getAlias().'.product_repo', $config['product_repo']);
        $container->setParameter($this->getAlias().'.product_form', $config['product_form']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
