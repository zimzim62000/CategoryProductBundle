<?php

namespace ZIMZIM\CategoryProductBundle\Model\CategoryProduct;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;
use ZIMZIM\ToolsBundle\Model\APYDataGrid\ApyDataGridFilePathInterface;


/**
 * Product
 *
 * @ORM\MappedSuperclass
 *
 */
class Product implements Translatable, ApyDataGridFilePathInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $id;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     *
     * @GRID\Column(operatorsVisible=false, title="ZIMZIMCategoryProduct.name")
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     *
     * @ORM\Column(length=128, unique=true, name="slug")
     */
    protected $slug;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;


    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="created_at", type="datetime")
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     *
     * @GRID\Column(operatorsVisible=false, title="ZIMZIMCategoryProduct.updatedat")
     */
    protected $updatedAt;




    /**
     * @Gedmo\Locale
     */
    protected $locale;

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }


    /**
     * @ORM\Column(name="categoryproducts", type="array")
     **/
    protected $categoryproducts;

    public function __construct()
    {
        $this->categoryproducts = new ArrayCollection();
    }

    /****************************************** image / file ************************************************/

    /**
     * @Assert\File(maxSize="1000000", mimeTypes={"application/pdf"})
     */
    public $filePj;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="filePj")
     *
     * @GRID\Column(operatorsVisible=false, safe=false, title="ZIMZIMCategoryProduct.image")
     */
    protected $pathPj;

    public function getAbsolutePathPj()
    {
        return null === $this->pathPj ? null : $this->getUploadRootDir() . '/' . $this->pathPj;
    }

    public function getWebPathPj()
    {
        return null === $this->pathPj ? null : $this->getUploadDir() . '/' . $this->pathPj;
    }



    /**
     * @Assert\File(maxSize="500000", mimeTypes={"image/jpeg", "image/png", "image/gif"})
     */
    public $file1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="file1")
     *
     * @GRID\Column(operatorsVisible=false, safe=false, title="ZIMZIMCategoryProduct.image")
     */
    protected $path1;

    /**
     *
     * @ORM\Column(name="altPath1", type="string", length=255, nullable=true )
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $altPath1;

    public function getAbsolutePath1()
    {
        return null === $this->path1 ? null : $this->getUploadRootDir() . '/' . $this->path1;
    }

    public function getWebPath1()
    {
        return null === $this->path1 ? null : $this->getUploadDir() . '/' . $this->path1;
    }

    /**
     * @Assert\File(maxSize="500000", mimeTypes={"image/jpeg", "image/png", "image/gif"})
     */
    public $file2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="file2")
     *
     * @GRID\Column(operatorsVisible=false, safe=false, title="ZIMZIMCategoryProduct.image")
     */
    protected $path2;

    /**
     *
     * @ORM\Column(name="altPath2", type="string", length=255, nullable=true )
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $altPath2;

    public function getAbsolutePath2()
    {
        return null === $this->path2 ? null : $this->getUploadRootDir() . '/' . $this->path2;
    }

    public function getWebPath2()
    {
        return null === $this->path2 ? null : $this->getUploadDir() . '/' . $this->path2;
    }

    /**
     * @Assert\File(maxSize="500000", mimeTypes={"image/jpeg", "image/png", "image/gif"})
     */
    public $file3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="file3")
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $path3;

    /**
     *
     * @ORM\Column(name="altPath3", type="string", length=255, nullable=true )
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $altPath3;


    public function getAbsolutePath3()
    {
        return null === $this->path3 ? null : $this->getUploadRootDir() . '/' . $this->path3;
    }

    public function getWebPath3()
    {
        return null === $this->path3 ? null : $this->getUploadDir() . '/' . $this->path3;
    }

    /**
     * @Assert\File(maxSize="500000", mimeTypes={"image/jpeg", "image/png", "image/gif"})
     */
    public $file4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="file4")
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $path4;

    /**
     *
     * @ORM\Column(name="altPath4", type="string", length=255, nullable=true )
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $altPath4;


    public function getAbsolutePath4()
    {
        return null === $this->path4 ? null : $this->getUploadRootDir() . '/' . $this->path4;
    }

    public function getWebPath4()
    {
        return null === $this->path4 ? null : $this->getUploadDir() . '/' . $this->path4;
    }


    /**
     * @Assert\File(maxSize="500000", mimeTypes={"image/jpeg", "image/png", "image/gif"})
     */
    public $file5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="file5")
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $path5;

    /**
     *
     * @ORM\Column(name="altPath5", type="string", length=255, nullable=true )
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $altPath5;


    public function getAbsolutePath5()
    {
        return null === $this->path5 ? null : $this->getUploadRootDir() . '/' . $this->path5;
    }

    public function getWebPath5()
    {
        return null === $this->path5 ? null : $this->getUploadDir() . '/' . $this->path5;
    }


    /**
     * @Assert\File(maxSize="500000", mimeTypes={"image/jpeg", "image/png", "image/gif"})
     */
    public $file6;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="file6")
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $path6;

    /**
     *
     * @ORM\Column(name="altPath6", type="string", length=255, nullable=true )
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $altPath6;


    public function getAbsolutePath6()
    {
        return null === $this->path6 ? null : $this->getUploadRootDir() . '/' . $this->path6;
    }

    public function getWebPath6()
    {
        return null === $this->path6 ? null : $this->getUploadDir() . '/' . $this->path6;
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

                $oldFile = $this->getAbsolutePath1();
                if ($oldFile && isset($this->path1)) {
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $extension = strrchr($this->file1->getClientOriginalName(),'.');

                $filename  = str_replace($extension, '', $this->file1->getClientOriginalName());

                $this->path1 = urlencode($filename) . '.' . $this->file1->guessExtension();

            }
        }
        if (isset($this->file2)) {
            if (null !== $this->file2) {

                $oldFile = $this->getAbsolutePath2();
                if ($oldFile && isset($this->path2)) {
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $extension = strrchr($this->file2->getClientOriginalName(),'.');

                $filename  = str_replace($extension, '', $this->file2->getClientOriginalName());

                $this->path2 = urlencode($filename) . '.' . $this->file2->guessExtension();
            }
        }
        if (isset($this->file3)) {
            if (null !== $this->file3) {

                $oldFile = $this->getAbsolutePath3();
                if ($oldFile && isset($this->path3)) {
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $extension = strrchr($this->file3->getClientOriginalName(),'.');

                $filename  = str_replace($extension, '', $this->file3->getClientOriginalName());

                $this->path3 = urlencode($filename) . '.' . $this->file3->guessExtension();
            }
        }
        if (isset($this->file4)) {
            if (null !== $this->file4) {

                $oldFile = $this->getAbsolutePath4();
                if ($oldFile && isset($this->path4)) {
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $extension = strrchr($this->file4->getClientOriginalName(),'.');

                $filename  = str_replace($extension, '', $this->file4->getClientOriginalName());

                $this->path4 = urlencode($filename) . '.' . $this->file4->guessExtension();
            }
        }
        if (isset($this->file5)) {
            if (null !== $this->file5) {

                $oldFile = $this->getAbsolutePath5();
                if ($oldFile && isset($this->path5)) {
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $extension = strrchr($this->file5->getClientOriginalName(),'.');

                $filename  = str_replace($extension, '', $this->file5->getClientOriginalName());

                $this->path5 = urlencode($filename) . '.' . $this->file5->guessExtension();
            }
        }
        if (isset($this->file6)) {
            if (null !== $this->file6) {

                $oldFile = $this->getAbsolutePath6();
                if ($oldFile && isset($this->path6)) {
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $extension = strrchr($this->file6->getClientOriginalName(),'.');

                $filename  = str_replace($extension, '', $this->file6->getClientOriginalName());

                $this->path6 = urlencode($filename) . '.' . $this->file6->guessExtension();
            }
        }
        if (isset($this->filePj)) {
            if (null !== $this->filePj) {

                $oldFile = $this->getAbsolutePathPj();
                if ($oldFile && isset($this->filePj)) {
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $this->pathPj = sha1(uniqid(mt_rand(), true)).'.'.$this->filePj->guessExtension();

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
        if (isset($this->file5)) {
            if (null === $this->file5) {
                return;
            }
            $this->file5->move($this->getUploadRootDir(), $this->path5);
            unset($this->file5);
        }
        if (isset($this->file6)) {
            if (null === $this->file6) {
                return;
            }
            $this->file6->move($this->getUploadRootDir(), $this->path6);
            unset($this->file6);
        }
        if (isset($this->filePj)) {
            if (null === $this->filePj) {
                return;
            }
            $this->filePj->move($this->getUploadRootDir(), $this->pathPj);
            unset($this->filePj);
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
        if ($file = $this->getAbsolutePath6()) {
            unlink($file);
        }
        if ($file = $this->getAbsolutePath6()) {
            unlink($file);
        }
        if ($file = $this->getAbsolutePathPj()) {
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

    /**
     * @return mixed
     */
    public function getAltPath5()
    {
        return $this->altPath5;
    }

    /**
     * @param mixed $altPath5
     */
    public function setAltPath5($altPath5)
    {
        $this->altPath5 = $altPath5;
    }

    /**
     * @return mixed
     */
    public function getAltPath6()
    {
        return $this->altPath6;
    }

    /**
     * @param mixed $altPath6
     */
    public function setAltPath6($altPath6)
    {
        $this->altPath6 = $altPath6;
    }

    /**
     * @return mixed
     */
    public function getPath5()
    {
        return $this->path5;
    }

    /**
     * @param mixed $path5
     */
    public function setPath5($path5)
    {
        $this->path5 = $path5;
    }

    /**
     * @return mixed
     */
    public function getPath6()
    {
        return $this->path6;
    }

    /**
     * @param mixed $path6
     */
    public function setPath6($path6)
    {
        $this->path6 = $path6;
    }

    /**
     * @return mixed
     */
    public function getPathPj()
    {
        return $this->pathPj;
    }

    /**
     * @param mixed $pathPj
     */
    public function setPathPj($pathPj)
    {
        $this->pathPj = $pathPj;

        return $this;
    }


}
