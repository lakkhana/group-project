<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UCSC\DatabaseBundle\Entity\Course
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Course
{
    /**
     * @var string $courseID
     * @ORM\Id
     * @ORM\Column(name="courseID", type="string", length=8)
     */
    protected $courseID;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var smallint $credit
     *
     * @ORM\Column(name="credit", type="smallint")
     */
    protected $credit;
    
    /**
     * @ORM\ManyToOne(targetEntity="Degree", inversedBy="courses")
     * @ORM\JoinColumn(name="degreeID", referencedColumnName="degreeID")
     */
    protected $degree;
    
    /**
     * @var smallint $percentage
     *
     * @ORM\Column(name="percentage", type="smallint")
     */
    protected $percentage;
    
    /**
     * @ORM\ManyToOne(targetEntity="Semester", inversedBy="courses")
     * @ORM\JoinColumn(name="semID", referencedColumnName="semID")
     */
    protected $sem;
    
    /**
     * @ORM\ManyToOne(targetEntity="Year", inversedBy="courses")
     * @ORM\JoinColumn(name="yearID", referencedColumnName="yearID")
     */
    protected $year;
    
    /**
     * @ORM\OneToMany(targetEntity="AyearCourse", mappedBy="course")
     */
    protected $ayearcourses;
    
    public function __construct()
    {
    	$this->ayearcourses = new ArrayCollection();
    }

    public function __toString()
    {
    	return $this->getCourseID();
    }
    


    /**
     * Set courseID
     *
     * @param string $courseID
     */
    public function setCourseID($courseID)
    {
        $this->courseID = $courseID;
    }

    /**
     * Get courseID
     *
     * @return string 
     */
    public function getCourseID()
    {
        return $this->courseID;
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
     * Set credit
     *
     * @param smallint $credit
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;
    }

    /**
     * Get credit
     *
     * @return smallint 
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set percentage
     *
     * @param smallint $percentage
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    }

    /**
     * Get percentage
     *
     * @return smallint 
     */
    public function getPercentage()
    {
        return $this->percentage;
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
     * Set sem
     *
     * @param UCSC\DatabaseBundle\Entity\Semester $sem
     */
    public function setSem(\UCSC\DatabaseBundle\Entity\Semester $sem)
    {
        $this->sem = $sem;
    }

    /**
     * Get sem
     *
     * @return UCSC\DatabaseBundle\Entity\Semester 
     */
    public function getSem()
    {
        return $this->sem;
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
     * Add ayearcourses
     *
     * @param UCSC\DatabaseBundle\Entity\AyearCourse $ayearcourses
     */
    public function addAyearCourse(\UCSC\DatabaseBundle\Entity\AyearCourse $ayearcourses)
    {
        $this->ayearcourses[] = $ayearcourses;
    }

    /**
     * Get ayearcourses
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAyearcourses()
    {
        return $this->ayearcourses;
    }
}