<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class TimeSlot1Type extends AbstractType {


	
	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		
		$builder->add('ayearcourse', 'entity', array('class' => 'UCSCDatabaseBundle:AyearCourse', 'required'=> false));
		$builder->add('type', 'entity', array('class' => 'UCSCDatabaseBundle:SlotType', 'required'=> false));		
		$builder->add('hall', 'entity', array('class' => 'UCSCDatabaseBundle:LectureHall', 'required'=> false));
		}
	
		
	public function getDefaultOptions(array $options){
		
		return array('data_class' => 'UCSC\DatabaseBundle\Entity\TimeSlot');
	}
	public function getName()
	{
		return 'timeslot';
	}

}
