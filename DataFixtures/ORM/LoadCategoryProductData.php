<?php

namespace ZIMZIM\CategoryProductBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\CategoryProductBundle\Entity\CategoryProduct;


class LoadCategoryProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        for ($j = 1; $j < 50; $j++) {

            $zimzim = new CategoryProduct();
            $tabValue = array();
            $num = rand(1, 5);

            for ($i = 0; $i <= $num; $i++) {
                if (!in_array($num, $tabValue)) {
                    $tabValue[] = $num;
                    $type = rand(1, 2);
                    if ($type === 1) {
                        $type = 'adore';
                    } else {
                        $type = 'deteste';
                    }
                    $zimzim->setCategory($this->getReference($num . $type));
                    $zimzim->setProduct($this->getReference('Product-' . $j));
                    $om->persist($zimzim);
                }
            }
        }

        $om->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}