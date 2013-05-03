<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class ExamTimeTableType extends AbstractType {

	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		$builder->add('date','date',array('label'=>'Registration No'));
		$builder->add('name','text');
		$builder->add('batch','text');
		$builder->add('gender', 'choice', array('choices' => array('M' => 'Male', 'F' => 'Female')));
		$builder->add('degree', 'choice', array('choices' => array('CS' => 'CS', 'ICT' => 'ICT')));		
		$builder->add('nic','text');
		$builder->add('bday','date', array('label'=> 'Birthday (dd/mm/yyyy)', 'widget'=>'single_text','format'=>'d/M/y'));
		$builder->add('address','text');
		$builder->add('email','email');
		$builder->add('phone','number',array('label'=>'Phone No'));
		
		
	}
	
	public function getDefaultOptions(array $options)
	{
		return array('data_class'=>'UCSC\DatabaseBundle\Entity\Student');
	}
	
	public function getName()
	{
		return 'student';
	}

}
