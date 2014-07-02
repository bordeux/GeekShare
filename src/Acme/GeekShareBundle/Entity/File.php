<?php

namespace Acme\GeekShareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="gs_files")
 * @ORM\Entity
 */
class File
{
    /**
     * @var integer
     *
     * @ORM\Column(name="file_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="dir_id", type="integer")
     */
    private $dirId;

    /**
     * @var integer
     *
     * @ORM\Column(name="usr_id", type="integer")
     */
    private $usrId;

    /**
     * @var string
     *
     * @ORM\Column(name="file_fileName", type="string", length=150)
     */
    private $fileName;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_fileSize", type="integer")
     */
    private $fileSize;

    /**
     * @var string
     *
     * @ORM\Column(name="file_md5", type="string", length=32)
     */
    private $md5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="file_deleted", type="boolean")
     */
    private $deleted = false;
    

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
     * Set dirId
     *
     * @param integer $dirId
     * @return File
     */
    public function setDirId($dirId)
    {
        $this->dirId = $dirId;

        return $this;
    }

    /**
     * Get dirId
     *
     * @return integer 
     */
    public function getDirId()
    {
        return $this->dirId;
    }

    /**
     * Set usrId
     *
     * @param integer $usrId
     * @return File
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

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return File
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set fileSize
     *
     * @param integer $fileSize
     * @return File
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get fileSize
     *
     * @return integer 
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set md5
     *
     * @param string $md5
     * @return File
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;

        return $this;
    }

    /**
     * Get md5
     *
     * @return string 
     */
    public function getMd5()
    {
        return $this->md5;
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
}
