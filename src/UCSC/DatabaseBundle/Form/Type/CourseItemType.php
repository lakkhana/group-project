<?php 
namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class CourseItemType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('selected', 'checkbox',array('required'=>false));
	    $builder->add('courseid', 'text');
		$builder->add('coursename', 'text');
		$builder->add('ayearCourse', 'hidden');
	}


	public function getName()
	{
		return 'result';
	}
	
}
