<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group\TestBundle\Entity\Result
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Result
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $score
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

    /**
     * @var smallint $term
     *
     * @ORM\Column(name="term", type="smallint")
     */
    private $term;


    /**
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="results")
     * @ORM\JoinColumn(name="studentID", referencedColumnName="regNo")
     */
    protected $studentID;
    
        /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="results")
     * @ORM\JoinColumn(name="courseID", referencedColumnName="courseID")
     */
    protected $courseID;
    
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * Set term
     *
     * @param smallint $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }

    /**
     * Get term
     *
     * @return smallint 
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Set studentID
     *
     * @param Group\TestBundle\Entity\Student $studentID
     */
    public function setStudentID(\Group\TestBundle\Entity\Student $studentID)
    {
        $this->studentID = $studentID;
    }

    /**
     * Get studentID
     *
     * @return Group\TestBundle\Entity\Student 
     */
    public function getStudentID()
    {
        return $this->studentID;
    }

    /**
     * Set courseID
     *
     * @param Group\TestBundle\Entity\Course $courseID
     */
    public function setCourseID(\Group\TestBundle\Entity\Course $courseID)
    {
        $this->courseID = $courseID;
    }

    /**
     * Get courseID
     *
     * @return Group\TestBundle\Entity\Course 
     */
    public function getCourseID()
    {
        return $this->courseID;
    }
}
