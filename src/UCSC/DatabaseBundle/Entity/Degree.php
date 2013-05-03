<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UCSC\DatabaseBundle\Entity\Degree
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Degree
{
	/**
	 * @var string $degreeID
	 *
	 * @ORM\Column(name="degreeID", type="string", length=4)
	 * @ORM\Id
	 */
	private $degreeID;
	
	/**
	 * @var string $name
	 *
	 * @ORM\Column(name="name", type="string", length=255)
	 */
	private $name;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="TimeTable", mappedBy="degree")
	 */
	protected $timetables;
	
	/**
	 * @ORM\OneToMany(targetEntity="Student", mappedBy="degree")
	 */
	protected $students;
	
	/**
	 * @ORM\OneToMany(targetEntity="Course", mappedBy="degree")
	 */
	protected $courses;
	
	public function __construct()
	{
		$this->students = new ArrayCollection();
		$this->courses = new ArrayCollection();
		$this->timetables = new ArrayCollection();
	}
	
	public function __toString()
	{
		return $this->getDegreeID();
	}

    /**
     * Set degreeID
     *
     * @param string $degreeID
     */
    public function setDegreeID($degreeID)
    {
        $this->degreeID = $degreeID;
    }

    /**
     * Get degreeID
     *
     * @return string 
     */
    public function getDegreeID()
    {
        return $this->degreeID;
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
     * Add timetables
     *
     * @param UCSC\DatabaseBundle\Entity\TimeTable $timetables
     */
    public function addTimeTable(\UCSC\DatabaseBundle\Entity\TimeTable $timetables)
    {
        $this->timetables[] = $timetables;
    }

    /**
     * Get timetables
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTimetables()
    {
        return $this->timetables;
    }

    /**
     * Add students
     *
     * @param UCSC\DatabaseBundle\Entity\Student $students
     */
    public function addStudent(\UCSC\DatabaseBundle\Entity\Student $students)
    {
        $this->students[] = $students;
    }

    /**
     * Get students
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Add courses
     *
     * @param UCSC\DatabaseBundle\Entity\Course $courses
     */
    public function addCourse(\UCSC\DatabaseBundle\Entity\Course $courses)
    {
        $this->courses[] = $courses;
    }

    /**
     * Get courses
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCourses()
    {
        return $this->courses;
    }
}