<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\Mahapola
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Mahapola
{
    /**
     * 
     * @ORM\OneToOne(targetEntity="Student", inversedBy="mahapola")
     * @ORM\JoinColumn(name="studentID", referencedColumnName="regNo")
	 * @ORM\Id
     */
    private $student;
    
    /**
     * @ORM\ManyToOne(targetEntity="MahapolaType", inversedBy="students")
     * @ORM\JoinColumn(name="type", referencedColumnName="type")
     */
    protected $type;
    
    /**
     * @var integer $total
     *
     * @ORM\Column(name="total", type="integer")
     */
    protected $total;
    
    /**
     * @ORM\OneToMany(targetEntity="MahapolaPayment", mappedBy="student")
     */
    protected $payments;
    
    public function __construct()
    {
    	$this->payments = new ArrayCollection();
    }
    

    /**
     * Set total
     *
     * @param integer $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Get total
     *
     * @return integer 
     */
    public function getTotal()
    {
        return $this->total;
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
     * Set type
     *
     * @param UCSC\DatabaseBundle\Entity\MahapolaType $type
     */
    public function setType(\UCSC\DatabaseBundle\Entity\MahapolaType $type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return UCSC\DatabaseBundle\Entity\MahapolaType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add payments
     *
     * @param UCSC\DatabaseBundle\Entity\MahapolaPayment $payments
     */
    public function addMahapolaPayment(\UCSC\DatabaseBundle\Entity\MahapolaPayment $payments)
    {
        $this->payments[] = $payments;
    }

    /**
     * Get payments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPayments()
    {
        return $this->payments;
    }
}