<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\TimeTable
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TimeTable
{
	
	/**
	 * @var integer $tableID
	 *
	 * @ORM\Column(name="tableID", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $tableID;
	
    /**
     * @ORM\ManyToOne(targetEntity="AcademicYear", inversedBy="timetables")
     * @ORM\JoinColumn(name="ayearID", referencedColumnName="ayearID")
     */
    private $academicYear;

    /**
     * @ORM\ManyToOne(targetEntity="Semester", inversedBy="timetables")
     * @ORM\JoinColumn(name="semID", referencedColumnName="semID")
     */
    protected $sem;
    
    /**
     * @ORM\ManyToOne(targetEntity="Year", inversedBy="timetables")
     * @ORM\JoinColumn(name="yearID", referencedColumnName="yearID")
     */
    protected $year;

    /**
     * @ORM\ManyToOne(targetEntity="Degree", inversedBy="timetables")
     * @ORM\JoinColumn(name="degreeID", referencedColumnName="degreeID")
     */
    private $degree;

    /**
     * @ORM\OneToMany(targetEntity="TimeSlot", mappedBy="timetable", cascade={"persist"})
     */
    private $slots;
    
    public function __construct()
    {
    	$this->slots = new ArrayCollection();
    }


    public function __toString()
    {
    	return $this->getAcademicYear()." ".$this->getDegree()." year ".$this->getYear()." semester ".$this->getSem();
    }
    
    /**
     * Get tableID
     *
     * @return integer 
     */
    public function getTableID()
    {
        return $this->tableID;
    }

    /**
     * Set academicYear
     *
     * @param UCSC\DatabaseBundle\Entity\AcademicYear $academicYear
     */
    public function setAcademicYear(\UCSC\DatabaseBundle\Entity\AcademicYear $academicYear)
    {
        $this->academicYear = $academicYear;
    }

    /**
     * Get academicYear
     *
     * @return UCSC\DatabaseBundle\Entity\AcademicYear 
     */
    public function getAcademicYear()
    {
        return $this->academicYear;
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
     * Add slots
     *
     * @param UCSC\DatabaseBundle\Entity\TimeSlot $slots
     */
    public function addTimeSlot(\UCSC\DatabaseBundle\Entity\TimeSlot $slots)
    {
        $this->slots[] = $slots;
    }

    /**
     * Get slots
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSlots()
    {
        return $this->slots;
    }
}