<?php

namespace UCSC\RegistrationBundle\Controller;


use UCSC\DatabaseBundle\Entity\Lecture;
use UCSC\DatabaseBundle\Entity\LectureUser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Null;
use Symfony\Component\HttpFoundation\Request;
use UCSC\DatabaseBundle\Form\Type\LectureType;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LectureController extends Controller
{
    	
 
	public function registerformAction()
    {
		$lecture = new Lecture();
		$form = $this->createForm(new LectureType(), $lecture);
		
		return $this->render('UCSCRegistrationBundle:Default:lectureform.html.twig', array(
				'form' => $form->createView(),
		));
    }
	
	public function registerAction(Request $request)
    {
    	$lecture = new Lecture();
    	$form = $this->createForm(new LectureType(), $lecture);
    
    	if ($request->getMethod() == 'POST') {
    	
    		$form->bindRequest($request);
    	
    		if ($form->isValid()) {
			
    			$user = new LectureUser();
    			$user->setLecture($lecture);
    			$user->setUsername($lecture->getLectureID());
    			$user->setSalt(md5(time()));
    			$user->setRole('ROLE_LECTURE');
    			
    			$factory = $this->get('security.encoder_factory');
    			$encoder = $factory->getEncoder($user);
    			$password = $encoder->encodePassword($lecture->getEmail(), $user->getSalt());
    			$user->setPassword($password);
    			
				$em = $this->getDoctrine()->getEntityManager();
    			$em->persist($lecture);
    			$em->persist($user);
    			$em->flush();
    		}
    	}
    	
    	
    	$validator = $this->get('validator');
    	$errors = $validator->validate($lecture);
    	
    	if (count($errors) > 0) {
    		return new Response(print_r($errors, true));
    	} else {
    		$this->get('session')->setFlash('notice', 'Lecture details updated successfully!');
    	}
    	return $this->redirect($this->generateUrl('lecture_form'));
    }
	

	
	
	/*************************** LECTURE **************************************/
	
    /*
	public function updateselectAction()
	{
	
		$repository = $this->getDoctrine() 
		->getRepository('UCSCDatabaseBundle:Lecture');
		$lectures = $repository->findAll();
		
		foreach ($lectures as $lecture) {
			
			$sid = $lecture->getLectureID();
			$std[$sid] = $sid;
		}	
	
		$form = $this->createFormBuilder() 
		->add('lectureID', 'choice',array('choices' => $std)) 
		->getForm();
		
		//$Student = $repository->findOneBy(array('registrationNo' => 'sid'));
		
		return $this->render('UCSCRegistrationBundle:Default:update_lecture.html.twig', array(
				'form' => $form->createView()));
	
	
	}
	
	*/
	
	/*****************************************************************/
	
	public function updateformAction($lid)
    {

		$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Lecture');
		$student = $repository->find($lid);
			
		$form = $this->createForm(new LectureType('hidden'), $student);
		
		return $this->render('UCSCRegistrationBundle:Default:update_viwe_lecture.html.twig', array(
				'form' => $form->createView(),'sid' => $lid));
    	
    	
    }
	
	/*****************************************************************/
	
	public function updateAction(Request $request)
    {
    
    	if ($request->getMethod() == 'POST') {
    	
    		$lecture = new Lecture();
			$form = $this->createForm(new LectureType('hidden'), $lecture);
			$form->bindRequest($request);

			if($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$repository = $em->getRepository('UCSCDatabaseBundle:Lecture');
				$lecturenew = $repository->find($lecture->getLectureID());
				
				
				
				$lecturenew->setName($lecture->getName());
				$lecturenew->setTitle($lecture->getTitle());
				$lecturenew->setPhoneNo($lecture->getPhoneNo());
				$lecturenew->setAddress($lecture->getAddress());
				$lecturenew->setDetials($lecture->getDetials());
				
				
				//$validator = $this->get('validator');
				//$errors = $validator->validate($lecture);
				
				
					$this->get('session')->setFlash('notice', 'Course details updated successfully!');
				
					
				$em->flush();
				
				return $this->redirect($this->generateUrl('view2'));
				
			}
			
			else {
				$validator = $this->get('validator');
				$errors = $validator->validate($lecture);
				
				$str = "Update failed! ";
				foreach($errors as $err) {
					$str .= $err->getPropertyPath() .' : '. $err->getMessage().' ';
				}
				$this->get('session')->setFlash('error', $str);
				
				return $this->redirect($this->generateUrl('view2'));
			}
			
		
    	}
    	
    	
    }
    
    
   
    
    /************************  view Lecture **************************************/
    
    
    
    public function viewformAction()
    {
    	    	
    	$form = $this->createFormBuilder()
    	->add('name', 'entity', array('class' => 'UCSCDatabaseBundle:Lecture'))
    	->getForm();
    
    	//$Student = $repository->findOneBy(array('registrationNo' => 'sid'));
    
    	return $this->render('UCSCRegistrationBundle:Default:viewlecture.html.twig', array(
    			'form' => $form->createView()));
    
    
    }
    
    
    
    
    
    public function viewAction(Request $request)
    {
    	$form = $this->createFormBuilder()
    	->add('name', 'entity', array('class' => 'UCSCDatabaseBundle:Lecture'))
    	->getForm();
    
    	if($request->getMethod()=='POST') {
    		$form->bindRequest($request);
    		if($form->isValid()) {
    			$data = $form->getData();
    			
    			$lecture = $data['name'];
    			
    			if($this->get('security.context')->isGranted('ROLE_ADMIN')) {
    			
	    			$form = $this->createFormBuilder($lecture)
	    			->add('lectureID','text',array('label'=>'Lecture ID','read_only'=>true))
					->add('name','text',array('read_only'=>true))
					->add('title','text',array('read_only'=>true))
					->add('phoneNo','text',array('label'=>'Phone No','read_only'=>true))
					->add('address','text',array('label'=>'Address','read_only'=>true))
					->add('detials','textarea',array('label'=>'Educational Detials','read_only'=>true))
	    			
	    			->getForm();
    			
    			}
    			
    			else {
    				
    				$form = $this->createFormBuilder($lecture)
    				->add('lectureID','text',array('label'=>'Lecture ID','read_only'=>true))
    				->add('name','text',array('read_only'=>true))
    				->add('title','text',array('read_only'=>true))
    				->add('detials','textarea',array('label'=>'Educational Detials','read_only'=>true))
    				->getForm();
    			}
    			
    			return $this->render('UCSCRegistrationBundle:Default:view2.html.twig', array('form' => $form->createView(),'lid'=>$lecture->getLectureID()));
    
    		}
    	
	    	else {
	    		throw $this->createNotFoundException('form invalid');
	    	}
    	}
    
    }	
}
