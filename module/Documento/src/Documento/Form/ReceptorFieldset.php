<?php
namespace Documento\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Annotation\AnnotationBuilder;
use Doctrine\ORM\EntityManager;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineORMModule\Stdlib\Hydrator;

class ReceptorFieldset extends Fieldset implements InputFilterProviderInterface
{
	public function __construct(EntityManager $entityManager)
	{
		parent::__construct("receptor");
		
		$builder = new AnnotationBuilder();
		
		$entity = new \Documento\Entity\Receptor();
		
		$hydrator = new DoctrineHydrator($entityManager, $entity);
		
		$this->setHydrator($hydrator);
	}	
	/**
	 * Define InputFilterSpecifications
	 *
	 * @access public
	 * @return array
	 */
	public function getInputFilterSpecification()
	{
		return array();
	}	
}