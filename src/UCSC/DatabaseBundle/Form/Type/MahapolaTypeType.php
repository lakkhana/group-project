<?php


namespace UCSC\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class MahapolaTypeType extends AbstractType {

	/**
	 * @param FormBuilder $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilder $builder, array $options) {

		$builder->add('Type','text');
		$builder->add('Amount','integer');

	}


	public function getDefaultOptions(array $options)
	{
		return array('data_class'=>'UCSC\DatabaseBundle\Entity\MahapolaType');
	}

	public function getName()
	{
		return 'MahapolaType';
	}

}
