<?php

namespace ZIMZIM\CategoryProductBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Gedmo\Translatable\Translatable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ItemHome
 *
 * @ORM\MappedSuperclass
 *
 */
abstract class ItemHome
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
     * @GRID\Column(operatorsVisible=false, title="ZIMZIMCategoryProduct.name")
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var integer
     *
     * @Gedmo\SortablePosition
     *
     * @GRID\Column(operatorsVisible=false, title="ZIMZIMCategoryProduct.position")
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    use TitleDescriptionTrait;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $updatedAt;

    /******************************** IMAGE **************************/
    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @GRID\Column(operatorsVisible=false, safe=false, title="ZIMZIMCategoryProduct.image")
     */
    public $path;

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'resources/itemhome';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (isset($this->file)) {
            if (null !== $this->file) {

                $oldFile = $this->getAbsolutePath();
                if ($oldFile && isset($this->path)) {
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $extension = strrchr($this->file->getClientOriginalName(), '.');

                $filename = str_replace($extension, '', $this->file->getClientOriginalName());

                $this->path = urlencode($filename) . '.' . $this->file->guessExtension();
            }
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (isset($this->file)) {
            if (null === $this->file) {
                return;
            }
            $this->file->move($this->getUploadRootDir(), $this->path);

            unset($this->file);
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return ItemHome
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

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getListAttrImg()
    {
        return array('path');
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }


}
