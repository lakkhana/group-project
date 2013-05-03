<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class StudentType extends AbstractType {

	private $type;
	
	public function __construct($type = 'text') {
	
		$this->type = $type;
	}
	
	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		$builder->add('regNo',$this->type,array('label'=>'Registration No'));
		$builder->add('name','text');
		$builder->add('gender', 'choice', array('choices' => array('M' => 'Male', 'F' => 'Female')));
		$builder->add('degree', 'entity', array('class' => 'UCSCDatabaseBundle:Degree'));		
		$builder->add('batch', 'entity', array('class' => 'UCSCDatabaseBundle:Batch'));
		$builder->add('nic','text');
        $builder->add('bday', 'datetime', array('widget'=>'single_text'));
		$builder->add('address','text');
		$builder->add('email','email');
		$builder->add('phone','number',array('label'=>'Phone No'));		
		$builder->add('indexNo','text',array('required'=>false));
		
		
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
