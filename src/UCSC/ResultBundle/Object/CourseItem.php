<?php

namespace UCSC\ResultBundle\Object;

use Doctrine\ORM\Mapping as ORM;

class CourseItem{
 	
 	
 	protected $selected;
 	protected $ayearCourse;
 	protected $courseid;
 	protected $coursename;
 	

 	public function setAyearCourse($course)
 	{
 		$this->ayearCourse = $course;
 	}
 	
 	
 	public function getAyearCourse()
 	{
 		return $this->ayearCourse;
 	}
 	
    public function setCourseid($course)
    {
        $this->courseid = $course;
    }


    public function getCourseid()
    {
        return $this->courseid;
    }
    
    public function setCoursename($course)
    {
    	$this->coursename = $course;
    }
    
    
    public function getCoursename()
    {
    	return $this->coursename;
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