<?php

namespace ZIMZIM\CategoryProductBundle\Model\ItemHome;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Gedmo\Translatable\Translatable;
use Symfony\Component\Validator\Constraints as Assert;
use ZIMZIM\ToolsBundle\Model\APYDataGrid\ApyDataGridFilePathInterface;
use ZIMZIM\CategoryProductBundle\Model\TitleDescriptionTrait;
use ZIMZIM\ToolsBundle\Model\FileUpload;

/**
 * ItemHome
 *
 * @ORM\MappedSuperclass
 *
 */
abstract class ItemHome extends FileUpload implements Translatable, ApyDataGridFilePathInterface, ItemHomeInterface
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

    /******************************** IMAGE **************************/
    /**
     * @Assert\File(maxSize="500000")
     */
    public $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @GRID\Column(operatorsVisible=false, safe=false, title="ZIMZIMToolsBundle.grid.file")
     */
    public $path;

    protected function getUploadDir()
    {
        return 'resources/itemhome';
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../../web/' . $this->getUploadDir();
    }

    use TitleDescriptionTrait;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $updatedAt;

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

}
