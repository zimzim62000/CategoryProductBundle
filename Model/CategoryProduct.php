<?php

namespace ZIMZIM\CategoryProductBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CategoryProduct
 *
 * @ORM\MappedSuperclass
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 */
class CategoryProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Category
     *
     * @Gedmo\SortableGroup
     * @ORM\Column(name="category", type="integer")
     *
     **/
    protected $category;

    /**
     * @var Product
     * @ORM\Column(name="product", type="integer")
     *
     **/
    protected $product;

    /**
     * @var integer
     *
     * @Gedmo\SortablePosition
     *
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param integer $category
     *
     * @return CategoryProduct
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return integer
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set product
     *
     * @param integer $product
     *
     * @return CategoryProduct
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return integer
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return CategoryProduct
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }
}

