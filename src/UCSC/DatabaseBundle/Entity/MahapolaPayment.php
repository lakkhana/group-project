<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\MahapolaPayment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MahapolaPayment
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
     * @ORM\ManyToOne(targetEntity="Mahapola", inversedBy="payments")
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
     * @param UCSC\DatabaseBundle\Entity\Mahapola $student
     */
    public function setStudent(\UCSC\DatabaseBundle\Entity\Mahapola $student)
    {
        $this->student = $student;
    }

    /**
     * Get student
     *
     * @return UCSC\DatabaseBundle\Entity\Mahapola 
     */
    public function getStudent()
    {
        return $this->student;
    }
}