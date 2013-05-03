<?php 
namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ResultSheetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder->add('results', 'collection', array('type' => new ResultType()));
        $builder->add('course', 'hidden');
        $builder->add('year', 'hidden');
        //$builder->add('count', 'hidden');
        
    }

    public function getDefaultOptions(array $options){
    	
    	return array('data_class' => 'UCSC\ResultBundle\Object\ResultSheet');
    }
   

    public function getName()
    {
        return 'resultsheet';
    }
}
