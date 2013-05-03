<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UCSC\DatabaseBundle\Entity\AcademicYear
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AcademicYear
{
    /**
     * @var integer $ayearID
     *
     * @ORM\Column(name="ayearID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $ayearID;

     /**
     * @var string $academicYear
     *
     * @ORM\Column(name="academicYear", type="string")
     */
    protected $academicYear;
    
    /**
     * @ORM\OneToMany(targetEntity="AyearCourse", mappedBy="academicYear")
     */
    protected $ayearcourses;
    
    /**
     * @ORM\OneToMany(targetEntity="TimeTable", mappedBy="academicYear")
     */
    protected $timetables;
    
    public function __construct()
    {
    	$this->ayearcourses = new ArrayCollection();
    	$this->timetables = new ArrayCollection();
    	
    }
    public function __toString()
    {
    	return $this->getAcademicYear();
    }
    
    /**
     * Get ayearID
     *
     * @return integer 
     */
    public function getAyearID()
    {
        return $this->ayearID;
    }

    /**
     * Set academicYear
     *
     * @param string $academicYear
     */
    public function setAcademicYear($academicYear)
    {
        $this->academicYear = $academicYear;
    }

    /**
     * Get academicYear
     *
     * @return string 
     */
    public function getAcademicYear()
    {
        return $this->academicYear;
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
}