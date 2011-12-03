<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Group\TestBundle\Entity\Course
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Course
{
    /**
     * @var string $courseID
     * @ORM\Id
     * @ORM\Column(name="courseID", type="string", length=8)
     */
    private $courseID;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var smallint $credit
     *
     * @ORM\Column(name="credit", type="smallint")
     */
    private $credit;
    
    /**
     * @ORM\OneToMany(targetEntity="Result", mappedBy="courseID")
     */
    protected $results;

    public function __construct()
    {
        $this->results = new ArrayCollection();
    }

    /**
     * Set courseID
     *
     * @param string $courseID
     */
    public function setCourseID($courseID)
    {
        $this->courseID = $courseID;
    }

    /**
     * Get courseID
     *
     * @return string 
     */
    public function getCourseID()
    {
        return $this->courseID;
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
     * Set credit
     *
     * @param smallint $credit
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;
    }

    /**
     * Get credit
     *
     * @return smallint 
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Add results
     *
     * @param Group\TestBundle\Entity\Result $results
     */
    public function addResult(\Group\TestBundle\Entity\Result $results)
    {
        $this->results[] = $results;
    }

    /**
     * Get results
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getResults()
    {
        return $this->results;
    }
}