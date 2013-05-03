<?php

namespace UCSC\EventCalendarBundle\Object;



class Event{
 	
 	protected $title;
 	protected $startdate;
 	protected $enddate;
 	

 	public function getTitle()
 	{
 		return $this->title;
 	}
 	
 	public function setTitle($title)
 	{
 		$this->title=$title;
 	}
 	
 	public function getStartdate()
 	{
 		return $this->startdate;
 	}
 	
 	public function setStartdate($sd)
 	{
 		$this->startdate=$sd;
 	}
 	
	public function getEnddate()
 	{
 		return $this->enddate;
 	}
 	
 	public function setEnddate($ed)
 	{
 		$this->enddate=$ed;
 	}
 	
 	
 }