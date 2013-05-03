<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UCSC\DatabaseBundle\Entity\BursaryPayment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BursaryPayment
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
     * @var smallint $year
     *
     * @ORM\Column(name="year", type="smallint")
     */
    private $year;

    /**
     * @var string $month
     *
     * @ORM\Column(name="month", type="string", length=16)
     */
    private $month;

    /**
     * @ORM\ManyToOne(targetEntity="Bursary", inversedBy="payments")
     * @ORM\JoinColumn(name="studentID", referencedColumnName="studentID")
     */
    protected $student;
    

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
     * Set year
     *
     * @param smallint $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * Get year
     *
     * @return smallint 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set month
     *
     * @param string $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * Get month
     *
     * @return string 
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set student
     *
     * @param UCSC\DatabaseBundle\Entity\Bursary $student
     */
    public function setStudent(\UCSC\DatabaseBundle\Entity\Bursary $student)
    {
        $this->student = $student;
    }

    /**
     * Get student
     *
     * @return UCSC\DatabaseBundle\Entity\Bursary 
     */
    public function getStudent()
    {
        return $this->student;
    }
}