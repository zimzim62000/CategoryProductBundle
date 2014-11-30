<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine\Configuration;

class ConfigurationItemHome extends Configuration
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

    public function getClass(){
        return null;
    }
}
