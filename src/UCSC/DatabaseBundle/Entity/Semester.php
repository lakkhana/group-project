<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UCSC\DatabaseBundle\Entity\Semester
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Semester
{
    /**
     * @var integer $semID
     *
     * @ORM\Column(name="semID", type="smallint")
     * @ORM\Id
     */
    private $semID;

	/**
	 * @ORM\OneToMany(targetEntity="TimeTable", mappedBy="sem")
	 */
	protected $timetables;

	/**
	 * @ORM\OneToMany(targetEntity="Course", mappedBy="sem")
	 */
	protected $courses;
	
	public function __construct()
	{
		$this->timetables = new ArrayCollection();
		$this->courses = new ArrayCollection();
	}
	
	public function __toString()
	{
		return (string)$this->getSemID();
	}
	

    /**
     * Set semID
     *
     * @param smallint $semID
     */
    public function setSemID($semID)
    {
        $this->semID = $semID;
    }

    /**
     * Get semID
     *
     * @return smallint 
     */
    public function getSemID()
    {
        return $this->semID;
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