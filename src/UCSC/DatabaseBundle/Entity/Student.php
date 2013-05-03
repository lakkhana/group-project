<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UCSC\DatabaseBundle\Entity\Student
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Student
{
    /**
     * @var string $regNo
     * @ORM\Id
     * @ORM\Column(name="regNo", type="string", length=10)
     */
    protected $regNo;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;
    
    /**
     * @var string $gender
     *
     * @ORM\Column(name="gender", type="string", length=2)
     */
    protected $gender;
    
    /**
     * @var string $nic
     *
     * @ORM\Column(name="nic", type="string", length=12)
     */
    protected $nic;
    
    
    /**
     * @var date $bday
     *
     * @ORM\Column(name="bday", type="date")
     */
    protected $bday;
    
    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    protected $address;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    protected $email;
    
    /**
     * @var integer $phone
     *
     * @ORM\Column(name="phone", type="integer")
     */
    protected $phone;

    /**
     * @var integer $indexNo
     *
     * @ORM\Column(name="indexNo", type="integer", nullable=true)
     */
    protected $indexNo;

    /**
     * @ORM\OneToMany(targetEntity="Result", mappedBy="student")
     */
    protected $results;
    
    /**
     * @ORM\OneToOne(targetEntity="Mahapola", mappedBy="student")
     */
    protected $mahapola;
    
    /**
     * @ORM\OneToOne(targetEntity="Bursary", mappedBy="student")
     */
    protected $bursary;
    
    /**
     * @ORM\OneToOne(targetEntity="StudentUser", mappedBy="student")
     */
    protected $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Degree", inversedBy="students")
     * @ORM\JoinColumn(name="degreeID", referencedColumnName="degreeID")
     */
    protected $degree;
    
    /**
     * @ORM\ManyToOne(targetEntity="Batch", inversedBy="students")
     * @ORM\JoinColumn(name="batchID", referencedColumnName="batchID")
     */
    protected $batch;
    
    /**
     * @ORM\ManyToOne(targetEntity="Year", inversedBy="students")
     * @ORM\JoinColumn(name="yearID", referencedColumnName="yearID")
     */
    protected $year;
    
    
    public function __construct()
    {
        $this->results = new ArrayCollection();
    }
    
    public function __toString()
    {
    	return $this->getRegNo();
    }

    /**
     * Set regNo
     *
     * @param string $regNo
     */
    public function setRegNo($regNo)
    {
        $this->regNo = $regNo;
    }

    /**
     * Get regNo
     *
     * @return string 
     */
    public function getRegNo()
    {
        return $this->regNo;
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
     * Set gender
     *
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set nic
     *
     * @param string $nic
     */
    public function setNic($nic)
    {
        $this->nic = $nic;
    }

    /**
     * Get nic
     *
     * @return string 
     */
    public function getNic()
    {
        return $this->nic;
    }

    /**
     * Set bday
     *
     * @param date $bday
     */
    public function setBday($bday)
    {
        $this->bday = $bday;
    }

    /**
     * Get bday
     *
     * @return date 
     */
    public function getBday()
    {
        return $this->bday;
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
     * Set phone
     *
     * @param integer $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set indexNo
     *
     * @param integer $indexNo
     */
    public function setIndexNo($indexNo)
    {
        $this->indexNo = $indexNo;
    }

    /**
     * Get indexNo
     *
     * @return integer 
     */
    public function getIndexNo()
    {
        return $this->indexNo;
    }

    /**
     * Add results
     *
     * @param UCSC\DatabaseBundle\Entity\Result $results
     */
    public function addResult(\UCSC\DatabaseBundle\Entity\Result $results)
    {
        $this->results[] = $results;
    }

    /**
     * Get results
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Set mahapola
     *
     * @param UCSC\DatabaseBundle\Entity\Mahapola $mahapola
     */
    public function setMahapola(\UCSC\DatabaseBundle\Entity\Mahapola $mahapola)
    {
        $this->mahapola = $mahapola;
    }

    /**
     * Get mahapola
     *
     * @return UCSC\DatabaseBundle\Entity\Mahapola 
     */
    public function getMahapola()
    {
        return $this->mahapola;
    }

    /**
     * Set bursary
     *
     * @param UCSC\DatabaseBundle\Entity\Bursary $bursary
     */
    public function setBursary(\UCSC\DatabaseBundle\Entity\Bursary $bursary)
    {
        $this->bursary = $bursary;
    }

    /**
     * Get bursary
     *
     * @return UCSC\DatabaseBundle\Entity\Bursary 
     */
    public function getBursary()
    {
        return $this->bursary;
    }

    /**
     * Set user
     *
     * @param UCSC\DatabaseBundle\Entity\StudentUser $user
     */
    public function setUser(\UCSC\DatabaseBundle\Entity\StudentUser $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return UCSC\DatabaseBundle\Entity\StudentUser 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set year
     *
     * @param UCSC\DatabaseBundle\Entity\Year $year
     */
    public function setYear(\UCSC\DatabaseBundle\Entity\Year $year)
    {
        $this->year = $year;
    }

    /**
     * Get year
     *
     * @return UCSC\DatabaseBundle\Entity\Year 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set degree
     *
     * @param UCSC\DatabaseBundle\Entity\Degree $degree
     */
    public function setDegree(\UCSC\DatabaseBundle\Entity\Degree $degree)
    {
        $this->degree = $degree;
    }

    /**
     * Get degree
     *
     * @return UCSC\DatabaseBundle\Entity\Degree 
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set batch
     *
     * @param UCSC\DatabaseBundle\Entity\Batch $batch
     */
    public function setBatch(\UCSC\DatabaseBundle\Entity\Batch $batch)
    {
        $this->batch = $batch;
    }

    /**
     * Get batch
     *
     * @return UCSC\DatabaseBundle\Entity\Batch 
     */
    public function getBatch()
    {
        return $this->batch;
    }
}