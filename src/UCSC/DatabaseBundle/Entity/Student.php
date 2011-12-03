<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Group\TestBundle\Entity\Student
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
     * @var string $degree
     *
     * @ORM\Column(name="degree", type="string", length=4)
     */
    protected $degree;
    
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
     * @ORM\Column(name="indexNo", type="integer")
     */
    protected $indexNo;

    /**
     * @ORM\OneToMany(targetEntity="Result", mappedBy="studentID")
     */
    protected $results;

    public function __construct()
    {
        $this->results = new ArrayCollection();
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
     * Add results
     *
     * @param Group\TestBundle\Entity\Result $results
     */
    public function addResult(\Group\TestBundle\Entity\Result $results)
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
}
