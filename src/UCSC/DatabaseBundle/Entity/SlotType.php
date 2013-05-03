<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\SlotType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SlotType
{
	/**
	 * @var string $typeID
	 *
	 * @ORM\Column(name="typeID", type="string", length=4)
	 * @ORM\Id
	 */
	private $typeID;
	
	/**
	 * @ORM\OneToMany(targetEntity="TimeSlot", mappedBy="type")
	 */
	protected $slots;
	
	public function __construct()
	{
		$this->slots = new ArrayCollection();
	}
	
	public function __toString()
	{
		return $this->getTypeID();
	}

    /**
     * Set typeID
     *
     * @param string $typeID
     */
    public function setTypeID($typeID)
    {
        $this->typeID = $typeID;
    }

    /**
     * Get typeID
     *
     * @return string 
     */
    public function getTypeID()
    {
        return $this->typeID;
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