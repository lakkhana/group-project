<?php

namespace UCSC\ResultBundle\Controller;

use UCSC\DatabaseBundle\Entity\AyearCourse;

use UCSC\DatabaseBundle\Entity\Semester;

use UCSC\DatabaseBundle\Entity\AcademicYear;

use UCSC\DatabaseBundle\UCSCDatabaseBundle;

use UCSC\DatabaseBundle\Entity\Student;

use Doctrine\Common\Collections\ArrayCollection;

use UCSC\DatabaseBundle\Entity\Result;

use UCSC\ResultBundle\Object\ResultSheet;

use UCSC\DatabaseBundle\Form\Type\ResultSheetType;

use UCSC\DatabaseBundle\Entity\Course;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ResultController extends Controller
{	
	/////////////////////////////////////////////////
	public function selectStudentAction($number)
	{	
		//throw $this->createNotFoundException($number);
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
				'SELECT r,s FROM UCSCDatabaseBundle:Result r
				JOIN r.ayearcourse aye
				JOIN r.student s
				JOIN aye.course cou
				WHERE cou.courseID=:cid' 
		)->setParameter('cid', $number);
				$results = $query->getResult();
			return $this->render('UCSCResultBundle:Default:newresult.html.twig',array('results' => $results));
			
		}
	/////////////////////////////////////////////////
	public function recentArticlesAction($max = 40)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$query10 = $em->createQuery(
				'SELECT c.courseID,c.name FROM UCSCDatabaseBundle:Course c
				JOIN c.year y
				WHERE y.yearID=:caid'
		)->setParameter('caid', '1');
		
		$arts1 = $query10->getResult();
		//$arts1 = $repository->findByYear(1);
		$query11 = $em->createQuery(
				'SELECT c.courseID,c.name  FROM UCSCDatabaseBundle:Course c
				JOIN c.year y
				WHERE y.yearID=:caid'
		)->setParameter('caid', '2');
		
		$arts2 = $query11->getResult();
		//$arts2 = $repository->findByYear(2);
		$query12 = $em->createQuery(
				'SELECT c.courseID,c.name  FROM UCSCDatabaseBundle:Course c
				JOIN c.year y
				WHERE y.yearID=:caid'
		)->setParameter('caid', '3');
		
		$arts3 = $query12->getResult();
		//$arts3 = $repository->findByYear(3);
		$query13 = $em->createQuery(
				'SELECT c.courseID,c.name  FROM UCSCDatabaseBundle:Course c
				JOIN c.year y
				WHERE y.yearID=:caid'
		)->setParameter('caid', '4');
		
		$arts4 = $query13->getResult();
		return $this->render('UCSCResultBundle:Default:recenlistList.html.twig',array('articles1' => $arts1,'articles2' => $arts2,'articles3' => $arts3,'articles4' => $arts4));
	}
	///////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	public function enrolcourseviewAction(Request $request)
	{
		
		$form = $this->createFormBuilder()
		->add('AcademicYear', 'entity',array('class'=>'UCSCDatabaseBundle:AcademicYear'))
		->getForm();
		
		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			$data = $form->getData();
			$em = $this->getDoctrine()->getEntityManager();
			$repository = $em->getRepository('UCSCDatabaseBundle:Degree');
			$degrees = $repository->findAll();
			foreach ($degrees as $degree) {
				for ($y=1;$y<3;$y++) {
					$query1 = $em->createQuery(
							 'SELECT s FROM UCSCDatabaseBundle:Student s
							JOIN s.degree d 
							JOIN s.year y
							WHERE d.degreeID=:degree AND y.yearID=:year'
					)->setParameters(array('degree' => $degree->getDegreeID(),'year'  => $y));
					
					$students = $query1->getResult();
					
					$query2 = $em->createQuery(
							'SELECT ac FROM UCSCDatabaseBundle:AyearCourse ac
							JOIN ac.course c
							JOIN ac.academicYear ay
							JOIN c.year ye
							JOIN c.degree dg
							WHERE dg.degreeID=:degree AND ye.yearID=:year AND ay.academicYear=:ayear'
					)->setParameters(array('degree' => $degree->getDegreeID(),'year'  => $y,'ayear'=>$data['AcademicYear']->getAyearID()));
					$courses = $query2->getResult();	
					foreach ($students as $student){					
						foreach ($courses as $course){						
							$re=new Result();
					  		$re->setStudent($student);
					  		$re->setScore(null);
					  		$re->setAssignment(null);
					  		$re->setGrade(null);
					  		$re->setHashval(null);
					  		$re->setTime(null);
							$re->setAyearcourse($course);
							$re->setConform(false);
							$em->persist($re);			
						}
					}
				
				
						
				}
					
			}
			$em->flush();
			return $this->redirect($this->generateUrl('homepage'));
		}
		else {
			throw $this->createNotFoundException("from not valid!");
		}
		
				
			
			
	}
	//////////////////////
	public function scenrolviewAction()
	{
		$form = $this->createFormBuilder()
		->add('AcademicYear', 'entity',array('class'=>'UCSCDatabaseBundle:AcademicYear'))
		->getForm();
		//$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Batch');
		//$arts1 = $repository->findAll();
	
	
		return $this->render('UCSCResultBundle:Default:index3.html.twig', array('form' => $form->createView()));
	
	}
	
	
	/////////////////////////
	//////////////////////
public function rupdefinalAction(Request $request)
{
	$form1 = $this->createFormBuilder()
	->add('Paper Mark','text')
	->add('Assignment Mark','text')
	->add('Course', 'choice', array('choices' => $courses))
	->add('AcademicYear', 'text')
	// ->add('Degree', 'choice', array('choices' => ))
	->getForm();
	//throw $this->createNotFoundException("test");
	if ($request->getMethod() == 'POST') {
		$form1->bindRequest($request);

		$data = $form1->getData();
		$em = $this->getDoctrine()->getEntityManager();
		$query9 = $em->createQuery(
				'SELECT r FROM UCSCDatabaseBundle:Result r
				JOIN r.ayearcourses ras
				JOIN ras.course rac
				JOIN r.student ra 
				WHERE rac.courseID=:cou'
		)->setParameters(array('cou' => $data['Course']));
		$results = $query9->getResult();
		return $this->render('UCSCResultBundle:Default:resultupdate2.html.twig', array('results'=>$results));
	}



}


///////////////////////////
public function resultupdete1Action(Request $request)
{
	$form = $this->createFormBuilder()
	->add('Degree', 'entity', array('class' =>'UCSCDatabaseBundle:Degree'))
	->add('Semester', 'entity', array('class' =>'UCSCDatabaseBundle:Semester'))
	->add('AcademicYear', 'entity',array('class'=>'UCSCDatabaseBundle:AcademicYear'))
	->add('Paper Mark','text')
	->add('Assignment Mark','text')
	//	
	// ->add('Degree', 'choice', array('choices' => ))
	->getForm();

	if ($request->getMethod() == 'POST') {
		$form->bindRequest($request);
		$em = $this->getDoctrine()->getEntityManager();
		// data is an array with "name", "email", and "message" keys
		$data = $form->getData();
		$form1=$this->createFormBuilder()
		->add('Course', 'entity', array('class' => 'UCSCDatabaseBundle:Degree','required'=> false,
				'query_builder' => function(EntityRepository $em ) use ($data) {
				return $em->createQueryBuilder('c')
				//->join('ac.course', 'c')
					->join( 'c.sem', 'da')
					->join( 'c.ayearcourses', 'd')
					->join('d.results', 'e')
					->join( 'e.student', 'stu')
					->join( 'stu.degree','de')
					->Where('de.degreeID = :Degree')
					->andwhere('da.semID = :Semester')
					->setParameters($data);
		}
		));
		
		
	
	}
	return $this->render('UCSCResultBundle:Default:resultupdate.html.twig', array('form1' => $form1->createView()));
}
///////////////////////////
public function rupdateAction()
{	

	$form = $this->createFormBuilder()
	

	->add('Degree', 'entity', array('class' => 'UCSCDatabaseBundle:Degree'))
	->add('Semester','entity', array('class' => 'UCSCDatabaseBundle:Semester'))
	->add('AcademicYear', 'entity',array('class'=>'UCSCDatabaseBundle:AcademicYear'))
	->add('Paper Mark','text')
	->add('Assignment Mark','text')
	
	->getForm();

	

	if ($request->getMethod() == 'POST') {
	$form->bindRequest($request);

	$data = $form->getData();
	}
	return $this->render('UCSCResultBundle:Default:resultupdate.html.twig', array('form' => $form->createView()));
		
	}		
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	/////////////////////////////////////////////////////
	public function resultconformAction(Request $request)
	{
		$form = $this->createFormBuilder()
		
		->add('AcademicYear','entity',array('class'=>'UCSCDatabaseBundle:AcademicYear'))
		->add('sid','hidden')
		//->add('Course', 'choice')
		->getForm();
	
		
		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			
			$data = $form->getData();
			$em = $this->getDoctrine()->getEntityManager();//	
			$query7 = $em->createQuery(
					'SELECT r FROM UCSCDatabaseBundle:Result r
					JOIN r.ayearcourse ras
					JOIN ras.course rac
					JOIN ras.academicYear raa
					WHERE rac.courseID=:cou AND raa.ayearID=:acid'
			)->setParameters(array('cou' => $data['sid'],'acid' => $data['AcademicYear']));
			$results = $query7->getResult();
			if($results){
				
			foreach ($results as $result){
				$result->setConform(true);
				$em->persist($result);
				
			}
			}
			}
			$em->flush();
			return $this->render('UCSCResultBundle:Default:conform.html.twig');
				
	}

	//////////////////////////
	
	/////////////////////////
public function comAction($number){//throw $this->createNotFoundException($number);
	$defaultData = array('sid' => $number);
	$form = $this->createFormBuilder($defaultData)
	->add('AcademicYear', 'entity',array('class'=>'UCSCDatabaseBundle:AcademicYear'))
	->add('sid','hidden')
	->getForm();
	
	return $this->render('UCSCResultBundle:Default:com.html.twig',array('form' => $form->createView()));
	
	
}
	////////////////////////////
	public function conformviewAction($max = 40)
	{
		
		
		$em = $this->getDoctrine()->getEntityManager();
		$query10 = $em->createQuery(
				'SELECT c.courseID,c.name FROM UCSCDatabaseBundle:Course c
				JOIN c.year y
				WHERE y.yearID=:caid'
		)->setParameter('caid', '1');
		
		$arts1 = $query10->getResult();
		//$arts1 = $repository->findByYear(1);
		$query11 = $em->createQuery(
				'SELECT c.courseID,c.name  FROM UCSCDatabaseBundle:Course c
				JOIN c.year y
				WHERE y.yearID=:caid'
		)->setParameter('caid', '2');
		
		$arts2 = $query11->getResult();
		//$arts2 = $repository->findByYear(2);
		$query12 = $em->createQuery(
				'SELECT c.courseID,c.name  FROM UCSCDatabaseBundle:Course c
				JOIN c.year y
				WHERE y.yearID=:caid'
		)->setParameter('caid', '3');
		
		$arts3 = $query12->getResult();
		//$arts3 = $repository->findByYear(3);
		$query13 = $em->createQuery(
				'SELECT c.courseID,c.name  FROM UCSCDatabaseBundle:Course c
				JOIN c.year y
				WHERE y.yearID=:caid'
		)->setParameter('caid', '4');
		
		$arts4 = $query13->getResult();
		
		return $this->render('UCSCResultBundle:Default:index2.html.twig',array('articles1' => $arts1,'articles2' => $arts2,'articles3' => $arts3,'articles4' => $arts4));
		

	
	
	}
	

	//0kkkkkk
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
    ////////////////////////////////////////
    public function clistAction(Request $request)
    {
    	$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Course');
    	$degree = $_POST['degree'];
    	$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Semester');
    	$sem = $_POST['sem'];
    	if($sem && $degree) {
    		$courses = $repository->findBy(array('sem'=>$sem,'degree'=>$degree));
    	}
    	elseif($sem) {
    		$courses = $repository->findBySem($sem);
    	}
    	elseif($degree) {
    		$courses = $repository->findByDegree($degree);
    	}
    	
    	if($courses != null) {
    		
    		foreach ($courses as $course){
	    		$cid=$course->getCourseID();
	    		$c[$cid]=$cid;
	    		//$a++;
	    	}
    	}
    	else {
    		$c = array();
    	}
    	throw $this->createNotFoundException("test");
    	$form1 = $this->createFormBuilder()
    	->add('Course', 'choice', array('choices' => $c))
    	->add('AcademicYear', 'text')
    	->getForm();
    	
    	return $this->render('UCSCResultBundle:Default:clist.html.twig', array('form' => $form1->createView()));
    
    }

///////////////////////
    public function resupAction(Request $request,$count)
    {
    	if ($request->getMethod() == 'POST') {
    
    		$sheet=new ResultSheet();
    		for($a=0;$a<$count;$a++){
    			$r[$a] = new Result();
    			$s[$a] = new Student();
    			$c[$a] = new AyearCourse();
    			$r[$a]->setAyearCourse($c[$a]);
    			$r[$a]->setStudent($s[$a]);
    			$sheet->addResult($r[$a]);
    		}
    		//
    	
    		//throw $this->createNotFoundException($sheet->getResults()->count());
    		$form = $this->createForm(new ResultSheetType(),$sheet);
    		//throw $this->createNotFoundException($request->get('resultsheet'));
    		$form->bindRequest($request);
    		//	throw $this->createNotFoundException($form->bindRequest($request));
    		if($form->isValid()){
    			$em = $this->getDoctrine()->getEntityManager();
				$repository = $em->getRepository('UCSCDatabaseBundle:Result');
				$rsl = $sheet->getResults()->first();
    			if($rsl->getConform()!= true){
    				
    	//	throw $this->createNotFoundException($rsl->getGrade());
    				for($b=0;$b<$count;$b++){
    					$result[$b] = $repository->findOneByStudent($rsl->getStudent()->getRegNo());
    					//throw $this->createNotFoundException($result[$b]->getStudent()->getRegNo());
    					if($result[$b]){
    					$result[$b]->setScore($rsl->getScore());
    					$result[$b]->setPapper($rsl->getPapper());
    					$result[$b]->setAssignment($rsl->getAssignment());
    					$result[$b]->setGrade(ucwords($rsl->getGrade()));
    					$result[$b]->setTime(Time());
    			
    					$addval=strval($result[$b]->getScore())+ strval($result[$b]->getTime());
    					$hashval =sha1($addval);
    					// $encoder->encodehashval($result[$b]->getScore(), $result[$b]->getTime());
    					$result[$b]->setHashval($hashval);
    					$rsl = $sheet->getResults()->next();
    					$em = $this->getDoctrine()->getEntityManager();
    					$em->persist($result[$b]);
    				}
    				}
    				
    		}$em->flush();
    		}
    		else {
    			throw $this->createNotFoundException("form not valid");
    			
    		}
    	}return $this->redirect($this->generateUrl('homepage'));
    	
    }

///////////////////////////////////////////////////
public function updeAction($number){
	$defaultData = array('sid' => $number);
	$form = $this->createFormBuilder($defaultData)
	->add('AcademicYear', 'entity',array('class'=>'UCSCDatabaseBundle:AcademicYear'))
	->add('sid','hidden')
	->getForm();
	
	return $this->render('UCSCResultBundle:Default:academicy.html.twig',array('form' => $form->createView()));
	
	
}
public function enterresultAction(Request $request)
    {
    	$count=0;
    	$form = $this->createFormBuilder()
    	->add('AcademicYear', 'entity',array('class'=>'UCSCDatabaseBundle:AcademicYear'))
    	->add('sid','hidden')
		->getForm();
    	if ($request->getMethod() == 'POST') {
    	
    		$form->bindRequest($request);
    		$data = $form->getData();
    		$sheet=new ResultSheet();
	    	$em = $this->getDoctrine()->getEntityManager();
	    	$query = $em->createQuery(
	    			'SELECT r FROM UCSCDatabaseBundle:Result r
	    			JOIN r.ayearcourse ayec
	    			JOIN r.student s
	    			JOIN ayec.course cou
	    			JOIN ayec.academicYear ay
	    			WHERE cou.courseID=:cid
	    			AND ay.ayearID=:aid'
	    	)->setParameters(array('cid'=> $data['sid'],'aid'=>$data['AcademicYear']));
	    
	    	$results = $query->getResult();
	    	
	    	//if($courses==0)
	    	foreach ($results as $result){
	    		$sheet->addResult($result);
	    		
	    		$count++;
	    		//throw $this->createNotFoundException("rrr");
	    	}		    	
	    	$sheet->setCount($count);
	    	$form = $this->createForm(new ResultSheetType(), $sheet);}
	    	return $this->render('UCSCResultBundle:Default:newresult1.html.twig',array('form' => $form->createView(),'count'=>$count));	
	    		
    		
    }
    	/////////////////////////////////////////////////
    	public function courseselectAction($max = 40)
    		{
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	$query10 = $em->createQuery(
    	'SELECT c.courseID,c.name FROM UCSCDatabaseBundle:Course c
    	JOIN c.year y
    	WHERE y.yearID=:caid'
    	)->setParameter('caid', '1');
    
    	$arts1 = $query10->getResult();
    	//$arts1 = $repository->findByYear(1);
    	$query11 = $em->createQuery(
    	'SELECT c.courseID,c.name  FROM UCSCDatabaseBundle:Course c
    	JOIN c.year y
    	WHERE y.yearID=:caid'
    	)->setParameter('caid', '2');
    
    	$arts2 = $query11->getResult();
    	//$arts2 = $repository->findByYear(2);
    	$query12 = $em->createQuery(
    	'SELECT c.courseID,c.name  FROM UCSCDatabaseBundle:Course c
    	JOIN c.year y
    	WHERE y.yearID=:caid'
    	)->setParameter('caid', '3');
    
    	$arts3 = $query12->getResult();
    	//$arts3 = $repository->findByYear(3);
    	$query13 = $em->createQuery(
    	'SELECT c.courseID,c.name  FROM UCSCDatabaseBundle:Course c
    	JOIN c.year y
    	WHERE y.yearID=:caid'
    	)->setParameter('caid', '4');
    
    	$arts4 = $query13->getResult();
    	
    			return $this->render('UCSCResultBundle:Default:select.html.twig',array('articles1' => $arts1,'articles2' => $arts2,'articles3' => $arts3,'articles4' => $arts4));
    }
}
//////////////////////////
//////////////////////////////////