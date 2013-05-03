<?php

namespace UCSC\TimeTableBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;

use UCSC\DatabaseBundle\Entity\AyearCourse;

use Symfony\Component\Config\Definition\Exception\Exception;

use UCSC\DatabaseBundle\Entity\LectureHall;

use UCSC\DatabaseBundle\Entity\TimeSlot;

use UCSC\DatabaseBundle\Form\Type\TimeTableType;
use UCSC\DatabaseBundle\Form\Type\TimeTable1Type;
use UCSC\DatabaseBundle\Form\Type\ViewTimeTableType;

use UCSC\DatabaseBundle\Entity\TimeTable;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

class TimeTableController extends Controller
{

	public function timetableAction(Request $request = null , $type)
	{
		$form = $this->createFormBuilder()
		->add('academicYear', 'entity', array('class' => 'UCSCDatabaseBundle:AcademicYear'))
		->add('degree', 'entity', array('class' => 'UCSCDatabaseBundle:Degree'))
		->add('year', 'entity', array('class' => 'UCSCDatabaseBundle:Year'))
    	->add('sem', 'entity', array('class' => 'UCSCDatabaseBundle:Semester'))    	
    	->getForm();
	
		if ($request && $request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
			
			$data = $form->getData();
			
			/*
			$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Course');
			$courses = $repository->findBy(array('year' => $data['year'],'sem' => $data['semester'],'degree' => $data['degree']));
				
			foreach ($courses as $course){
			
				$cid=$course->getCourseID();
				$c[$cid]=$cid;
			}
			*/
			$data = array('academicYear'=> $data['academicYear']->getAyearID(), 'degree' => $data['degree']->getDegreeID(), 'year' => $data['year']->getYearID(), 'sem' => $data['sem']->getSemID());
			
			
			$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:TimeTable');
			$table = $repository->findOneBy($data);
			
			//unset($data['academicYear']);
			
			if($type == 'update') {
				
				$form1 = $this->createForm(new TimeTableType($data), $table);
		
				return $this->render('UCSCTimeTableBundle:Default:enter_timetable.html.twig',array('form' => $form->createView(),
						'form1' => $form1->createView(),'method'=>'post','type'=>$type,'degree' => $data['degree'], 'year' => $data['year'], 'sem' => $data['sem'],'aid'=>$data['academicYear']));
			}
			
			else {
				
				if ($table == NULL ){
					$timetable = new TimeTable();
					
					for($i=0;$i<50;$i++){
						$tslot = new TimeSlot();
						$tslot->setSlotID($i);
						$timetable->getSlots()->add($tslot);
					
					}
					//throw $this->createNotFoundException($data['year']);
					
					$form1 = $this->createForm(new TimeTableType($data), $timetable);
					
					return $this->render('UCSCTimeTableBundle:Default:enter_timetable.html.twig', array('form' => $form->createView(),
							'form1' => $form1->createView(), 'method'=>'post','type'=>$type,'degree' => $data['degree'], 'year' => $data['year'], 'sem' => $data['sem'],'aid'=>$data['academicYear']));
					
					
				}
				else{
					
					throw $this->createNotFoundException('Already Exisists');
				}
			}
	
		}
		
		return $this->render('UCSCTimeTableBundle:Default:enter_timetable.html.twig', array('form' => $form->createView(), 'method'=>'get','type'=>$type));
	}
	
	
	public function submittableAction(Request $request,$type,$degree,$year,$sem,$aid)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:AcademicYear');
		$ayear = $repository->find($aid);
		//$ayear = end($ayears);
		$data = array('degree'=>$degree,'year'=>$year,'sem'=>$sem,'academicYear'=>$ayear->getAyearID());
		//throw new Exception(print_r($data,true));
		if($type == 'update') {
			
			$repository = $em->getRepository('UCSCDatabaseBundle:TimeTable');
			$table = $repository->findOneBy(array('year' => $year,'sem' => $sem,'degree' => $degree,'academicYear'=>$ayear->getAyearID()));
			//throw $this->createNotFoundException(print_r($table,true));
			
			$form = $this->createForm(new TimeTable1Type(), $table);
			if ($request->getMethod() == 'POST') {
				$form->bindRequest($request);
			
				if($form->isValid()) {
					
					$em->flush();
				}
				else {
					throw $this->createNotFoundException("form is not valid");
				}
			
			
			
			}
		}
		else {
			
			$timetable = new TimeTable();
			$em = $this->getDoctrine()->getEntityManager();
					$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Year');
					$year = $repository->findOneByYearID($year);
					$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Semester');
					$sem = $repository->findOneBySemID($sem);
					$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Degree');
					$degree = $repository->findOneByDegreeID($degree);
					
					$timetable->setYear($year);
					$timetable->setSem($sem);
					$timetable->setDegree($degree);					
					$timetable->setAcademicYear($ayear);
					$em->persist($timetable);
					$em->flush();
			for($i=0;$i<50;$i++){
				$tslot[$i] = new TimeSlot();				
				$tslot[$i]->setSlotID($i);
				$tslot[$i]->setTimetable($timetable);				
				$timetable->getSlots()->add($tslot[$i]);
			
			}
			
			
			$form = $this->createForm(new TimeTable1Type(), $timetable);
			
			if ($request->getMethod() == 'POST') {
				$form->bindRequest($request);
				if($form->isValid()) {
					/*
					for($i=0;$i<50;$i++) {
						if($tslot[$i]->getAyearcourse()==null){
						$timetable->getSlots()->removeElement($tslot[$i]);
						}
					}
					*/							
					$em->flush();
				}
				else {
					throw $this->createNotFoundException("form is not valid");
				}
			
			
			
			}
		}
		
		return $this->redirect($this->generateUrl('homepage'));
    
	}
	
	public function view_timetableAction(Request $request)
	{
		$form = $this->createFormBuilder()
		->add('academicYear', 'entity', array('class' => 'UCSCDatabaseBundle:AcademicYear'))
		->add('degree', 'entity', array('class' => 'UCSCDatabaseBundle:Degree'))
		->add('year', 'entity', array('class' => 'UCSCDatabaseBundle:Year'))
    	->add('sem', 'entity', array('class' => 'UCSCDatabaseBundle:Semester'))    	
    	->getForm();
	
		if ($request && $request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
	
			$data = $form->getData();
	
			
			$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:TimeTable');
			$table = $repository->findOneBy(array('year' => $data['year']->getYearID(),'sem' => $data['sem']->getSemID(),'degree' => $data['degree']->getDegreeID(),'academicYear'=>$data['academicYear']->getAyearID()));
			//throw $this->createNotFoundException($table->getTableID());
			
			//$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:AyearCourse');
			
			$tmp = $table->getSlots();
			$slot = $tmp->first();
			while($slot != null) {
				$course = $slot->getAyearCourse();
				$lect[$slot->getSlotID()] = "";
				if($course) {
					$lcts = $course->getLecayearcourses();
					
					foreach($lcts as $lec){
						$lect[$slot->getSlotID()] .= $lec->getLecture()->getLectureID()." ";					
					}
				}
				
				$slot = $tmp->next();
				
			}
			//$form1 = $this->createForm(new ViewTimeTableType(),$table);
	
			return $this->render('UCSCTimeTableBundle:Default:view_timetable.html.twig',array('form' => $form->createView(),
						'table' => $table,'method'=>'post','lec'=>$lect));
		}
	
		return $this->render('UCSCTimeTableBundle:Default:view_timetable.html.twig', array('form' => $form->createView(), 'method'=>'get'));
	}
	
	
}