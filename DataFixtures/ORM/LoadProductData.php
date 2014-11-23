<?php

namespace ZIMZIM\CategoryProductBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\CategoryProductBundle\Entity\Product;


class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $filename = 'product_default.gif';

        for ($i = 1; $i < 50; $i++) {
            $zimzim = new Product();
            $zimzim->setName('Product ' . $i);
            $zimzim->setTitle('Product ' . $i);
            $zimzim->setDescription('Description ' . $i);
            $zimzim->setPath1($filename);
            $zimzim->setPath2($filename);
            $zimzim->setPath3($filename);
            $zimzim->setPath4($filename);
            $om->persist($zimzim);
            $this->addReference('Product-' . $i, $zimzim);
        }
        $om->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}