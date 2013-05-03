<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class TimeTableType extends AbstractType {

	private $data = null;
	
	public function __construct(array $data=null) {
	
		$this->data = $data;
	}
	
	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		$builder->add('slots', 'collection', array('type' => new TimeSlotType($this->data)));
	}
	
	public function getName()
	{
		return 'timetable';
	}

}
