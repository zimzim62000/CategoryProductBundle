<?php


namespace ZIMZIM\CategoryProductBundle\Doctrine\Configuration;


interface ConfigurationManagerInterface{

    public function getClassName();

    public function getRepositoryName();

    public function getFormName();
}