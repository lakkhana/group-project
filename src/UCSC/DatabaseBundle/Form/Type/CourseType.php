<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class CourseType extends AbstractType {

	
	private $type;
	
	public function __construct($type = 'text') {
	
		$this->type = $type;
	}
	
	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		for($i=0;$i<8;$i++){
			$semlist[$i] = $i+1;
		}
		
		$builder->add('courseID',$this->type,array('label'=>'Course ID'));
		$builder->add('name','text');
		$builder->add('degree', 'entity', array('class' => 'UCSCDatabaseBundle:Degree'));
		$builder->add('credit','text');
		$builder->add('percentage','text');
		$builder->add('sem', 'entity', array('class' => 'UCSCDatabaseBundle:Semester'));		
		$builder->add('year', 'entity', array('class' => 'UCSCDatabaseBundle:Year'));
		
		
		
	}
	
	
	public function getDefaultOptions(array $options)
	{
		return array('data_class'=>'UCSC\DatabaseBundle\Entity\Course');
	}
	
	public function getName()
	{
		return 'course';
	}

}
