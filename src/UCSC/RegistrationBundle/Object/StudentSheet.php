<?php

namespace UCSC\RegistrationBundle\Object;

use Doctrine\Common\Collections\ArrayCollection;


class StudentSheet{
 	
 	protected $students;
 	//protected $year;
 	//protected $course;
 	//protected $count;
 	
 	
 	public function __construct()
 	{
 		$this->students = new ArrayCollection();		
 		
 	}
 	public function getStudents()
 	{
 		return $this->students;
 	}
 	
    public function addStudent(\UCSC\DatabaseBundle\Entity\Student $students)
    {
        $this->students[] = $students;
    }
    
    
  
 	
 }