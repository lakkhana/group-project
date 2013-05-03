<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\LectureAyearCourse
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class LectureAyearCourse
{
    
    /**
     * @ORM\ManyToOne(targetEntity="AyearCourse", inversedBy="lecayearcourses")
     * @ORM\Id
     * @ORM\JoinColumn(name="acid", referencedColumnName="acid")
     */
    protected $ayearcourse;
    
    /**
     * @ORM\ManyToOne(targetEntity="Lecture", inversedBy="lecayearcourses")
     * @ORM\Id
     * @ORM\JoinColumn(name="lectureID", referencedColumnName="lectureID")
     */
    protected $lecture;
    

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

    /**
     * Set lecture
     *
     * @param UCSC\DatabaseBundle\Entity\Lecture $lecture
     */
    public function setLecture(\UCSC\DatabaseBundle\Entity\Lecture $lecture)
    {
        $this->lecture = $lecture;
    }

    /**
     * Get lecture
     *
     * @return UCSC\DatabaseBundle\Entity\Lecture 
     */
    public function getLecture()
    {
        return $this->lecture;
    }
}