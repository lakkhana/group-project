<?php

namespace UCSC\DatabaseBundle\Form\Type;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class TimeSlotType extends AbstractType {

	
	private $data = null;
	
	public function __construct(array $data=null) {
		
		$this->data = $data;
	}
	
	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {
		$data = $this->data;
		$builder->add('ayearcourse', 'entity', array('class' => 'UCSCDatabaseBundle:AyearCourse', 'required'=> false,
	'query_builder' => function(EntityRepository $er ) use ($data) {
               return $er->createQueryBuilder('ac')
                       ->join('ac.course', 'c')
                       ->join('ac.academicYear','ay')
                       ->where('c.year = :year')
                       ->andWhere('ay.ayearID = :academicYear')
                       ->andWhere('c.sem = :sem')
                       ->andWhere('c.degree = :degree')
                       ->setParameters($data); }
    ));
		$builder->add('type', 'entity', array('class' => 'UCSCDatabaseBundle:SlotType', 'required'=> false));		
		$builder->add('hall', 'entity', array('class' => 'UCSCDatabaseBundle:LectureHall', 'required'=> false));
		}
	
	public function getName()
	{
		return 'timeslot';
	}

}
