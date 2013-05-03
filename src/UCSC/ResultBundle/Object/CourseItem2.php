<?php

namespace UCSC\ResultBundle\Object;

use Doctrine\ORM\Mapping as ORM;

class CourseItem2{
 	
 	
 	protected $selected;
 	protected $courseID;
 	protected $courseName;
 	protected $lecture;
 	

 	public function setCourseID($course)
 	{
 		$this->courseID = $course;
 	}
 	
 	
 	public function getCourseID()
 	{
 		return $this->courseID;
 	}
 	
 	public function setLecture($lec)
 	{
 		$this->lecture = $lec;
 	}
 	
 	
 	public function getLecture()
 	{
 		return $this->lecture;
 	}
    
    public function setCourseName($course)
    {
    	$this->courseName = $course;
    }
    
    
    public function getCourseName()
    {
    	return $this->courseName;
    }
    
    public function setSelected($selected)
    {
    	$this->selected = $selected;
    }
    
    public function getSelected()
    {
    	return $this->selected;
    }
	
 	
 }