<?php 
namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class StudentSheetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

       $builder->add('students', 'collection', array('type' => new StudentlistType()));
        
    }

    public function getDefaultOptions(array $options){
    	
    	return array('data_class' => 'UCSC\RegistrationBundle\Object\StudentSheet');
    }
   

    public function getName()
    {
        return 'studentsheet';
    }
}
