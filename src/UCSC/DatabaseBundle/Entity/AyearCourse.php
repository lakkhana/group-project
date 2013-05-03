<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UCSC\DatabaseBundle\Entity\AyearCourse
 * @ORM\Table()
 * @ORM\Entity
 */
class AyearCourse
{
    /**
     * @var integer $acid
     *
     * @ORM\Column(name="acid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $acid;

    /**
     * @ORM\ManyToOne(targetEntity="AcademicYear", inversedBy="ayearcourses")
     * @ORM\JoinColumn(name="ayearID", referencedColumnName="ayearID")
     */
    protected $academicYear;
    
    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="ayearcourses")
     * @ORM\JoinColumn(name="courseID", referencedColumnName="courseID")
     */
    protected $course;
    
    /**
     * @ORM\OneToMany(targetEntity="Result", mappedBy="ayearcourse")
     */
    protected $results;
    
    /**
     * @ORM\OneToMany(targetEntity="LectureAyearCourse", mappedBy="ayearcourse")
     */
    protected $lecayearcourses;
    
    /**
     * @ORM\OneToMany(targetEntity="TimeSlot", mappedBy="ayearcourse")
     */
    protected $slots;
    
    public function __construct()
    {
    	$this->results = new ArrayCollection();
    	$this->lecayearcourses = new ArrayCollection();
    	$this->slots = new ArrayCollection();
    	
    }
    
    public function __toString()
    {
    	return $this->getCourse()->getCourseID();
    }

    /**
     * Get acid
     *
     * @return integer 
     */
    public function getAcid()
    {
        return $this->acid;
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
     * Set course
     *
     * @param UCSC\DatabaseBundle\Entity\Course $course
     */
    public function setCourse(\UCSC\DatabaseBundle\Entity\Course $course)
    {
        $this->course = $course;
    }

    /**
     * Get course
     *
     * @return UCSC\DatabaseBundle\Entity\Course 
     */
    public function getCourse()
    {
        return $this->course;
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