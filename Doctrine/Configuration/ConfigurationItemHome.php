<?php

namespace ZIMZIM\CategoryProductBundle\Doctrine\Configuration;

use ZIMZIM\ToolsBundle\Doctrine\Configuration\Configuration;

class ConfigurationItemHome extends Configuration
{
    protected $className;
    protected $repositoryName;
    protected $formName;

    public function __construct($className, $formName)
    {
        $this->className = $className;
        $this->formName = $formName;
    }

    public function getClass(){
        return null;
    }
}
