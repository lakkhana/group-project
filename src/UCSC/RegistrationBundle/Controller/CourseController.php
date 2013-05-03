<?php

namespace UCSC\RegistrationBundle\Controller;

use UCSC\DatabaseBundle\Entity\Course;
use UCSC\DatabaseBundle\Entity\Year;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Validator\Constraints\Null;

use Symfony\Component\HttpFoundation\Request;

use UCSC\DatabaseBundle\Form\Type\CourseType;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CourseController extends Controller
{
	
	public function registerformAction()
    {
		$course = new Course();
		$form = $this->createForm(new CourseType(), $course);
		
		return $this->render('UCSCRegistrationBundle:Default:courseform.html.twig', array(
				'form' => $form->createView(),
		));
    }
	
	public function registerAction(Request $request)
    {
    	$course = new Course();
    	$form = $this->createForm(new CourseType(), $course);
    
    	if ($request->getMethod() == 'POST') {
    	
    		$form->bindRequest($request);
    	
    		if ($form->isValid()) {
			
				$em = $this->getDoctrine()->getEntityManager();
    			$em->persist($course);
    			$em->flush();
    		}
    	}
    	
    	
    	$validator = $this->get('validator');
    	$errors = $validator->validate($course);
    	
    	if (count($errors) > 0) {
    		return new Response(print_r($errors, true));
    	} else {
    		$this->get('session')->setFlash('notice', 'Course registerd successfully!');
    	}
    	
    	
    	
    	
    	return $this->redirect($this->generateUrl('course_form'));
    }
    
    
    /*************************** COURSE **************************************/
    
    
    
    public function updateselectAction()
    {
    	
    	$form = $this->createFormBuilder()
    			->add('course', 'entity', array('class' => 'UCSCDatabaseBundle:Course'))
    			->getForm();

    	
    	// meke html twic 1 hadanna
    	return $this->render('UCSCRegistrationBundle:Default:update_course.html.twig', array(
    			'form' => $form->createView()));
    
    
    }
    
    /*****************************************************************/
    
    public function updateformAction($cid)
    {
    	$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Course');
    	$course = $repository->find($cid);
    
    	$form = $this->createForm(new CourseType('hidden'), $course);
    
    		return $this->render('UCSCRegistrationBundle:Default:update_viwe_course.html.twig', array(
    				'form' => $form->createView(),'cid' => $course->getCourseID()));

    }
    
    /*****************************************************************/
    
    public function updateAction(Request $request)
    {
    
    	if ($request->getMethod() == 'POST') {
    
    		$course = new Course();
    		$form = $this->createForm(new CourseType('hidden'), $course);
    		$form->bindRequest($request);
    
    		if($form->isValid()) {
    			$em = $this->getDoctrine()->getEntityManager();
    			$repository = $em->getRepository('UCSCDatabaseBundle:Course');
    			$coursenew = $repository->find($course->getCourseID());
    			
  
    
    			$coursenew->setName($course->getName());
    			$coursenew->setCredit($course->getCredit());
    			
    
    			$validator = $this->get('validator');
    			$errors = $validator->validate($course);
    			
    			
    			if (count($errors) > 0) {
    				//	$errors ='<b><i><font size="5" face="arial" color="red"> error@ Registation no->invalid Value! eg:2009cs012 or 2009ict231 </font></b></i>';
    				return new Response(print_r($errors, true));
    			} else {
    				$this->get('session')->setFlash('notice', 'Course details updated successfully!');
    			}
    			
    			$em->flush();
				return $this->redirect($this->generateUrl('view3'));
    
    		}
    
    
    	}
    
    
    }
    

    
    /************************  view Course **************************************/
    
    
    
    public function viewformAction()
    {
    	
    	$form = $this->createFormBuilder()
    			->add('degree', 'entity', array('class' => 'UCSCDatabaseBundle:Degree','required'=>false,'empty_value'=>'Any'))
    			->add('year', 'entity', array('class' => 'UCSCDatabaseBundle:Year','required'=>false,'empty_value'=>'Any'))
    			->add('sem', 'entity', array('label'=>'Semester', 'class' => 'UCSCDatabaseBundle:Semester','required'=>false,'empty_value'=>'Any'))
    			->getForm();
    
    	return $this->render('UCSCRegistrationBundle:Default:viewcourse.html.twig', array(
    			'form' => $form->createView()));
    
    
    }
    
    
    
    
    
    public function viewAction(Request $request)
    {
    	$form = $this->createFormBuilder()
    			->add('degree', 'entity', array('class' => 'UCSCDatabaseBundle:Degree','required'=>false))
    			->add('year', 'entity', array('class' => 'UCSCDatabaseBundle:Year','required'=>false))
    			->add('sem', 'entity', array('label'=>'Semester', 'class' => 'UCSCDatabaseBundle:Semester','required'=>false))
    			->getForm();
    
    	if($request->getMethod()=='POST') {
    		$form->bindRequest($request);
    		if($form->isValid()) {
    			$data = $form->getData();
    			if($data['degree'] == null)
    				unset($data['degree']);
    			if($data['year'] == null)
    				unset($data['year']);
    			if($data['sem'] == null)
    				unset($data['sem']);    			

    			$em = $this->getDoctrine()->getEntityManager();
    			$repository = $em->getRepository('UCSCDatabaseBundle:Course');
    			$courses = $repository->findBy($data);
    
    			return $this->render('UCSCRegistrationBundle:Default:view3.html.twig', array('courses' => $courses));
    
    		}
    
    		else {
    			throw $this->createNotFoundException('form invalid');
    		}
    	}
    
    }

    
		
}
