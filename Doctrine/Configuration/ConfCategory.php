<?php


namespace ZIMZIM\CategoryProductBundle\Doctrine\Configuration;

class ConfCategory implements ConfigurationManagerInterface
{

    private $className;
    private $dirname;
    private $formname;

    public function __construct($classname, $dirname, $formname)
    {
        $this->className = $classname;
        $this->dirname = $dirname;
        $this->formname = $formname;
    }

    /**
     * @param mixed $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $dirname
     */
    public function setDirname($dirname)
    {
        $this->dirname = $dirname;
    }

    /**
     * @return mixed
     */
    public function getDirname()
    {
        return $this->dirname;
    }

    /**
     * @param mixed $formname
     */
    public function setFormname($formname)
    {
        $this->formname = $formname;
    }

    /**
     * @return mixed
     */
    public function getFormname()
    {
        return $this->formname;
    }


}