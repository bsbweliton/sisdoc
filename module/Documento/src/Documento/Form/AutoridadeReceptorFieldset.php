<?php
namespace Documento\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Annotation\AnnotationBuilder;
use Doctrine\ORM\EntityManager;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineORMModule\Stdlib\Hydrator;

class AutoridadeReceptorFieldset extends Fieldset implements InputFilterProviderInterface
{
	public function __construct(EntityManager $entityManager)
	{
		parent::__construct("autoridadeReceptor");
		
		$builder = new AnnotationBuilder();
		
		$entity = new \Documento\Entity\AutoridadeReceptor();
		
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