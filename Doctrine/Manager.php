<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine;

use Doctrine\ORM\EntityManager;
use ZIMZIM\CategoryProductBundle\Doctrine\Configuration\ConfigurationManagerInterface;

abstract class Manager
{
    protected $className;
    protected $repositoryName;
    protected $formName;
    protected $entityManager;


    public function __construct(EntityManager $entityManager, ConfigurationManagerInterface $configuration)
    {
        $this->entityManager = $entityManager;
        $this->className = $configuration->getClassName();
        $this->repositoryName = $configuration->getRepositoryName();
        $this->formName = $configuration->getFormName();
    }

    public function createEntity($type)
    {
        return new $this->className();
    }

    public function getRepository()
    {
        return $this->entityManager->getRepository($this->className);
    }


    public function find($id)
    {

        return $this->getRepository()->find($id);
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return mixed
     */
    public function getFormName()
    {
        return $this->formName;
    }


}
