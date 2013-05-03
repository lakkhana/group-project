<?php 
namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EventType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder->add('title', 'text');
        $builder->add('startdate', 'datetime', array('input'=>'timestamp','widget'=>'single_text'));
        $builder->add('enddate', 'datetime', array('input'=>'timestamp','widget'=>'single_text'));
        
    }

    public function getDefaultOptions(array $options){
    	
    	return array('data_class' => 'UCSC\EventCalendarBundle\Object\Event');
    }
   

    public function getName()
    {
        return 'event';
    }
}
