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
     * @var string
     *
     * @ORM\Column(name="dir_path", type="string", length=150)
     */
    private $path;

    /**
     * @var integer
     *
     * @ORM\Column(name="usr_id", type="integer")
     */
    private $usrId;

    /**
     * @var string
     *
     * @ORM\Column(name="file_file_name", type="string", length=150)
     */
    private $fileName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="file_uniqid", type="string", length=150)
     */
    private $uniqid;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_file_size", type="integer")
     */
    private $fileSize;

    /**
     * @var string
     *
     * @ORM\Column(name="file_md5", type="string", length=32)
     */
    private $md5;
    
    /**
     * @var string
     *
     * @ORM\Column(name="file_key", type="string", length=32)
     */
    private $key;
    
    /**
     * @var string
     *
     * @ORM\Column(name="file_mime", type="string", length=100)
     */
    private $mime;

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
     * @param string $path
     * @return File
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
     * @return File
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
     * Set public key access to file
     *
     * @param string $key
     * @return File
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get public file key
     *
     * @return boolean 
     */
    public function getKey()
    {
        return $this->key;
    }
    
  
    /**
     * Set mime type
     * @param string $mime
     * @return \Acme\GeekShareBundle\Entity\File
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get mime type
     *
     * @return string 
     */
    public function getMime()
    {
        return $this->mime;
    }
    
    /**
     * 
     * @param string $filePath
     * @return boolean;
     */
    public function setFile($filePath){
        $this->uniqid = uniqid();
        $this->setFileSize(filesize($filePath));
        $this->setMd5(md5_file($filePath));
        $this->setKey(md5(uniqid().rand().uniqid().rand()));
        
        return move_uploaded_file($filePath, $this->getFile());
    }
    
    /**
     * Get file path
     * @return string
     */
    public function getFile(){
        return GS_ROOT_DIR.'/files/'.$this->uniqid;
    }
}
