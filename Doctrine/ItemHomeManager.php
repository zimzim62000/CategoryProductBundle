<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine;


use Doctrine\ORM\EntityManager;
use ZIMZIM\CategoryProductBundle\Doctrine\Configuration\ConfigurationManagerInterface;
use ZIMZIM\CategoryProductBundle\Factory\ItemHomeFactory;

class ItemHomeManager extends Manager
{
    public function __construct(EntityManager $entityManager, ConfigurationManagerInterface $configuration, ItemHomeFactory $itemHomeFactory)
    {
        $this->entityManager = $entityManager;
        $this->className = $configuration->getClassName();
        $this->repositoryName = $configuration->getRepositoryName();
        $this->formName = $configuration->getFormName();
        $this->itemHomeFactory = $itemHomeFactory;
    }

    public function createEntity($type){
        return $this->itemHomeFactory->create($type);
    }
}
