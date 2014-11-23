<?php

namespace ZIMZIM\CategoryProductBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\CategoryProductBundle\Entity\Category;


class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $filename = 'category_default.gif';

        $zimzim = new Category();
        $zimzim->setName('ZIMZIM HOME');
        $zimzim->setPath($filename);
        $om->persist($zimzim);
        $this->addReference('ZIMZIM-HOME', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('Un peu');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('ZIMZIM-HOME'));
        $om->persist($zimzim);
        $this->addReference('Un-peu', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('Beaucoup');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('ZIMZIM-HOME'));
        $om->persist($zimzim);
        $this->addReference('Beaucoup', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('Passionnément');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('ZIMZIM-HOME'));
        $om->persist($zimzim);
        $this->addReference('Passionnément', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('A la folie');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('ZIMZIM-HOME'));
        $om->persist($zimzim);
        $this->addReference('A-la-folie', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('Pas du tout');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('ZIMZIM-HOME'));
        $om->persist($zimzim);
        $this->addReference('Pas-du-tout', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('J\'adore');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('Un-peu'));
        $om->persist($zimzim);
        $this->addReference('1adore', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('Je deteste');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('Un-peu'));
        $om->persist($zimzim);
        $this->addReference('1deteste', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('J\'adore');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('Beaucoup'));
        $om->persist($zimzim);
        $this->addReference('2adore', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('Je deteste');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('Beaucoup'));
        $om->persist($zimzim);
        $this->addReference('2deteste', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('J\'adore');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('Passionnément'));
        $om->persist($zimzim);
        $this->addReference('3adore', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('Je deteste');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('Passionnément'));
        $om->persist($zimzim);
        $this->addReference('3deteste', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('J\'adore');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('A-la-folie'));
        $om->persist($zimzim);
        $this->addReference('4adore', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('Je deteste');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('A-la-folie'));
        $om->persist($zimzim);
        $this->addReference('4deteste', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('J\'adore');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('Pas-du-tout'));
        $om->persist($zimzim);
        $this->addReference('5adore', $zimzim);

        $zimzim = new Category();
        $zimzim->setName('Je deteste');
        $zimzim->setPath($filename);
        $zimzim->setParent($this->getReference('Pas-du-tout'));
        $om->persist($zimzim);
        $this->addReference('5deteste', $zimzim);

        $om->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}