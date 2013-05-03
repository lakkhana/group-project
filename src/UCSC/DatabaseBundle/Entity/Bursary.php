<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\Bursary
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Bursary
{
    /**
     * 
     * @ORM\OneToOne(targetEntity="Student", inversedBy="bursary")
     * @ORM\JoinColumn(name="studentID", referencedColumnName="regNo")
	 * @ORM\Id
     */
    private $student;
    
    /**
     * @ORM\ManyToOne(targetEntity="BursaryType", inversedBy="students")
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
     * @ORM\OneToMany(targetEntity="BursaryPayment", mappedBy="student")
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
     * @param UCSC\DatabaseBundle\Entity\BursaryType $type
     */
    public function setType(\UCSC\DatabaseBundle\Entity\BursaryType $type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return UCSC\DatabaseBundle\Entity\BursaryType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add payments
     *
     * @param UCSC\DatabaseBundle\Entity\BursaryPayment $payments
     */
    public function addBursaryPayment(\UCSC\DatabaseBundle\Entity\BursaryPayment $payments)
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