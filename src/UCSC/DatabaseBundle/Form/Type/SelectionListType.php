<?php 
namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SelectionListType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder->add('courses', 'collection', array('type' => new CourseItemType()));
        $builder->add('student', 'hidden');
        
    }

    public function getDefaultOptions(array $options){
    	
    	return array('data_class' => 'UCSC\ResultBundle\Object\SelectionList');
    }
   

    public function getName()
    {
        return 'selectionlist';
    }
}
