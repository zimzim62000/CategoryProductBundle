<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine\Configuration;

class Configuration implements ConfigurationManagerInterface
{
    protected $className;
    protected $repositoryName;
    protected $formName;

    public function __construct($class, $repositoryName, $formName)
    {
        $this->class = $class;
        $this->className = get_class($this->class);
        $this->repositoryName = $repositoryName;
        $this->formName = $formName;
    }

    public function getClass(){
        return $this->class;
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
