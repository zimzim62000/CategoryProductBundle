<?php

namespace ZIMZIM\CategoryProductBundle\Model\ItemHome;

use Doctrine\ORM\Mapping as ORM;


/**
 * ItemHomeProduct
 *
 * @ORM\MappedSuperclass
 *
 */
class ItemHomeProduct extends ItemHome
{
    const TYPE_ITEMHOME = 'product';

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     *
     */
    protected $product;

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }
}
