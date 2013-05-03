<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\ExamTimeTable
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ExamTimeTable
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
     * @var smallint $sem
     *
     * @ORM\Column(name="sem", type="smallint")
     */
    private $sem;

    /**
     * @var date $date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var time $startTime
     *
     * @ORM\Column(name="startTime", type="time")
     */
    private $startTime;

    /**
     * @var time $endTime
     *
     * @ORM\Column(name="endTime", type="time")
     */
    private $endTime;

    /**
     * @var string $courseId
     *
     * @ORM\Column(name="courseId", type="string", length=10)
     */
    private $courseId;

    /**
     * @var string $venue
     *
     * @ORM\Column(name="venue", type="string", length=16)
     */
    private $venue;


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
     * Set sem
     *
     * @param smallint $sem
     */
    public function setSem($sem)
    {
        $this->sem = $sem;
    }

    /**
     * Get sem
     *
     * @return smallint 
     */
    public function getSem()
    {
        return $this->sem;
    }

    /**
     * Set date
     *
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set startTime
     *
     * @param time $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * Get startTime
     *
     * @return time 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param time $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * Get endTime
     *
     * @return time 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set courseId
     *
     * @param string $courseId
     */
    public function setCourseId($courseId)
    {
        $this->courseId = $courseId;
    }

    /**
     * Get courseId
     *
     * @return string 
     */
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * Set venue
     *
     * @param string $venue
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;
    }

    /**
     * Get venue
     *
     * @return string 
     */
    public function getVenue()
    {
        return $this->venue;
    }
}