<?php

namespace ZIMZIM\CategoryProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CategoryProduct
 *
 * @ORM\Table(name="default_categoryproduct")
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
    private $id;

    /**
     * @var Category
     *
     * @Gedmo\SortableGroup
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="categoryproducts", cascade={"persist"})
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id", nullable=FALSE)
     **/
    private $category;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="categoryproducts", cascade={"persist"})
     * @ORM\JoinColumn(name="id_product", referencedColumnName="id", nullable=FALSE)
     **/
    private $product;

    /**
     * @var integer
     *
     * @Gedmo\SortablePosition
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;


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

