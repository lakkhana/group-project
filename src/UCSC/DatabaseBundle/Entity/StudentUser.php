<?php

namespace UCSC\DatabaseBundle\Entity;
 
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="StudentUser")
 */
class StudentUser implements UserInterface
{
    /**
     * 
     * @ORM\OneToOne(targetEntity="Student", inversedBy="user")
     * @ORM\JoinColumn(name="studentID", referencedColumnName="regNo")
	 * 
     */
    private $student;
	
	/**
     * @ORM\Column(type="string", length="255")
     * @ORM\Id
     * @var string username
     */
    protected $username;
 
    /**
     * @ORM\Column(type="string", length="255")
     *
     * @var string password
     */
    protected $password;
 
    /**
     * @ORM\Column(type="string", length="255")
     *
     * @var string salt
     */
    protected $salt;
    
    /**
     * @ORM\Column(type="date", name="created_at")
     *
     * @var DateTime $createdAt
     */
    protected $createdAt;
 
    /**
     * @ORM\Column(type="string", length="255")
     *
     * @var string role
     */
    protected $role;

    
    /**
     * Gets the username.
     *
     * @return string The username.
     */
    public function getUsername()
    {
        return $this->username;
    }
 
    /**
     * Sets the username.
     *
     * @param string $value The username.
     */
    public function setUsername($value)
    {
        $this->username = $value;
    }
 
    /**
     * Gets the user password.
     *
     * @return string The password.
     */
    public function getPassword()
    {
        return $this->password;
    }
 
    /**
     * Sets the user password.
     *
     * @param string $value The password.
     */
    public function setPassword($value)
    {
        $this->password = $value;
    }
 
    /**
     * Gets the user salt.
     *
     * @return string The salt.
     */
    public function getSalt()
    {
        return $this->salt;
    }
 
    /**
     * Sets the user salt.
     *
     * @param string $value The salt.
     */
    public function setSalt($value)
    {
        $this->salt = $value;
    }
    
    /**
     * Gets the DateTime the user was created.
     *
     * @return DateTime A DateTime object.
     */
    public function getCreatedAt()
    {
    	return $this->createdAt;
    }
 
    /**
     * Gets the user role.
     *
     * @return string The role.
     */
    public function getRole()
    {
        return $this->userRoles;
    }
    
    /**
     * Sets the user roles.
     *
     * @param string $value The role.
     */
    public function setRole($value)
    {
    	$this->role = $value;
    }
 
    /**
     * Constructs a new instance of User
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
 
    /**
     * Erases the user credentials.
     */
    public function eraseCredentials()
    {
 
    }
 
    /**
     * Gets an array of roles.
     * 
     * @return array An array of Role objects
     */
    public function getRoles()
    {
        return array($this->role);
    }
 
    /**
     * Compares this user to another to determine if they are the same.
     * 
     * @param UserInterface $user The user
     * @return boolean True if equal, false othwerwise.
     */
    public function equals(UserInterface $user)
    {
        return md5($this->getUsername()) == md5($user->getUsername());
    }
 


    /**
     * Set createdAt
     *
     * @param date $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Set student
     *
     * @param UCSC\DatabaseBundle\Entity\Student $student
     */
    public function setStudent(\UCSC\DatabaseBundle\Entity\Student $student)
    {
        $this->student = $student;
    }

    /**
     * Get student
     *
     * @return UCSC\DatabaseBundle\Entity\Student 
     */
    public function getStudent()
    {
        return $this->student;
    }
}