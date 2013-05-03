<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\Result
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Result
{

    /**
     * @var boolean $conform
     *
     * @ORM\Column(name="conform", type="boolean", nullable=true)
     */
    protected $conform;
    /**
     * @var integer $score
     *
     * @ORM\Column(name="score", type="integer", nullable=true)
     */
    protected $score;
    
    /**
     * @var integer $papper
     *
     * @ORM\Column(name="papper", type="integer", nullable=true)
     */
    protected $papper;
    
    /**
     * @var integer $assignment
     *
     * @ORM\Column(name="assignment", type="integer", nullable=true)
     */
    protected $assignment;

    
    /**
     * @var string $grade
     *
     * @ORM\Column(name="grade", type="string", length=2, nullable=true)
     */
    protected $grade;
    
    /**
     * @var string $hashval
     *
     * @ORM\Column(name="hashval", type="string", nullable=true)
     */
    protected $hashval;
    /**
     * @var string $time
     *
     * @ORM\Column(name="time", type="string", nullable=true)
     */
    protected $time;

    /**
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="results")
     * @ORM\Id
     * @ORM\JoinColumn(name="studentID", referencedColumnName="regNo")
     */
    protected $student;
    
    /**
     * @ORM\ManyToOne(targetEntity="AyearCourse", inversedBy="results")
     * @ORM\Id
     * @ORM\JoinColumn(name="acid", referencedColumnName="acid")
     */
    protected $ayearcourse;
    

    /**
     * Set conform
     *
     * @param boolean $conform
     */
    public function setConform($conform)
    {
        $this->conform = $conform;
    }

    /**
     * Get conform
     *
     * @return boolean 
     */
    public function getConform()
    {
        return $this->conform;
    }

    /**
     * Set score
     *
     * @param integer $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set papper
     *
     * @param integer $papper
     */
    public function setPapper($papper)
    {
        $this->papper = $papper;
    }

    /**
     * Get papper
     *
     * @return integer 
     */
    public function getPapper()
    {
        return $this->papper;
    }

    /**
     * Set assignment
     *
     * @param integer $assignment
     */
    public function setAssignment($assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Get assignment
     *
     * @return integer 
     */
    public function getAssignment()
    {
        return $this->assignment;
    }

    /**
     * Set grade
     *
     * @param string $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * Get grade
     *
     * @return string 
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set hashval
     *
     * @param string $hashval
     */
    public function setHashval($hashval)
    {
        $this->hashval = $hashval;
    }

    /**
     * Get hashval
     *
     * @return string 
     */
    public function getHashval()
    {
        return $this->hashval;
    }

    /**
     * Set time
     *
     * @param string $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * Get time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set student
     *
     * @param UCSC\DatabaseBundle\Entity\Student $student
     */
    public function setStudent(\UCSC\DatabaseBundle\Entity\Student $student)
    {
        $this->student = $student;
    }

    /**
     * Get student
     *
     * @return UCSC\DatabaseBundle\Entity\Student 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set ayearcourse
     *
     * @param UCSC\DatabaseBundle\Entity\AyearCourse $ayearcourse
     */
    public function setAyearcourse(\UCSC\DatabaseBundle\Entity\AyearCourse $ayearcourse)
    {
        $this->ayearcourse = $ayearcourse;
    }

    /**
     * Get ayearcourse
     *
     * @return UCSC\DatabaseBundle\Entity\AyearCourse 
     */
    public function getAyearcourse()
    {
        return $this->ayearcourse;
    }
}