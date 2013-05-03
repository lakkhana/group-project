<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class StudentResultType extends AbstractType {

	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		$builder->add('regNo','text');
		//$builder->add('name','text',array('read_only'=>true));
		
	}
	
	public function getDefaultOptions(array $options)
	{
		return array('data_class'=>'UCSC\DatabaseBundle\Entity\Student');
	}
	
	public function getName()
	{
		return 'student_result';
	}

}
