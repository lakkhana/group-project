<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class ViewTimeSlotType extends AbstractType {

	
	
	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		$builder->add('ayearcourse', 'text',array('read_only' => true));
		$builder->add('type', 'text',array('read_only' => true));
		$builder->add('hall', 'text',array('read_only' => true));
	}
	
	public function getName()
	{
		return 'timeslot';
	}

}