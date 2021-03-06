<?php

namespace Acme\GeekShareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Directory
 *
 * @ORM\Table(name="gs_directories")
 * @ORM\Entity
 */
class Directory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dir_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dir_path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="dir_name", type="string", length=30)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dir_lastModified", type="datetime")
     */
    private $lastModified;

    /**
     * @var integer
     *
     * @ORM\Column(name="dir_files", type="integer")
     */
    private $files;

    /**
     * @var integer
     *
     * @ORM\Column(name="dir_deep", type="smallint")
     */
    private $deep;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="dir_deleted", type="boolean")
     */
    private $deleted = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="usr_id", type="integer")
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $usrId;


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
     * Set path
     *
     * @param string $path
     * @return Directory
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Directory
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
     * Set lastModified
     *
     * @param \DateTime $lastModified
     * @return Directory
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTime 
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Set files
     *
     * @param integer $files
     * @return Directory
     */
    public function setFiles($files)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * Get files
     *
     * @return integer 
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Set deep
     *
     * @param integer $deep
     * @return Directory
     */
    public function setDeep($deep)
    {
        $this->deep = $deep;

        return $this;
    }

    /**
     * Get deep
     *
     * @return integer 
     */
    public function getDeep()
    {
        return $this->deep;
    }
    
    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Directory
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set usrId
     *
     * @param integer $usrId
     * @return Directory
     */
    public function setUsrId($usrId)
    {
        $this->usrId = $usrId;

        return $this;
    }

    /**
     * Get usrId
     *
     * @return integer 
     */
    public function getUsrId()
    {
        return $this->usrId;
    }
}
