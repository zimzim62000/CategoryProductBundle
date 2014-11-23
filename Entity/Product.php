<?php

namespace ZIMZIM\CategoryProductBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;


/**
 * Product
 *
 * @ORM\Table(name="default_product")
 * @ORM\Entity(repositoryClass="ProductRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Product implements Translatable, iApyDataGridFilePath
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     *
     * @GRID\Column(operatorsVisible=false)
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"name"})
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     *
     * @ORM\Column(length=128, unique=true, name="slug")
     */
    private $slug;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     *
     * @ORM\Column(name="feature", type="text", nullable=true)
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    private $feature;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     *
     * @ORM\Column(name="listing", type="text", nullable=true)
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    private $listing;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     *
     * @ORM\Column(name="specification", type="text", nullable=true)
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    private $specification;


    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="created_at", type="datetime")
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    private $updatedAt;

    /**
     * @Gedmo\Locale
     */
    private $locale;

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @ORM\OneToMany(targetEntity="CategoryProduct", mappedBy="categories")
     **/
    private $categoryproducts;

    public function __construct()
    {
        $this->categoryproducts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /****************************************** image / file ************************************************/

    /**
     * @Assert\File(maxSize="200000", mimeTypes={"image/jpeg", "image/png", "image/gif"})
     */
    public $file1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="file1")
     *
     * @GRID\Column(operatorsVisible=false, safe=false)
     */
    public $path1;

    /**
     *
     * @ORM\Column(name="altPath1", type="string", length=255, nullable=true )
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    public $altPath1;

    public function getAbsolutePath1()
    {
        return null === $this->path1 ? null : $this->getUploadRootDir() . '/' . $this->path1;
    }

    public function getWebPath1()
    {
        return null === $this->path1 ? null : $this->getUploadDir() . '/' . $this->path1;
    }

    /**
     * @Assert\File(maxSize="200000", mimeTypes={"image/jpeg", "image/png", "image/gif"})
     */
    public $file2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="file2")
     *
     * @GRID\Column(operatorsVisible=false, safe=false)
     */
    public $path2;

    /**
     *
     * @ORM\Column(name="altPath2", type="string", length=255, nullable=true )
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    public $altPath2;

    public function getAbsolutePath2()
    {
        return null === $this->path2 ? null : $this->getUploadRootDir() . '/' . $this->path2;
    }

    public function getWebPath2()
    {
        return null === $this->path2 ? null : $this->getUploadDir() . '/' . $this->path2;
    }

    /**
     * @Assert\File(maxSize="200000", mimeTypes={"image/jpeg", "image/png", "image/gif"})
     */
    public $file3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="file3")
     * @GRID\Column(operatorsVisible=false, safe=false)
     */
    public $path3;

    /**
     *
     * @ORM\Column(name="altPath3", type="string", length=255, nullable=true )
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    public $altPath3;


    public function getAbsolutePath3()
    {
        return null === $this->path3 ? null : $this->getUploadRootDir() . '/' . $this->path3;
    }

    public function getWebPath3()
    {
        return null === $this->path3 ? null : $this->getUploadDir() . '/' . $this->path3;
    }

    /**
     * @Assert\File(maxSize="200000", mimeTypes={"image/jpeg", "image/png", "image/gif"})
     */
    public $file4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="file4")
     * @GRID\Column(operatorsVisible=false, safe=false)
     */
    public $path4;

    /**
     *
     * @ORM\Column(name="altPath4", type="string", length=255, nullable=true )
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    public $altPath4;


    public function getAbsolutePath4()
    {
        return null === $this->path4 ? null : $this->getUploadRootDir() . '/' . $this->path4;
    }

    public function getWebPath4()
    {
        return null === $this->path4 ? null : $this->getUploadDir() . '/' . $this->path4;
    }


    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'resources/product';
    }

    /**
     * @param mixed $path4
     */
    public function setPath4($path4)
    {
        $this->path4 = $path4;
    }

    /**
     * @return mixed
     */
    public function getPath4()
    {
        return $this->path4;
    }

    /**
     * @param mixed $path2
     */
    public function setPath2($path2)
    {
        $this->path2 = $path2;
    }

    /**
     * @return mixed
     */
    public function getPath2()
    {
        return $this->path2;
    }

    /**
     * @param mixed $path3
     */
    public function setPath3($path3)
    {
        $this->path3 = $path3;
    }

    /**
     * @return mixed
     */
    public function getPath3()
    {
        return $this->path3;
    }

    /**
     * @param mixed $path1
     */
    public function setPath1($path1)
    {
        $this->path1 = $path1;
    }

    /**
     * @return mixed
     */
    public function getPath1()
    {
        return $this->path1;
    }



    /*************************************************************************************************/

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
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set feature
     *
     * @param string $feature
     *
     * @return Product
     */
    public function setFeature($feature)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * Get feature
     *
     * @return string
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * Set listing
     *
     * @param string $listing
     *
     * @return Product
     */
    public function setListing($listing)
    {
        $this->listing = $listing;

        return $this;
    }

    /**
     * Get listing
     *
     * @return string
     */
    public function getListing()
    {
        return $this->listing;
    }

    /**
     * Set specification
     *
     * @param string $specification
     *
     * @return Product
     */
    public function setSpecification($specification)
    {
        $this->specification = $specification;

        return $this;
    }

    /**
     * Get specification
     *
     * @return string
     */
    public function getSpecification()
    {
        return $this->specification;
    }


    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (isset($this->file1)) {
            if (null !== $this->file1) {
                $this->path1 = urlencode(
                        str_replace('.' . $this->file1->guessExtension(), '', $this->file1->getClientOriginalName())
                    ) . '.' . $this->file1->guessExtension();
            }
        }
        if (isset($this->file2)) {
            if (null !== $this->file2) {
                $this->path2 = urlencode(
                        str_replace('.' . $this->file2->guessExtension(), '', $this->file2->getClientOriginalName())
                    ) . '.' . $this->file2->guessExtension();
            }
        }
        if (isset($this->file3)) {
            if (null !== $this->file3) {
                $this->path3 = urlencode(
                        str_replace('.' . $this->file3->guessExtension(), '', $this->file3->getClientOriginalName())
                    ) . '.' . $this->file3->guessExtension();
            }
        }
        if (isset($this->file4)) {
            if (null !== $this->file4) {
                $this->path4 = urlencode(
                        str_replace('.' . $this->file4->guessExtension(), '', $this->file4->getClientOriginalName())
                    ) . '.' . $this->file4->guessExtension();
            }
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (isset($this->file1)) {
            if (null === $this->file1) {
                return;
            }
            $this->file1->move($this->getUploadRootDir(), $this->path1);
            unset($this->file1);
        }
        if (isset($this->file2)) {
            if (null === $this->file2) {
                return;
            }
            $this->file2->move($this->getUploadRootDir(), $this->path2);
            unset($this->file2);
        }
        if (isset($this->file3)) {
            if (null === $this->file3) {
                return;
            }
            $this->file3->move($this->getUploadRootDir(), $this->path3);
            unset($this->file3);
        }
        if (isset($this->file4)) {
            if (null === $this->file4) {
                return;
            }
            $this->file4->move($this->getUploadRootDir(), $this->path4);
            unset($this->file4);
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath1()) {
            unlink($file);
        }
        if ($file = $this->getAbsolutePath2()) {
            unlink($file);
        }
        if ($file = $this->getAbsolutePath3()) {
            unlink($file);
        }
        if ($file = $this->getAbsolutePath4()) {
            unlink($file);
        }
    }

    public function getListAttrImg()
    {
        return array('path1', 'path2', 'path3', 'path4');
    }

    /**
     * @param mixed $altPath1
     */
    public function setAltPath1($altPath1)
    {
        $this->altPath1 = $altPath1;
    }

    /**
     * @return mixed
     */
    public function getAltPath1()
    {
        return $this->altPath1;
    }

    /**
     * @param mixed $altPath2
     */
    public function setAltPath2($altPath2)
    {
        $this->altPath2 = $altPath2;
    }

    /**
     * @return mixed
     */
    public function getAltPath2()
    {
        return $this->altPath2;
    }

    /**
     * @param mixed $altPath3
     */
    public function setAltPath3($altPath3)
    {
        $this->altPath3 = $altPath3;
    }

    /**
     * @return mixed
     */
    public function getAltPath3()
    {
        return $this->altPath3;
    }

    /**
     * @param mixed $altPath4
     */
    public function setAltPath4($altPath4)
    {
        $this->altPath4 = $altPath4;
    }

    /**
     * @return mixed
     */
    public function getAltPath4()
    {
        return $this->altPath4;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return mixed
     */
    public function getCategoryproducts()
    {
        return $this->categoryproducts;
    }

    /**
     * @param mixed $categoryproducts
     */
    public function setCategoryproducts($categoryproducts)
    {
        $this->categoryproducts = $categoryproducts;

        return $this;
    }

}

