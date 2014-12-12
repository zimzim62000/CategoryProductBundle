<?php

namespace ZIMZIM\CategoryProductBundle\Model\ItemHome;

use Doctrine\ORM\Mapping as ORM;


/**
 * ItemHomeCategory
 *
 * @ORM\MappedSuperclass
 *
 */
class ItemHomeCategory extends ItemHome
{
    const TYPE_ITEMHOME = 'category';

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
    public function setCategory($category)
    {
        $this->category = $category;
    }
}
