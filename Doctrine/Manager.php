<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine;

use Doctrine\ORM\EntityManager;
use ZIMZIM\CategoryProductBundle\Doctrine\Configuration\ConfigurationManagerInterface;

abstract class Manager implements ConfigurationManagerInterface
{
    protected $className;
    protected $dirname;
    protected $formname;
    protected $entityManager;


    public function __construct(EntityManager $entityManager, ConfigurationManagerInterface $configuration){
        $this->entityManager = $entityManager;
        $this->className = $configuration->getClassName();
        $this->dirname = $configuration->getDirname();
        $this->formname = $configuration->getFormname();
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getDirname()
    {
        return $this->dirname;
    }

    /**
     * @return string
     */
    public function getFormname()
    {
        return $this->formname;
    }


    public function createEntity()
    {
        return new $this->className();
    }

    public function getRepository(){
        return $this->entityManager->getRepository($this->className);
    }


    public function find($id){

        return $this->getRepository()->find($id);
    }
}