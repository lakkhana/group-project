<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class ViewTimeTableType extends AbstractType {


	
	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		$builder->add('slots', 'collection', array('type' => new ViewTimeSlotType()));
	}
	
	public function getName()
	{
		return 'timetable';
	}

}
