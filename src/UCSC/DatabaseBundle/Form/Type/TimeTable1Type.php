<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class TimeTable1Type extends AbstractType {


	
	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		$builder->add('slots', 'collection', array('type' => new TimeSlot1Type()));
	}
	
	public function getDefaultOptions(array $options){
	
		return array('data_class' => 'UCSC\DatabaseBundle\Entity\TimeTable');
	}
	
	public function getName()
	{
		return 'timetable';
	}

}
