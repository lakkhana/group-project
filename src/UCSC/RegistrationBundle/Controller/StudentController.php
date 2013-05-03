<?php

namespace UCSC\RegistrationBundle\Controller;

use UCSC\DatabaseBundle\Entity\Student;
use UCSC\DatabaseBundle\Entity\Result;
use UCSC\DatabaseBundle\Entity\Year;

use UCSC\DatabaseBundle\Entity\StudentUser;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Validator\Constraints\Null;

use Symfony\Component\HttpFoundation\Request;

use UCSC\RegistrationBundle\Object\StudentSheet;
use UCSC\DatabaseBundle\Form\Type\StudentType;
use UCSC\DatabaseBundle\Form\Type\StudentSheetType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class StudentController extends Controller
{
    
    public function registerformAction()
    {
		$student = new Student();
		$form = $this->createForm(new StudentType(), $student);
		
		return $this->render('UCSCRegistrationBundle:Default:studentform.html.twig', array(
				'form' => $form->createView(),
		));
    }
    
    public function registerAction(Request $request)
    {
    	$student = new Student();
    	$form = $this->createForm(new StudentType(), $student);
    
    	if ($request->getMethod() == 'POST') {
    	
    		$form->bindRequest($request);
    	
    		if ($form->isValid()) {
    			
    			$user = new StudentUser();
    			$user->setStudent($student);
    			$user->setUsername($student->getRegNo());
    			$user->setSalt(md5(time()));
    			$user->setRole('ROLE_STUDENT');
    			
    			$factory = $this->get('security.encoder_factory');
    			$encoder = $factory->getEncoder($user);
    			$password = $encoder->encodePassword($student->getNic(), $user->getSalt());
    			$user->setPassword($password);
    			
    			$em = $this->getDoctrine()->getEntityManager();
    			$repository = $em->getRepository('UCSCDatabaseBundle:Year');
    			$year = $repository->find(1);
    			$student->setYear($year);
    			$em->persist($student);
    			$em->persist($user);
    			$em->flush();
    		}
    	}
    	
    	
    	/*
    	
    	
    	$validator = $this->get('validator');
    	$errors = $validator->validate($student);
    	
    	
    	
    	if (count($errors) > 0) {
    	//	$errors ='<b><i><font size="5" face="arial" color="red"> error@ Registation no->invalid Value! eg:2009cs012 or 2009ict231 </font></b></i>';
    		return new Response(print_r($errors, true));
    	} else {
    		return new Response('<b><i><font size="5" face="arial" color="green">The student registation is valid! </font></b></i>');
    	}
    	*/
    	
    	
    	return $this->redirect($this->generateUrl('homepage'));
    }
    
	//////////////////////////  editstudentform  /////////////////////////////////////////////////
	
    
	
	public function updateselectAction()
	{
	
		$form = $this->createFormBuilder() 	
				->add('studentid', 'entity', array('label' => 'Registration No',
						'class' => 'UCSCDatabaseBundle:Student'))
				->getForm();
		
		//$Student = $repository->findOneBy(array('registrationNo' => 'sid'));
		
		return $this->render('UCSCRegistrationBundle:Default:update.html.twig', array(
				'form' => $form->createView()));
	
	
	}
	
	
	
	////////////////////////////////  editstudentreg  ////////////////////////////////////////////////
	
	
	
	public function updateformAction($id)
    {
		
    	$em = $this->getDoctrine()->getEntityManager();
    	$repository = $em->getRepository('UCSCDatabaseBundle:Student');
    	$student = $repository->find($id);
    	
    	if ($student) {
    		
			$form = $this->createForm(new StudentType('hidden'), $student);
			//throw $this->createNotFoundException($student->getName());
			return $this->render('UCSCRegistrationBundle:Default:update_viwe.html.twig', array(
				'form' => $form->createView(),'sid' => $student->getRegNo()));
    	}
    	
    	return $this->redirect($this->generateUrl('homepage'));
    }
	
    
    
    
    
/////////////////////////////////////  updatestudent  ///////////////////////////////////////////////////    
    
    
    

	public function updateAction(Request $request)
    {
    
    	if ($request->getMethod() == 'POST') {
    	
    		$student = new Student();
			$form = $this->createForm(new StudentType('hidden'), $student);
			$form->bindRequest($request);

			if($form->isValid()) {
				
				$em = $this->getDoctrine()->getEntityManager();
				$repository = $em->getRepository('UCSCDatabaseBundle:Student');
				$studentnew = $repository->find($student->getRegNo());
				
				
				
				$studentnew->setName($student->getName());
				$studentnew->setBatch($student->getBatch());
				$studentnew->setGender($student->getGender());
				$studentnew->setDegree($student->getDegree());
				$studentnew->setNic($student->getNic());
				$studentnew->setBday($student->getBday());
				$studentnew->setAddress($student->getAddress());
				$studentnew->setEmail($student->getEmail());
				$studentnew->setPhone($student->getPhone());
				$studentnew->setIndexNo($student->getIndexNo());
				
				
				$em->flush();
				return $this->redirect($this->generateUrl('homepage'));
			}
    	}
    	
    	$validator = $this->get('validator');
    	$errors = $validator->validate($student);
    	
    	
    	
    	if (count($errors) > 0) {
    		//	$errors ='<b><i><font size="5" face="arial" color="red"> error@ Registation no->invalid Value! eg:2009cs012 or 2009ict231 </font></b></i>';
    		return new Response(print_r($errors, true));
    	} else {
    		return new Response('<b><i><font size="5" face="arial" color="green">The student update is valid! </font></b></i>');
    	}
    	
    	
    }
    
    
    /************************  view Student  **************************************/
    
    
    
    public function viewformAction()
    {
    	
    	$form = $this->createFormBuilder()
    	->add('batch', 'entity', array('class' => 'UCSCDatabaseBundle:Batch','required' => false))
    	->add('degree', 'entity', array('class' => 'UCSCDatabaseBundle:Degree','required' => false))
    	->getForm();
    	//echo("test !!!!!!!!!!!!!!!");
    	//$Student = $repository->findOneBy(array('registrationNo' => 'sid'));
    
    	return $this->render('UCSCRegistrationBundle:Default:viewstudent.html.twig', array(
    			'form' => $form->createView()));
    
    
    }
    
    
    
    
    
    public function viewAction(Request $request)
    {
    	$form = $this->createFormBuilder()
    	->add('batch', 'entity', array('class' => 'UCSCDatabaseBundle:Batch'))
    	->add('degree', 'entity', array('class' => 'UCSCDatabaseBundle:Degree'))
    	->getForm();
    
    	if($request->getMethod()=='POST') {
    		
    		$form->bindRequest($request);
    		if($form->isValid()) {
    			$data = $form->getData();
	    		$em = $this->getDoctrine()->getEntityManager();
		    	$repository = $em->getRepository('UCSCDatabaseBundle:Student');
		    	
		    if($data['degree']=='' && $data['batch']!='')	{
		    	$students = $repository->findByBatch($data['batch']->getBatchID());
		    }
		    else if($data['batch']=='' && $data['degree']!='')	{
		    	$students = $repository->findByDegree($data['degree']);
		    }
		    else if($data['batch']!='' && $data['degree']!='')	{
		    	$students = $repository->findBy(array('batch' => $data['batch']->getBatchID(),'degree' => $data['degree']));
		    }
		    
		    else {
		    	return $this->redirect($this->generateUrl('view'));
		    }
		    	
		    	
		    	return $this->render('UCSCRegistrationBundle:Default:view.html.twig', array('students' => $students,'degree'=>$data['degree']));
    		
    		}
    	}
    	
    }
    
    
    /////////////////////////   2 yesr register  //////////////////////////////////////////////
    
	
    public function yearRegformAction()
    {
    	$sheet = new StudentSheet();
    	$em = $this->getDoctrine()->getEntityManager();
    	$repository = $em->getRepository('UCSCDatabaseBundle:Student');
    	$students = $repository->findAll();
    	foreach ($students  as $std) {
    		
    		$sheet->addStudent($std);
    	}
    	$form = $this->createForm(new StudentSheetType(), $sheet);
    
    	return $this->render('UCSCRegistrationBundle:Default:2yearStudent.html.twig', array('form' => $form->createView()));
    }
    
   //////////////////////////////////// view student and there onr feild //////////////////////////
    
    public function listbycourseAction($cid)
    {
    	
    			$em = $this->getDoctrine()->getEntityManager();
    			$query = $em->createQuery(
    				'SELECT s.regNo,s.name FROM UCSCDatabaseBundle:Course c
    				JOIN c.ayearcourses ac
    				JOIN ac.results r
					JOIN r.student s
    				WHERE c.courseID=:cid'
    				)->setParameter('cid', $cid);
    				
    			$students = $query->getResult();
    				
    
    
    			return $this->render('UCSCRegistrationBundle:Default:student_feild.html.twig', array('students' => $students));
    
    }
    
    public function listbynameAction($name)
    {
    
    	$em = $this->getDoctrine()->getEntityManager();
    	$query = $em->createQuery(
    			'SELECT s.regNo,s.name FROM UCSCDatabaseBundle:Student s
    
    			WHERE s.nic=:nic'
    	)->setParameter('nic', $name);
    
    	$students = $query->getStudent();
    
    
    
    	return $this->render('UCSCRegistrationBundle:Default:student_feild_by_name.html.twig', array('students' => $students));
    
    }
		
}
