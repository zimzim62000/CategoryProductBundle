<?php

namespace ZIMZIM\CategoryProductBundle\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * ItemHomeCategory
 *
 * @ORM\MappedSuperclass
 *
 */
class ItemHomeCategory extends ItemHome
{
    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id")
     *
     */
    protected $category;

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }
}
