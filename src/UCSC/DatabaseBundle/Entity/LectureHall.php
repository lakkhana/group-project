<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\LectureHall
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class LectureHall
{
	/**
	 * @var string $hallID
	 *
	 * @ORM\Column(name="hallID", type="string", length=16)
	 * @ORM\Id
	 */
	private $hallID;
	
	/**
	 * @ORM\OneToMany(targetEntity="TimeSlot", mappedBy="hall")
	 */
	protected $slots;
	
	public function __construct()
	{
		$this->slots = new ArrayCollection();
	}
	
	public function __toString()
	{
		return $this->getHallID();
	}

    /**
     * Set hallID
     *
     * @param string $hallID
     */
    public function setHallID($hallID)
    {
        $this->hallID = $hallID;
    }

    /**
     * Get hallID
     *
     * @return string 
     */
    public function getHallID()
    {
        return $this->hallID;
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