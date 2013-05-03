<?php

namespace UCSC\RegistrationBundle\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

use UCSC\RegistrationBundle\Object\StudentSheet;

use UCSC\DatabaseBundle\Entity\Student;
use UCSC\DatabaseBundle\Entity\StudentUser;
use UCSC\DatabaseBundle\Entity\Year;
use UCSC\DatabaseBundle\Entity\Batch;
use UCSC\DatabaseBundle\Entity\Degree;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class NewController extends Controller
{
    
	public function parseCsvFile($file, $columnheadings = false, $delimiter = ',', $enclosure = "\"")
	{
		$row = 1;
		$rows = array();
		$handle = fopen($file, 'r');
	
		while (($data = fgetcsv($handle, 1000, $delimiter, $enclosure)) !== FALSE) {
	
			if (!($columnheadings == false) && ($row == 1)) {
				$headingTexts = $data;
			} elseif (!($columnheadings == false)) {
				foreach ($data as $key => $value) {
					unset($data[$key]);
					$data[$headingTexts[$key]] = $value;
				}
				$rows[] = $data;
			} else {
				$rows[] = $data;
			}
			$row++;
		}
	
		fclose($handle);
		return $rows;
	}
	
	public function importAction(Request $request)
    {
    	$form = $this->createFormBuilder()
    	->add('file','file')
    	->getForm();
    	//$a = new File($path);
    	//$a->getRealPath();
    	if ($request->getMethod() == 'POST') {
    	
    		$form->bindRequest($request);
    	
    		if ($form->isValid()) {
    	
    			
				$array = $this->parseCsvFile($form['file']->getData()->getPathname(), false);
				$em = $this->getDoctrine()->getEntityManager();
				$factory = $this->get('security.encoder_factory');
				//throw $this->createNotFoundException($form['file']->getData()->getRealPath());
				foreach ($array as $key => $value) {
					$student = new Student();
					
					$bday = new \DateTime($value[7]);
					$repository = $em->getRepository('UCSCDatabaseBundle:Year');
					$year = $repository->find($value[2]);
					$repository = $em->getRepository('UCSCDatabaseBundle:Degree');
					$degree = $repository->find($value[4]);
					$repository = $em->getRepository('UCSCDatabaseBundle:Batch');
					$batch = $repository->findOneByName($value[6]);
					
					//throw $this->createNotFoundException($value[0]);
					$student->setRegNo($value[0]);
					$student->setName($value[1]);
					$student->setYear($year);
					$student->setGender($value[3]);
					$student->setDegree($degree);
					$student->setNic($value[5]);
					$student->setBatch($batch);
					$student->setBday($bday);
					$student->setAddress($value[8]);
					$student->setEmail($value[9]);
					$student->setPhone($value[10]);			
					//$student->setIndexNo($value[11]);
					
					$user = new StudentUser();
					$user->setStudent($student);
					$user->setUsername($student->getRegNo());
					$user->setSalt(md5(time()));
					$user->setRole('ROLE_STUDENT');					
					
					$encoder = $factory->getEncoder($user);
					$password = $encoder->encodePassword($student->getNic(), $user->getSalt());
					$user->setPassword($password);
					
					$em->persist($student);
					$em->persist($user);
					
				}
				$em->flush();
    		}
    	}
		
		return $this->redirect($this->generateUrl('homepage'));
    }
    
    public function importformAction()
    {
    	$form = $this->createFormBuilder()
    	->add('file','file')
    	->getForm();
    	
    	return $this->render('UCSCRegistrationBundle:Default:importcsv.html.twig', array(
    			'form' => $form->createView()));
    	
    }

    
    
    public function newBatchAction(Request $request = null)
    {
    
    	$form = $this->createFormBuilder()
    	->add('batch', 'text')
    	->getForm();
    
    	if ($request->getMethod() == 'POST') {
    
    
    		$form->bindRequest($request);
    
    		if($form->isValid()){
    			$data = $form->getData();
    			$em = $this->getDoctrine()->getEntityManager();
    			$repository = $em->getRepository('UCSCDatabaseBundle:Batch');
    			$batch = $repository->findByName($data['batch']);
    
    			if($batch) {
    				$this->get('session')->setFlash('error', 'Registration Faild. Already Exists!');
    
    			}
    			else {
    				$batch = new Batch();
    				$batch->setName($data['batch']);
    				$em->persist($batch);
    				$em->flush();
    				$this->get('session')->setFlash('notice', 'New Batch Registerd Successfully!');
    
    			}
    			return $this->redirect($this->generateUrl('homepage'));
    
    		}
    		else {
    			throw new Exception("form not valid!");
    		}
    
    	}
    	else {
    		return $this->render('UCSCRegistrationBundle:Default:new_batch.html.twig', array('form' => $form->createView()));
    	}
    
    
    }
		
}
