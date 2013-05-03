<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * UCSC\DatabaseBundle\Entity\Year
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Year
{
    /**
     * @var integer $yearID
     *
     * @ORM\Column(name="yearID", type="smallint")
     * @ORM\Id
     */
    private $yearID;

	/**
	 * @ORM\OneToMany(targetEntity="TimeTable", mappedBy="year")
	 */
	protected $timetables;

	/**
	 * @ORM\OneToMany(targetEntity="Student", mappedBy="year")
	 */
	protected $students;
	
	/**
	 * @ORM\OneToMany(targetEntity="Course", mappedBy="year")
	 */
	protected $courses;
	
	public function __construct()
	{
		$this->timetables = new ArrayCollection();
		$this->courses = new ArrayCollection();
		$this->students = new ArrayCollection();
	}

	public function __toString()
	{
		return (string)$this->getYearID();
	}

    /**
     * Set yearID
     *
     * @param smallint $yearID
     */
    public function setYearID($yearID)
    {
        $this->yearID = $yearID;
    }

    /**
     * Get yearID
     *
     * @return smallint 
     */
    public function getYearID()
    {
        return $this->yearID;
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