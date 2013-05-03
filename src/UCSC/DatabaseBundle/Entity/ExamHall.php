<?php

namespace UCSC\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * UCSC\DatabaseBundle\Entity\ExamHall
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ExamHall
{
    /**
     * @var string $hallId
     *
     * @ORM\Column(name="HallId", type="string", length=8)
     * @ORM\Id
     */
    private $hallId;



    /**
     * Set hallId
     *
     * @param string $hallId
     */
    public function setHallId($hallId)
    {
        $this->hallId = $hallId;
    }

    /**
     * Get hallId
     *
     * @return string 
     */
    public function getHallId()
    {
        return $this->hallId;
    }
}