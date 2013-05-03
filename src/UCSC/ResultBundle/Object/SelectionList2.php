<?php

namespace UCSC\ResultBundle\Object;

use Doctrine\Common\Collections\ArrayCollection;


class SelectionList2{
 	
 	protected $courses;
 	
 	
 	public function __construct()
 	{
 		$this->courses = new ArrayCollection();		
 		
 	}
 	public function getCourses()
 	{
 		return $this->courses;
 	}
 	
    public function addCourse(CourseItem2 $course)
    {
        $this->courses[] = $course;
    }
 	
 }