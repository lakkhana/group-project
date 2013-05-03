<?php 
namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class StudentlistType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder->add('regNo', 'text',array('read_only'=>true));
    	$builder->add('name', 'text',array('read_only'=>true));
    	$builder->add('year', 'choice', array('choices' => array('1' => '1 Year', '2' => '2 year','3'=>'3 Year' )));
        
    }

    public function getDefaultOptions(array $options){
    	
    	return array('data_class'=>'UCSC\DatabaseBundle\Entity\Student');
    }
   

    public function getName()
    {
        return 'studentlist';
    }
}
