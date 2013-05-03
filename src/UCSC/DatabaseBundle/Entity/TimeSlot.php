<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\TimeSlot
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TimeSlot
{
    /**
     * @var integer $slotID
     *
     * @ORM\Column(name="slotID", type="smallint")
     * @ORM\Id
     */
    private $slotID;

    /**
     * @ORM\ManyToOne(targetEntity="AyearCourse", inversedBy="slots")
     * @ORM\JoinColumn(name="acid", referencedColumnName="acid")
     */
    private $ayearcourse;
    
    /**
     * @ORM\ManyToOne(targetEntity="SlotType", inversedBy="slots")
     * @ORM\JoinColumn(name="typeID", referencedColumnName="typeID")
     */
    private $type;

    /**
     * @var string $hall
     * @ORM\ManyToOne(targetEntity="LectureHall", inversedBy="slots")
     * @ORM\JoinColumn(name="hallID", referencedColumnName="hallID")
     */
    private $hall;

    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="TimeTable", inversedBy="slots")
     * @ORM\JoinColumn(name="tableID", referencedColumnName="tableID")
     * 
     */
    private $timetable;
    

    public function __toString()
    {
    	return (string)$this->getSlotID();
    }

    /**
     * Set slotID
     *
     * @param smallint $slotID
     */
    public function setSlotID($slotID)
    {
        $this->slotID = $slotID;
    }

    /**
     * Get slotID
     *
     * @return smallint 
     */
    public function getSlotID()
    {
        return $this->slotID;
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

    /**
     * Set type
     *
     * @param UCSC\DatabaseBundle\Entity\SlotType $type
     */
    public function setType(\UCSC\DatabaseBundle\Entity\SlotType $type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return UCSC\DatabaseBundle\Entity\SlotType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set hall
     *
     * @param UCSC\DatabaseBundle\Entity\LectureHall $hall
     */
    public function setHall(\UCSC\DatabaseBundle\Entity\LectureHall $hall)
    {
        $this->hall = $hall;
    }

    /**
     * Get hall
     *
     * @return UCSC\DatabaseBundle\Entity\LectureHall 
     */
    public function getHall()
    {
        return $this->hall;
    }

    /**
     * Set timetable
     *
     * @param UCSC\DatabaseBundle\Entity\TimeTable $timetable
     */
    public function setTimetable(\UCSC\DatabaseBundle\Entity\TimeTable $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Get timetable
     *
     * @return UCSC\DatabaseBundle\Entity\TimeTable 
     */
    public function getTimetable()
    {
        return $this->timetable;
    }
}