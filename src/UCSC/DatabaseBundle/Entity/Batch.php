<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UCSC\DatabaseBundle\Entity\Batch
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Batch
{

    /**
     * @var integer $batchID
     *
     * @ORM\Column(name="batchID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $batchID;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="batch")
     */
    protected $students;
    
    public function __construct()
    {
    	$this->students = new ArrayCollection();
    }

    public function __toString()
    {
    	return $this->getName();
    }
    
    /**
     * Get batchID
     *
     * @return integer 
     */
    public function getBatchID()
    {
        return $this->batchID;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add students
     *
     * @param UCSC\DatabaseBundle\Entity\Student $students
     */
    public function addStudent(\UCSC\DatabaseBundle\Entity\Student $students)
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