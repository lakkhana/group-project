<?php

namespace UCSC\RegistrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use UCSC\DatabaseBundle\Form\Type\StudentType;

use UCSC\DatabaseBundle\Entity\Student;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function studentformAction()
    {
		$student = new Student();
		$form = $this->createForm(new StudentType(), $student);
		
		return $this->render('UCSCRegistrationBundle:Default:index.html.twig', array(
				'form' => $form->createView(),
		));
    }
    
    public function studentregAction(Request $request)
    {
    	$student = new Student();
    	$form = $this->createForm(new StudentType(), $student);
    
    	return $this->render('UCSCRegistrationBundle:Default:index.html.twig', array(
    			'form' => $form->createView(),
    	));
    }
}
