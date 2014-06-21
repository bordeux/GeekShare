<?php

namespace Acme\GeekShareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * User
 *
 * @ORM\Table(name="gs_users")
 * @ORM\Entity
 */
class User implements UserInterface {

    /**
     * @var integer
     *
     * @ORM\Column(name="usr_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_name", type="string", length=30)
     */
    private $name;
    
    /**
     * @var array
     *
     * @ORM\Column(name="usr_roles", type="json_array")
     */
    private $roles;


    
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    

    /**
     * Set roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        return $this->roles;
    }
    
    

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = self::hashPassword($password);

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
    
    
    public static function hashPassword($password){
        return hash('sha512', $password);
    }
    
    
    public function validyPassword($password){
        return $this->password == self::hashPassword($password);
    }

    public function eraseCredentials() {
        $this->password = uniqid().uniqid();
        return $this;
    }

    public function getSalt() {
        return "test";
    }

    public function getUsername() {
        return $this->getEmail();
    }

}
