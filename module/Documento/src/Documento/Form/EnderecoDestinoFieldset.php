<?php
namespace Documento\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Annotation\AnnotationBuilder;
use Doctrine\ORM\EntityManager;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineORMModule\Stdlib\Hydrator;

class EnderecoDestinoFieldset extends Fieldset implements InputFilterProviderInterface
{
	public function __construct(EntityManager $entityManager)
	{
		parent::__construct("receptorEnderecoDestino");
		
		$entity = new \Documento\Entity\EnderecoDestino();
		
		$builder = new AnnotationBuilder();
		
		$form = $builder->createForm($entity);
		
		foreach ($form->getElements() as $element) {
			if (method_exists($element, 'setObjectManager')) {
				$element->setObjectManager($entityManager);
				$hasEntity = true;
			} elseif (method_exists($element, 'getProxy')) {
				$proxy = $element->getProxy();
				if (method_exists($proxy, 'setObjectManager')) {
					$proxy->setObjectManager($entityManager);
					$hasEntity = true;
				}
			}
			$this->add($element);
		}					
		
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