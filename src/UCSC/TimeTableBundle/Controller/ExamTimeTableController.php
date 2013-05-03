<?php

namespace UCSC\TimeTableBundle\Controller;

use UCSC\DatabaseBundle\Entity\ExamHall;

use UCSC\DatabaseBundle\Entity\Course;

use UCSC\DatabaseBundle\Entity\ExamTimeTable;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

class ExamTimeTableController extends Controller
{
	
	public function selectsemesterAction(Request $request)
	{
		$form = $this->createFormBuilder()
		->add('semester', 'choice', array('choices' => array('1' => '1', '2' => '2'),'multiple'  => false,'expanded'=>true))
		->getForm();
	
		if ($request && $request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
	
			$data = $form->getData();
	
			$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Course');
			$courses = $repository->findBy(array('sem' => $data['semester']));
	
			foreach ($courses as $course){
	
				$cid=$course->getCourseID();
				$c[$cid]=$cid;
			}
	
			$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:ExamHall');
			$halls = $repository->findAll();
	
			foreach($halls as $hall) {
	
				$hid=$hall->getHallId();
				$h[$hid]=$hid;
	
			}
	
			if($type == 'update') {
	
	
				$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:ExamTimeTable');
				$table = $repository->findOneBy(array('sem' => $data['semester']));
	
				$form1 = $this->createForm(new TimeTableType($c,$h), $table);
	
				return $this->render('UCSCTimeTableBundle:ExamTimeTable:update_examtimetable.html.twig',array('form' => $form->createView(),
						'form1' => $form1->createView(),'method'=>'post','type'=>$type,'degree' => $data['degree'], 'sem' => $data['semester']));
			}
	
			else {
	
				$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:ExamTimeTable');
				$table = $repository->findBy(array('sem' => $data['semester']));
	
				if ($table == NULL ){
					$timetable = new TimeTable();
	
					
	
					}
	
					$timetable->setSem($data['semester']);
					$timetable->setDegree($data['degree']);
	
					$form1 = $this->createForm(new TimeTableType($c,$h), $timetable);
	
					return $this->render('UCSCTimeTableBundle:ExamTimeTable:enter_examtimetable.html.twig', array('form' => $form->createView(),
							'form1' => $form1->createView(), 'method'=>'post','type'=>$type,'degree' => $data['degree'], 'sem' => $data['semester']));
	
	
				}
				else{
	
					return new Response('<b><i><font size="5" face="arial" color="green">The student registation is valid! </font></b></i>');
	
				}
			}
	
		}
	
		return $this->render('UCSCTimeTableBundle:ExamTimeTable:enter_examtimetable.html.twig', array('form' => $form->createView(), 'method'=>'get','type'=>$type));
	}
	
	public function submittableAction(Request $request,$type,$degree,$sem)
	{
		if($type == 'update') {
			$em = $this->getDoctrine()->getEntityManager();
			$repository = $em->getRepository('UCSCDatabaseBundle:TimeTable');
			$table = $repository->findOneBy(array('sem' => $sem,'degree' => $degree));
			//throw $this->createNotFoundException($sem);
			$form = $this->createForm(new TimeTableType(array(),array()), $table);
	
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
	
			for($i=0;$i<10;$i++){
				$tslot[$i] = new TimeSlot();
				$tslot[$i]->setPeriod($i);
				$timetable->getSlots()->add($tslot[$i]);
	
			}
	
	
			$form = $this->createForm(new TimeTableType(array(),array()), $timetable);
	
			if ($request->getMethod() == 'POST') {
				$form->bindRequest($request);
	
				if($form->isValid()) {
	
					$em = $this->getDoctrine()->getEntityManager();
					$em->persist($timetable);
	
					for($i=0;$i<10;$i++) {
						$tslot[$i]->setTimetable($timetable);
						$em->persist($tslot[$i]);
					}
	
					$em->flush();
				}
				else {
					throw $this->createNotFoundException("form is not valid");
				}
	
	
	
			}
		}
	
		return $this->redirect($this->generateUrl('homepage'));
	
	}
	
	
}