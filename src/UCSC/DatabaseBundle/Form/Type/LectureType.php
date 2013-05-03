<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class LectureType extends AbstractType {

	private $type;
	
	public function __construct($type = 'text') {
	
		$this->type = $type;
	}
	
	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		$builder->add('lectureID',$this->type,array('label'=>'Lecture ID'));
		$builder->add('name','text');
		$builder->add('title','text');
		$builder->add('phoneNo','text',array('label'=>'Phone No'));
		$builder->add('address','text',array('label'=>'Address'));
		$builder->add('detials','textarea',array('label'=>'Educational Detials'));
		
		
	}
	
	public function getName()
	{
		return 'lecture';
	}

}
