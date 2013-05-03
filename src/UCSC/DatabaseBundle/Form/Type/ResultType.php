<?php 
namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ResultType extends AbstractType
	{
	    public function buildForm(FormBuilder $builder, array $options)
	    {	
	    	$builder->add('student',new StudentResultType());
	        $builder->add('score');
	        $builder->add('papper');
	        $builder->add('assignment');
	        $builder->add('grade');
	        $builder->add('conform','hidden');
	    }

	    
	
	    public function getName()
	    {
	        return 'result';
	    }
	}
