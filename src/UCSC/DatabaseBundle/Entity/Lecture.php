<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UCSC\DatabaseBundle\Entity\Lecture
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Lecture
{

    /**
     * @var string $lectureID
     * @ORM\Id
     * @ORM\Column(name="lectureID", type="string", length=8)
     */
    private $lectureID;

    
    /**
     * @var string $title
     * @ORM\Column(name="title", type="string", length=4)
     */
    private $title;
    
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer $phoneNo
     *
     * @ORM\Column(name="phoneNo", type="integer", nullable=true)
     */
    private $phoneNo;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;
    
    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;
	
	/**
     * @var string $detials
     *
     * @ORM\Column(name="detials", type="string", length=255, nullable=true)
     */
    private $detials;
    
    /**
     * @ORM\OneToMany(targetEntity="LectureAyearCourse", mappedBy="lectureID")
     */
    protected $lecayearcourses;
    
    /**
     * @ORM\OneToOne(targetEntity="LectureUser", mappedBy="lecture")
     */
    protected $user;
    
    public function __construct()
    {
    	$this->lecayearcourses = new ArrayCollection();
    }
    
    public function __toString()
    {
    	return $this->getName();
    }


    /**
     * Set lectureID
     *
     * @param string $lectureID
     */
    public function setLectureID($lectureID)
    {
        $this->lectureID = $lectureID;
    }

    /**
     * Get lectureID
     *
     * @return string 
     */
    public function getLectureID()
    {
        return $this->lectureID;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set phoneNo
     *
     * @param integer $phoneNo
     */
    public function setPhoneNo($phoneNo)
    {
        $this->phoneNo = $phoneNo;
    }

    /**
     * Get phoneNo
     *
     * @return integer 
     */
    public function getPhoneNo()
    {
        return $this->phoneNo;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * Set detials
     *
     * @param string $detials
     */
    public function setDetials($detials)
    {
        $this->detials = $detials;
    }

    /**
     * Get detials
     *
     * @return string 
     */
    public function getDetials()
    {
        return $this->detials;
    }

    /**
     * Add lecayearcourses
     *
     * @param UCSC\DatabaseBundle\Entity\LectureAyearCourse $lecayearcourses
     */
    public function addLectureAyearCourse(\UCSC\DatabaseBundle\Entity\LectureAyearCourse $lecayearcourses)
    {
        $this->lecayearcourses[] = $lecayearcourses;
    }

    /**
     * Get lecayearcourses
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLecayearcourses()
    {
        return $this->lecayearcourses;
    }

    /**
     * Set user
     *
     * @param UCSC\DatabaseBundle\Entity\LectureUser $user
     */
    public function setUser(\UCSC\DatabaseBundle\Entity\LectureUser $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return UCSC\DatabaseBundle\Entity\LectureUser 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
}