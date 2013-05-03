<?php

namespace UCSC\ResultBundle\Object;

use Doctrine\Common\Collections\ArrayCollection;


class SelectionList{
 	
 	protected $courses;
 	protected $student;
 	
 	
 	public function __construct()
 	{
 		$this->courses = new ArrayCollection();		
 		
 	}
 	public function getCourses()
 	{
 		return $this->courses;
 	}
 	
    public function addCourse(CourseItem $course)
    {
        $this->courses[] = $course;
    }	
	
    public function getStudent()
    {
    	return $this->student;
    }
    
    public function setStudent($std)
    {
    	$this->student = $std;
    }
 	
 }