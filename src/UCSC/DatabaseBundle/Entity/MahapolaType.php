<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\MahapolaType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MahapolaType
{
    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=32)
     * @ORM\Id
     */
    private $type;

    /**
     * @var integer $amount
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    /**
     * @ORM\OneToMany(targetEntity="Mahapola", mappedBy="type")
     */
    protected $students;
    
    public function __construct()
    {
    	$this->students = new ArrayCollection();
    }
    
    public function __toString()
    {
    	return $this->getType();
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Add students
     *
     * @param UCSC\DatabaseBundle\Entity\Mahapola $students
     */
    public function addMahapola(\UCSC\DatabaseBundle\Entity\Mahapola $students)
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
}