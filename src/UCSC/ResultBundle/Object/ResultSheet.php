<?php

namespace UCSC\ResultBundle\Object;

use Doctrine\Common\Collections\ArrayCollection;


class ResultSheet{
 	
 	protected $results;
 	protected $year;
 	protected $course;
 	protected $count;
 	
 	
 	public function __construct()
 	{
 		$this->results = new ArrayCollection();		
 		
 	}
 	
 	public function getResults()
 	{
 		return $this->results;
 	}
 	
    public function addResult(\UCSC\DatabaseBundle\Entity\Result $results)
    {
        $this->results[] = $results;
    }
 	
 	public function getYear()
 	{
 		return $this->year;
 	}
 	
 	
 	public function getCourse()
 	{
 		return $this->course;
 	}
 	
 	public function getCount()
 	{
 		return $this->count;
 	}
 	
 	public function setYear($year)
 	{
 		$this->year=$year;
 	}
 	
 	
 	public function setCourse($course)
 	{
 		$this->course=$course;
 	}	
 	
 	public function setCount($count)
 	{
 		$this->count=$count;
 	}
 	
 }