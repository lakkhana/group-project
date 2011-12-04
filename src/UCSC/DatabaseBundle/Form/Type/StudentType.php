<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class StudentType extends AbstractType {

	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		$builder->add('regNo','text');
		$builder->add('name','text');
		$builder->add('gender', 'choice', array('choices' => array('M' => 'Male', 'F' => 'Female')));
		$builder->add('degree', 'choice', array('choices' => array('CS' => 'CS', 'ICT' => 'ICT')));		
		$builder->add('nic','text');
		$builder->add('bday','date');
		$builder->add('address','text');
		$builder->add('email','email');
		$builder->add('phone','integer');
		
	}
	
	public function getName()
	{
		return 'student';
	}

}
