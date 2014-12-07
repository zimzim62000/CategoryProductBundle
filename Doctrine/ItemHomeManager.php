<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine;


use Doctrine\ORM\EntityManager;
use ZIMZIM\CategoryProductBundle\Factory\ItemHomeFactory;
use ZIMZIM\ToolsBundle\Doctrine\Configuration\ConfigurationManagerInterface;

class ItemHomeManager
{
    public function __construct(
        EntityManager $entityManager,
        ConfigurationManagerInterface $configuration,
        ItemHomeFactory $itemHomeFactory
    ) {
        $this->entityManager = $entityManager;
        $this->className = $configuration->getClassName();
        $this->formName = $configuration->getFormName();
        $this->itemHomeFactory = $itemHomeFactory;
    }

    public function getClassName($type)
    {
        if (isset($type)) {
            return $this->itemHomeFactory->getCLassName($type);
        }

        return $this->className;
    }

    public function getFormName($type)
    {
        if (isset($type)) {
            return $this->itemHomeFactory->getFormName($type);
        }

        return $this->formName;
    }

    public function getRepository()
    {
        return $this->entityManager->getRepository($this->getClassName(null));
    }

    public function createEntity($type)
    {
        return $this->itemHomeFactory->createEntity($type);
    }

    public function find($id){
        return $this->getRepository()->find($id);
    }

    public function findByPosition(){
        return $this->getRepository()->findBy(array(), array('position' => 'ASC'));
    }
}
