<?php
namespace UCSC\ScholarshipBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use UCSC\DatabaseBundle\Entity\MahapolaPayment;
use UCSC\DatabaseBundle\Entity\BursaryPayment;

use UCSC\DatabaseBundle\Entity\Mahapola;
use UCSC\DatabaseBundle\Entity\Bursary;

use UCSC\DatabaseBundle\Entity\MahapolaType;
use UCSC\DatabaseBundle\Form\Type\MahapolaTypeType;
use UCSC\DatabaseBundle\Form\Type\MahapolaTypeUpType;


use UCSC\DatabaseBundle\Entity\BursaryType;
use UCSC\DatabaseBundle\Form\Type\BursaryTypeType;
use UCSC\DatabaseBundle\Form\Type\BursaryTypeUpType;

use UCSC\ScholarshipBundle\UCSCScholarshipBundle;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ScholarController extends Controller
{
	
	
/*************************** Mahapola Registration **************************************/
	
	public function regMahapolaformAction()
	{
	
		$form = $this->createFormBuilder()	
		->add('batch', 'entity', array('class' => 'UCSCDatabaseBundle:Batch'))
		->getForm();

		return $this->render('UCSCScholarshipBundle:Default:mahapolareg1.html.twig', array('form' => $form->createView()));
	}
	
	public function regMahapolaselectAction(Request $request)
	{
	
			$batch = $_POST['batch'];
			
			$em = $this->getDoctrine()->getEntityManager();
			if($batch) {
				$query = $em->createQuery(
						'SELECT s FROM UCSCDatabaseBundle:Student s
						JOIN s.batch b
						WHERE b.batchID=:batch'
				)->setParameter('batch', $batch);
				
				$students = $query->getResult();
				//$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Student');
				//$students = $repository->findByBatch($batch);
				if($students) {
					foreach ($students as $std){
						$sid[$std->getRegNo()]=$std->getRegNo();
					}
					/*
					$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:MahapolaType');
					$types = $repository->findAll();
					
					foreach ($types as $type){
						$t[$type->getType()]=$type->getType();
					}
					*/
				}
				
				
			}
			if(!$students) {
				$sid = array();
				//$t = array();
			}
			//$repository = $em->getRepository('UCSCDatabaseBundle:MahapolaType');
			//$types = $repository->findAll();
			/*
			foreach ($types as $type){
				$t[$type->getType()]=$type->getType();
			}
			*/
			$form1 = $this->createFormBuilder()
			->add('student', 'choice', array('choices' => $sid))
			->add('type', 'entity', array('class' => 'UCSCDatabaseBundle:MahapolaType'))
			->getForm();
			
			return $this->render('UCSCScholarshipBundle:Default:mahapolareg2.html.twig', array('form1' => $form1->createView()));

	}
	
	public function regMahapolaAction(Request $request)
	{
		$mahapola = new Mahapola();
		
		$form = $this->createFormBuilder()
			->add('student', 'choice')
			->add('type', 'entity', array('class' => 'UCSCDatabaseBundle:MahapolaType'))
			->getForm();
			
		if($request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
			if($form->isValid()) {
				
				$data = $form->getData();
				//throw $this->createNotFoundException($data['student']);
				$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Student');
				$student = $repository->find($data['student']);
				//$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:MahapolaType');
				//$type = $repository->find($data['type']);
				
				$mahapola->setStudent($student);
				$mahapola->setType($data['type']);
				$mahapola->setTotal(0);
				$em = $this->getDoctrine()->getEntityManager();
    			$em->persist($mahapola);
    			$em->flush();
    			$this->get('session')->setFlash('notice', 'Student registered for mahapola successfully!');
				return $this->redirect($this->generateUrl('homepage'));
			}
		}
	}

/*************************** Bursary Registration **************************************/	
public function regBursaryformAction()
	{
	
		$form = $this->createFormBuilder()	
		->add('batch', 'entity', array('class' => 'UCSCDatabaseBundle:Batch'))
		->getForm();

		return $this->render('UCSCScholarshipBundle:Default:bursaryreg1.html.twig', array('form' => $form->createView()));
	}
	
	public function regBursaryselectAction(Request $request)
	{
	
			$batch = $_POST['batch'];
			
			$em = $this->getDoctrine()->getEntityManager();
			if($batch) {
				$query = $em->createQuery(
						'SELECT s FROM UCSCDatabaseBundle:Student s
						JOIN s.batch b
						WHERE b.batchID=:batch'
				)->setParameter('batch', $batch);
				
				$students = $query->getResult();
				//$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Student');
				//$students = $repository->findByBatch($batch);
				if($students) {
					foreach ($students as $std){
						$sid[$std->getRegNo()]=$std->getRegNo();
					}
					/*
					$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:MahapolaType');
					$types = $repository->findAll();
					
					foreach ($types as $type){
						$t[$type->getType()]=$type->getType();
					}
					*/
				}
				
				
			}
			if(!$students) {
				$sid = array();
				//$t = array();
			}/*
			$repository = $em->getRepository('UCSCDatabaseBundle:BursaryType');
			$types = $repository->findAll();
			
			foreach ($types as $type){
				$t[$type->getType()]=$type->getType();
			}
			*/
			$form1 = $this->createFormBuilder()
			->add('student', 'choice', array('choices' => $sid))
			->add('type', 'entity', array('class' => 'UCSCDatabaseBundle:BursaryType'))
			->getForm();
			
			return $this->render('UCSCScholarshipBundle:Default:bursaryreg2.html.twig', array('form1' => $form1->createView()));

	}
	
	public function regBursaryAction(Request $request)
	{
		$bursary = new Bursary();
		
		$form = $this->createFormBuilder()
		->add('student', 'choice')
		->add('type', 'entity', array('class' => 'UCSCDatabaseBundle:BursaryType'))
		->getForm();
			
		if($request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
			if($form->isValid()) {
				
				$data = $form->getData();
				//throw $this->createNotFoundException($data['student']);
				$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Student');
				$student = $repository->find($data['student']);
				//$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:BursaryType');
				//$type = $repository->find($data['type']);
				
				$bursary->setStudent($student);
				$bursary->setType($data['type']);
				$bursary->setTotal(0);
				$em = $this->getDoctrine()->getEntityManager();
    			$em->persist($bursary);
    			$em->flush();
				return $this->redirect($this->generateUrl('homepage'));
			}
		}
	}
	
	
	
/*************************** Mahapola Payment ****************************************************/	
	public function payMahapolaformAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$query = $em->createQuery(
				'SELECT s FROM UCSCDatabaseBundle:Student s
				JOIN s.mahapola m');
		
		$students = $query->getResult();
		//$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Student');
		//$students = $repository->findByBatch($batch);
		
		foreach ($students as $std){
			$sid[$std->getRegNo()]=$std->getRegNo();
		}
		if(!$students) {
			$sid = array();
			//$t = array();
		}
	
		$form = $this->createFormBuilder()
		->add('sregno', 'choice', array('label'=>'Registration No','choices' => $sid))
		->getForm();
	
		
		return $this->render('UCSCScholarshipBundle:Default:mahapolaPay1.html.twig', array('form' => $form->createView()));
	}
	public function payMahapolaselectAction(Request $request)
	{
	
		$regno=$_POST['regno'];
			$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Student');
			$student = $repository->find($regno);
			if($student) {
				
				$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Mahapola');
				$type = $repository->find($regno);
				
				$defaultData = array('student' => $student->getName(),'type' => $type->getType()->getType(),'regno' =>$student->getRegNo());
				$form1 = $this->createFormBuilder($defaultData)
				->add('student', 'text',array('read_only'=>true))
				->add('type', 'text',array('read_only'=>true))
				->add('year', 'text')
				->add('month', 'text')
				->add('regno', 'hidden')
				->getForm();
			}
			else {
				$form1 = $this->createFormBuilder()
				->add('student', 'text',array('read_only'=>true))
				->add('type', 'text',array('read_only'=>true))
				->add('year', 'text')
				->add('month', 'text')
				->add('regno', 'hidden')
				->getForm();
			}
		return $this->render('UCSCScholarshipBundle:Default:mahapolaPay2.html.twig', array('form1' => $form1->createView()));
			
		}
	
	public function payMahapolaAction(Request $request)
	{
	
		$mahapolapay = new MahapolaPayment();
	
		$form = $this->createFormBuilder()
		->add('student', 'text')
		->add('type', 'text')
		->add('year', 'text')
		->add('month', 'text')
		->add('regno', 'hidden')
		
		->getForm();
		
		if($request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
			if($form->isValid()) {
				
				$data = $form->getData();
				
				$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Mahapola');
				$student = $repository->find($data['regno']);
				
				$type = $student->getType();
				
				$total=$student->getTotal()+$type->getAmount();
				
				$student->setTotal($total);
				
				$mahapolapay->setStudent($student);
				$mahapolapay->setYear($data['year']);
				$mahapolapay->setMonth($data['month']);
				
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($mahapolapay);
				$em->flush();
				
			}
		}
		return $this->redirect($this->generateUrl('homepage'));
	}
	
/*************************** Bursary Payment *****************************************************************/	
	
	public function payBursaryformAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$query = $em->createQuery(
				'SELECT s FROM UCSCDatabaseBundle:Student s
				JOIN s.bursary b');
		
		$students = $query->getResult();
		//$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Student');
		//$students = $repository->findByBatch($batch);
		
		foreach ($students as $std){
			$sid[$std->getRegNo()]=$std->getRegNo();
		}
		if(!$students) {
			$sid = array();
			//$t = array();
		}
	
		$form = $this->createFormBuilder()
		->add('sregno', 'choice', array('label'=>'Registration No','choices' => $sid))
		->getForm();
		
		return $this->render('UCSCScholarshipBundle:Default:bursaryPay1.html.twig', array('form' => $form->createView()));
		
	
		
	
		
	}
	public function payBursaryselectAction(Request $request)
	{
	
	$regno=$_POST['regno'];
			$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Student');
			$student = $repository->find($regno);
			if($student) {
				
				$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Bursary');
				$type = $repository->find($regno);
				
				$defaultData = array('student' => $student->getName(),'type' => $type->getType()->getType(),'regno' =>$student->getRegNo());
				$form1 = $this->createFormBuilder($defaultData)
				->add('student', 'text',array('read_only'=>true))
				->add('type', 'text',array('read_only'=>true))
				->add('year', 'text')
				->add('month', 'text')
				->add('regno', 'hidden')
				->getForm();
			}
			else {
				$form1 = $this->createFormBuilder()
				->add('student', 'text',array('read_only'=>true))
				->add('type', 'text',array('read_only'=>true))
				->add('year', 'text')
				->add('month', 'text')
				->add('regno', 'hidden')
				->getForm();
			}
		return $this->render('UCSCScholarshipBundle:Default:bursaryPay2.html.twig', array('form1' => $form1->createView()));
			
	}
	
	public function payBursaryAction(Request $request)
	{
	
		$bursarypay = new BursaryPayment();
	
		$form = $this->createFormBuilder()
		->add('student', 'text')
		->add('type', 'text')
		->add('year', 'text')
		->add('month', 'text')
		->add('regno', 'hidden')
	
		->getForm();
	
		if($request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
			if($form->isValid()) {
	
				$data = $form->getData();
	
				$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:Bursary');
				$student = $repository->find($data['regno']);
	
				$type = $student->getType();
	
				$total=$student->getTotal()+$type->getAmount();
	
				$student->setTotal($total);
	
				$bursarypay->setStudent($student);
				$bursarypay->setYear($data['year']);
				$bursarypay->setMonth($data['month']);
	
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($bursarypay);
				$em->flush();
	
			}
		}
		return $this->redirect($this->generateUrl('homepage'));
	}
	

	
/*************************** Scholarship Type ******************************************************************/	
	public function MahapolaTypeformAction()
	{
		$type = new MahapolaType();
		$form = $this->createForm(new MahapolaTypeType(), $type );
	
		return $this->render('UCSCScholarshipBundle:Default:MahapolaTypeform.html.twig', array(
				'form' => $form->createView(),
		));
	}
	
	public function MahapolaTyperegAction(Request $request)
	{
		$type = new MahapolaType();
		$form = $this->createForm(new MahapolaTypeType(), $type);
	
		if ($request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
	
			if ($form->isValid()) {
	
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($type);
				$em->flush();
			}
		}
		return $this->redirect($this->generateUrl('login'));
	}
	
	public function BursaryTypeformAction()
	{
		$type = new BursaryType();
		$form = $this->createForm(new BursaryTypeType(), $type );
	
		return $this->render('UCSCScholarshipBundle:Default:BursaryTypeform.html.twig', array(
				'form' => $form->createView(),
		));
	}
	
	public function BursaryTyperegAction(Request $request)
	{
		$type = new BursaryType();
		$form = $this->createForm(new BursaryTypeType(), $type);
	
		if ($request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
	
			if ($form->isValid()) {
	
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($type);
				$em->flush();
			}
		}
		return $this->redirect($this->generateUrl('homepage'));
	}

/*************************** Mahapola Update **************************************/
	
	public function editMahapolaTypeformAction()
	{
		$repository = $this->getDoctrine()
		->getRepository('UCSCDatabaseBundle:MahapolaType');
		$MahapolaType = $repository->findAll();
	
		foreach ($MahapolaType as $MahapolaType) {
	
			$cid = $MahapolaType->getType();
			$std[$cid] = $cid;
		}
	
		$form = $this->createFormBuilder()
		->add('Type', 'choice',array('choices' => $std))
		->getForm();
	
		return $this->render('UCSCScholarshipBundle:Default:update_mahapolaType.html.twig', array(
				'form' => $form->createView()));
	}
	
	public function editMahapolaTyperegAction(Request $request)
	{
		$form = $this->createFormBuilder()
		->add('Type', 'choice')
		->getForm();
	
		if ($request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
			$data = $form->getData();
	
			$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:MahapolaType');
			$type = $repository->find($data['Type']);
	
			$form = $this->createForm(new MahapolaTypeUpType(), $type);
	
			return $this->render('UCSCScholarshipBundle:Default:update_viwe_MahapolaType.html.twig', array(
					'form' => $form->createView(),'cid' => $data['Type']
			));
		}
		return $this->redirect($this->generateUrl('homepage'));
	}
		
	public function updateMahapolaTypeAction(Request $request)
	{
		if ($request->getMethod() == 'POST') {
	
			$MahapolaType = new MahapolaType();
			$form = $this->createForm(new MahapolaTypeUpType(), $MahapolaType);
			$form->bindRequest($request);
	
			if($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$repository = $em->getRepository('UCSCDatabaseBundle:MahapolaType');
				$MahapolaTypenew = $repository->find($MahapolaType->getType());
	
				//$MahapolaTypenew->setType($MahapolaType->getType());
				$MahapolaTypenew->setAmount($MahapolaType->getAmount());
	
				$em->flush();return $this->redirect($this->generateUrl('homepage'));
			}
		}
	}
	
/*************************** Bursary Update *************************************************/
	
	public function editBursaryTypeformAction()
	{
		$repository = $this->getDoctrine()
		->getRepository('UCSCDatabaseBundle:BursaryType');
		$BursaryType = $repository->findAll();
	
		foreach ($BursaryType as $BursaryType) {
	
			$cid = $BursaryType->getType();
			$std[$cid] = $cid;
		}
	
		$form = $this->createFormBuilder()
		->add('Type', 'choice',array('choices' => $std))
		->getForm();
	
		return $this->render('UCSCScholarshipBundle:Default:update_bursaryType.html.twig', array(
				'form' => $form->createView()));
	}

	public function editBursaryTyperegAction(Request $request)
	{
		$form = $this->createFormBuilder()
		->add('Type', 'choice')
		->getForm();
	
		if ($request->getMethod() == 'POST') {
	
			$form->bindRequest($request);
			$data = $form->getData();
	
			$repository = $this->getDoctrine()->getRepository('UCSCDatabaseBundle:BursaryType');
			$type = $repository->find($data['Type']);
	
			$form = $this->createForm(new BursaryTypeUpType(), $type);
	
			return $this->render('UCSCScholarshipBundle:Default:update_viwe_bursaryType.html.twig', array(
					'form' => $form->createView(),'cid' => $data['Type']
			));
		}
		return $this->redirect($this->generateUrl('homepage'));
	}
	
	public function updateBursaryTypeAction(Request $request)
	{
		if ($request->getMethod() == 'POST') {
	
			$btype = new BursaryType();
			$form = $this->createForm(new BursaryTypeUpType(), $btype);
			$form->bindRequest($request);
	
			if($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$repository = $em->getRepository('UCSCDatabaseBundle:BursaryType');
				$btypenew = $repository->find($btype->getType());
	
				$btypenew->setAmount($btype->getAmount());
	
				$em->flush();
				return $this->redirect($this->generateUrl('homepage'));
				
			}
		}
	}

/*************************** Mahapola View *************************************************/

public function viewformAction()
{

	$form = $this->createFormBuilder()
	->add('batch', 'entity', array('class' => 'UCSCDatabaseBundle:Batch','required' => false))
	->getForm();
	
	return $this->render('UCSCScholarshipBundle:Default:viewmahapola.html.twig', array(
			'form' => $form->createView()));
}


public function viewAction(Request $request)
{
	$form = $this->createFormBuilder()
	->add('batch', 'entity', array('class' => 'UCSCDatabaseBundle:Batch'))
	->getForm();

	if($request->getMethod()=='POST') {

		$form->bindRequest($request);
		if($form->isValid()) {
			$data = $form->getData();
			
		$em = $this->getDoctrine()->getEntityManager();
		$batch=$data['batch'];
		if($batch) {
			$query = $em->createQuery(
					'SELECT m FROM UCSCDatabaseBundle:Mahapola m
					JOIN m.student s
					JOIN s.batch b					
					WHERE b.batchID=:batch'
			)->setParameter('batch', $batch);
			
			$students = $query->getResult();
			
			return $this->render('UCSCScholarshipBundle:Default:viewmahapoladetails.html.twig', array('students' => $students));

			}
		}
	}
}
/*************************** Bursary View *************************************************/

public function viewbursaryformAction()
{

	$form = $this->createFormBuilder()
	->add('batch', 'entity', array('class' => 'UCSCDatabaseBundle:Batch','required' => false))
	->getForm();

	return $this->render('UCSCScholarshipBundle:Default:viewbursary.html.twig', array(
			'form' => $form->createView()));
}


public function viewbursaryAction(Request $request)
{
	$form = $this->createFormBuilder()
	->add('batch', 'entity', array('class' => 'UCSCDatabaseBundle:Batch'))
	->getForm();

	if($request->getMethod()=='POST') {

		$form->bindRequest($request);
		if($form->isValid()) {
			$data = $form->getData();

			$em = $this->getDoctrine()->getEntityManager();
			$batch=$data['batch'];
			if($batch) {
				$query = $em->createQuery(
						'SELECT br FROM UCSCDatabaseBundle:Bursary br
						JOIN br.student s
						JOIN s.batch b
						WHERE b.batchID=:batch'
				)->setParameter('batch', $batch);

				$students = $query->getResult();

				return $this->render('UCSCScholarshipBundle:Default:viewbursarydetails.html.twig', array('students' => $students));

			}
		}
	}
}



}
