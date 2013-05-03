<?php 
namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SelectionList2Type extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder->add('courses', 'collection', array('type' => new CourseItem2Type()));
        
    }

    public function getDefaultOptions(array $options){
    	
    	return array('data_class' => 'UCSC\ResultBundle\Object\SelectionList2');
    }
   

    public function getName()
    {
        return 'selectionlist';
    }
}
