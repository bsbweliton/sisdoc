<?php
namespace Documento\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Annotation\AnnotationBuilder;
use Doctrine\ORM\EntityManager;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineORMModule\Stdlib\Hydrator;


class DocumentoFieldset extends Fieldset implements InputFilterProviderInterface
{
	public function __construct(EntityManager $entityManager)
	{
		parent::__construct("documento");
		
		$builder = new AnnotationBuilder();
		
		$entity = new \Documento\Entity\Documento();
		
		$hydrator = new DoctrineHydrator($entityManager, $entity);
		
		$this->setHydrator($hydrator);
		
		$receptorFieldset = new ReceptorFieldset($entityManager);
		
		$this->add($receptorFieldset);
		
		$autoridadeReceptorFieldset = new AutoridadeReceptorFieldset($entityManager);
		
		$this->add($autoridadeReceptorFieldset);		
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