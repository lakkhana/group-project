<?php

namespace UCSC\ResultBundle\Controller;


use UCSC\DatabaseBundle\Entity\Lecture;

use UCSC\DatabaseBundle\Entity\LectureAyearCourse;

use UCSC\DatabaseBundle\Entity\AcademicYear;

use Symfony\Component\Config\Definition\Exception\Exception;

use UCSC\DatabaseBundle\Entity\Result;

use UCSC\DatabaseBundle\Entity\AyearCourse;

use UCSC\DatabaseBundle\Form\Type\SelectionListType;

use UCSC\ResultBundle\Object\CourseItem;

use UCSC\ResultBundle\Object\SelectionList;

use UCSC\DatabaseBundle\Form\Type\SelectionList2Type;

use UCSC\ResultBundle\Object\CourseItem2;

use UCSC\ResultBundle\Object\SelectionList2;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SelectionController extends Controller
{	
	
	public function newAcademicYearAction(Request $request = null)
	{
	
		$form = $this->createFormBuilder()
		->add('academicYear', 'text',array('label'=>'Academic Year'))
		->getForm();
		
		if ($request->getMethod() == 'POST') {
			
		
			$form->bindRequest($request);
			
			if($form->isValid()){
				$data = $form->getData();
				$em = $this->getDoctrine()->getEntityManager();
				$repository = $em->getRepository('UCSCDatabaseBundle:AcademicYear');
				$ayear = $repository->findBy($data);
				
				if($ayear) {
					$this->get('session')->setFlash('error', 'Registration Faild. Already Exists!');
					
				}
				else {
					$academicYear = new AcademicYear();
					$academicYear->setAcademicYear($data['academicYear']);
					$em->persist($academicYear);
					$em->flush();
					$this->get('session')->setFlash('notice', 'New Academic Year Registerd Successfully!');
					
				}
				return $this->redirect($this->generateUrl('homepage'));
				
			}
			else {
				throw new Exception("form not valid!");
			}
			
		}
		else {
			return $this->render('UCSCResultBundle:Selection:new_acyear.html.twig', array('form' => $form->createView()));
		}
		
		
	}	
	
	public function addCoursesFormAction()
	{
	
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('UCSCDatabaseBundle:Course');
		$courses = $repository->findAll();
		$sheet=new SelectionList2();
		$a=0;
		foreach($courses as $course){
			$c = new CourseItem2();
			$c->setCourseID($course->getCourseID());
			//throw $this->createNotFoundException($c->getAyearCourse());
			$c->setCourseName($course->getName());
			$sheet->addCourse($c);
			$a++;
		}
		//throw $this->createNotFoundException($sheet->getResults()->count());
		$form = $this->createForm(new SelectionList2Type(),$sheet);
		return $this->render('UCSCResultBundle:Selection:selectlist2.html.twig',
				array('form' => $form->createView(),'count' => $a));
	
	}
	
	public function addCoursesAction(Request $request,$count)
	{
	
		if ($request->getMethod() == 'POST') {
	
			$sheet=new SelectionList2();
			for($a=0;$a<$count;$a++){
				$c = new CourseItem2();
				$sheet->addCourse($c);
	
			}
	
			$form = $this->createForm(new SelectionList2Type(),$sheet);
	
			
			
			$form->bindRequest($request);
			//throw $this->createNotFoundException($count);
			//	throw $this->createNotFoundException($form->bindRequest($request));
			if($form->isValid()){
	
				$em = $this->getDoctrine()->getEntityManager();
				//$repository = $em->getRepository('UCSCDatabaseBundle:Result');
	
				$repository = $em->getRepository('UCSCDatabaseBundle:AcademicYear');
				$ayears = $repository->findAll();
				//throw $this->createNotFoundException(end($ayears));
				$ayear = end($ayears);
				$item = $sheet->getCourses()->first();
	
	
				for($b=0;$b<$count;$b++){
	
					if($item->getSelected()) {
	
						$query = $em->createQuery(
								'SELECT ac FROM UCSCDatabaseBundle:AyearCourse ac
								JOIN ac.academicYear ay
								JOIN ac.course c
								WHERE ay.ayearID=:aid
								AND c.courseID=:cid'
						)->setParameters(array('aid' => $ayear->getAyearID(),'cid'=> $item->getCourseID()));
						$ayc = $query->getResult();
	
						if($ayc) {
	
							$item = $sheet->getCourses()->next();
							continue;
						}
						else {
	
							//$repository = $em->getRepository('UCSCDatabaseBundle:Student');
							//$student = $repository->find($sheet->getStudent());
							$repository = $em->getRepository('UCSCDatabaseBundle:Course');
							$course = $repository->find($item->getCourseID());
							//throw $this->createNotFoundException($course);
							$ayearcourse = new AyearCourse();
							$ayearcourse->setAcademicYear($ayear);
							$ayearcourse->setCourse($course);
							$em = $this->getDoctrine()->getEntityManager();
							$em->persist($ayearcourse);
							$em->flush();
							/*
							
							$repository = $em->getRepository('UCSCDatabaseBundle:Lecture');
							$lecture = $repository->find($item->getLecture()); 
							$lecayear = new LectureAyearCourse();
							$lecayear->setLecture($lecture);
							$lecayear->setAyearcourse($ayearcourse);
							*/
	
							$item = $sheet->getCourses()->next();
	
						}
					}
	
					else {
						$item = $sheet->getCourses()->next();
					}
	
				}
	
				$em->flush();
	
	
				return $this->redirect($this->generateUrl('maintab',array('tab'=>'exam')));
			}
		}
	
	}
	
	
	
	public function opCourseAction()
	{
		return $this->render('UCSCResultBundle:Selection:opcourse.html.twig');
	}
	public function opCourseFormAction($sid,$year,$did,$aid)
	{
		
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
				'SELECT ac FROM UCSCDatabaseBundle:AyearCourse ac
				JOIN ac.academicYear ay
				JOIN ac.course cou
				JOIN cou.degree d
				WHERE cou.year=:year
				AND d.degreeID=:did
				AND ay.ayearID=:aid'
		)->setParameters(array('year'=>$year, 'did'=>$did, 'aid'=>$aid));
		
		$courses = $query->getResult();
		$sheet=new SelectionList();
		$a=0;
		foreach($courses as $course){
			$c = new CourseItem();
			$c->setAyearCourse($course->getAcid());
			//throw $this->createNotFoundException($c->getAyearCourse());
			
			$c->setCourseid($course->getCourse()->getCourseID());
			$c->setCoursename($course->getCourse()->getName());
			$sheet->addCourse($c);
			$sheet->setStudent($sid);
			$a++;
		}
		//throw $this->createNotFoundException($sheet->getResults()->count());
		$form = $this->createForm(new SelectionListType(),$sheet);
		return $this->render('UCSCResultBundle:Selection:selectlist.html.twig',
				array('form' => $form->createView(),'count' => $a, 'sid' => $sid));
		
	}
	
	public function opCourseSelectAction(Request $request,$count)
	{
				
		if ($request->getMethod() == 'POST') {			
			
			$sheet=new SelectionList();
			for($a=0;$a<$count;$a++){
				$c = new CourseItem();
				$sheet->addCourse($c);
				
			}
			
			$form = $this->createForm(new SelectionListType(),$sheet);
		
			$form->bindRequest($request);
			//throw $this->createNotFoundException($count);
		//	throw $this->createNotFoundException($form->bindRequest($request));
			if($form->isValid()){
				
				$em = $this->getDoctrine()->getEntityManager();
				//$repository = $em->getRepository('UCSCDatabaseBundle:Result');
				
				$item = $sheet->getCourses()->first();
				
					
				for($b=0;$b<$count;$b++){

					if($item->getSelected()) {
					
						$query = $em->createQuery(
								'SELECT r FROM UCSCDatabaseBundle:Result r
								JOIN r.ayearcourse ayc
								JOIN r.student st 
								WHERE ayc.acid=:acid
								AND st.regNo=:std'
						)->setParameters(array('acid' => $item->getAyearCourse(),'std'=> $sheet->getStudent()));
						$results = $query->getResult();
						
						if($results) {
							
							$item = $sheet->getCourses()->next();
							continue;
						}
						else {
						
							$repository = $em->getRepository('UCSCDatabaseBundle:Student');
							$student = $repository->find($sheet->getStudent());
							$repository = $em->getRepository('UCSCDatabaseBundle:AyearCourse');
							$ayearcourse = $repository->find($item->getAyearCourse());
							
							$result = new Result();
							$result->setStudent($student);
							$result->setAyearcourse($ayearcourse);
							$em = $this->getDoctrine()->getEntityManager();
						    $em->persist($result);
						    
							$item = $sheet->getCourses()->next();
							
						}
					}
					
					else {
						$item = $sheet->getCourses()->next();
					}
					
				}
				
				$em->flush();
			
			
				return $this->redirect($this->generateUrl('homepage'));
			}
		}
	
	}
	
	public function studentListAction()
	{
		
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('UCSCDatabaseBundle:Degree');
		$degrees = $repository->findAll();
		$data = array();
		foreach($degrees as $degree) {
			
			for($i=3;$i<=4;$i++) {
				
				$query = $em->createQuery(
				'SELECT s.regNo, s.name FROM UCSCDatabaseBundle:Student s
				JOIN s.year y
				JOIN s.degree d
				WHERE y.yearID=:year
				AND d.degreeID=:degree'
				)->setParameters(array('year'=>$i,'degree'=>$degree));
				$stds = $query->getResult();
				$ydata[$i]= $stds;
			}
			$data[$degree->getDegreeID()] = $ydata;
			//throw $this->createNotFoundException("test");
			$repository = $em->getRepository('UCSCDatabaseBundle:AcademicYear');
			$ayears = $repository->findAll();
			$ayear = end($ayears);
		
		}
		return $this->render('UCSCResultBundle:Selection:studentList.html.twig',array('data' => $data,'aid'=>$ayear->getAyearID()));
	}
}