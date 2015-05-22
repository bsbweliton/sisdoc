<?php

/**
 * namespace de localizacao do nosso formulario
 */
namespace Documento\Form;

// import Form
use Zend\Form\Form;
// import Element
use Zend\Form\Element;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Annotation\AnnotationBuilder;
use Doctrine\ORM\EntityManager;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineORMModule\Stdlib\Hydrator;


class DocumentoForm extends Form 
{

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct("documentoForm");                        
        
        /*$fieldset = $builder->createForm( $entity ) ;
        
        foreach ($fieldset->getElements() as $element) {
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
        } */ 
        //$this->setName("documento");
        
        $entity = new \Documento\Entity\Documento();
        
        $this->setUseAsBaseFieldset(true);
        
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
        	die(var_dump($this->getInputFilter()));
        }        
        
        /*$hydrator = new DoctrineHydrator($entityManager, $entity);        
        
        $this->setHydrator($hydrator);*/  
        
		$hydrator = new DoctrineHydrator($entityManager, $entity);
		
		$this->setHydrator($hydrator);		
		
		$receptorFieldset = new ReceptorFieldset($entityManager);
		
		$this->add($receptorFieldset);
		
		$autoridadeReceptorFieldset = new AutoridadeReceptorFieldset($entityManager);
		
		$this->add($autoridadeReceptorFieldset);	
				              		
		
		$receptorFieldset = new ReceptorFieldset($entityManager);
		
		$this->add($receptorFieldset);
		
		$autoridadeReceptorFieldset = new AutoridadeReceptorFieldset($entityManager);
		
		$this->add($autoridadeReceptorFieldset);
		      
        
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'docrecebido',
				'attributes' => array(
						'id'            => 'docrecebido',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'corpodocvis',
				'attributes' => array(
						'id'            => 'corpodocvis',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'cabecalhohidden',
				'attributes' => array(
						'id'            => 'cabecalhohidden',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'corposemformat',
				'attributes' => array(
						'id'            => 'corposemformat',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'tipodestinogrupo',
				'attributes' => array(
						'id'            => 'tipodestinogrupo',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'iddoc',
				'attributes' => array(
						'id'            => 'iddoc',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'idreceptor',
				'attributes' => array(
						'id'            => 'idreceptor',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'idautoridadereceptor',
				'attributes' => array(
						'id'            => 'idautoridadereceptor',
				),
		));		
		
		// elemento do tipo text
		$this->add(array(
				'type' => 'Text', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'nomeemis',				
				'attributes' => array(
						'id'            => 'nomeemis',
						'class' => 'form-control'
				),
				'options' => array(
						'label' => 'Nome',
				),				
		));		
		
		// elemento do tipo select
		$this->add(array(
				'type' => 'Select', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'cargoemis',				
				'attributes' => array(
						'id'            => 'cargoemis',
						'class' => 'form-control'
				),
	            'options' => array(
	                'label' => 'Cargo',
	                'value_options' => array(
	                    '0' => 'Chefe de Núcleo',
	                    '1' => 'Gerente',
	                    '2' => 'Diretor',
	                ),
	            ),
		));		
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Csrf',
				'name' => 'csrf'
		));

		$this->add(array(
				'type' => 'Button',
				'name' => 'visualizar',
				'attributes' => array(
						
						'value' => 'visualizar',
						'class' => 'btn btn-primary',
				),
				'options' => array(
						'label'   => 'Visualizar',
						'icon'    => '<i class="icon icon-foo">',
				),
		));		
		
		$this->add(array(
				'type' => 'Submit',
				'name' => 'submit',
				'attributes' => array(
						'value' => 'Save',
						'class' => 'btn btn-success',
				),
				'options' => array(
						'label'   => 'Salvar',
						'icon'    => '<i class="icon icon-foo">',
				),
		));		
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
