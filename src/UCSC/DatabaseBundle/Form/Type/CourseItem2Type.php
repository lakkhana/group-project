<?php 
namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class CourseItem2Type extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('selected', 'checkbox',array('required'=>false));
	    $builder->add('courseID', 'text');
		$builder->add('courseName', 'text');
		$builder->add('lecture', 'entity', array('class' => 'UCSCDatabaseBundle:Lecture'));
	}


	public function getName()
	{
		return 'course_enrole';
	}
	
}
