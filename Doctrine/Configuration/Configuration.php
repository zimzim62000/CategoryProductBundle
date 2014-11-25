<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine\Configuration;

class Configuration implements ConfigurationManagerInterface
{
    protected $className;
    protected $repositoryName;
    protected $formName;

    public function __construct($className, $repositoryName, $formName)
    {
        $this->className = $className;
        $this->repositoryName = $repositoryName;
        $this->formName = $formName;
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

    /**
     * @return mixed
     */
    public function getRepositoryName()
    {
        return $this->repositoryName;
    }


}