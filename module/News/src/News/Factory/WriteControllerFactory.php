<?php

namespace News\Factory;

use News\Controller\WriteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WriteControllerFactory implements FactoryInterface {
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$realServiceLocator = $serviceLocator->getServiceLocator();
		$postService        = $realServiceLocator->get('News\Service\postServiceInterface');
		$postInsertForm     = $realServiceLocator->get('FormElementManager')->get('News\Form\postForm');
	
		return new WriteController(
				$postService,
				$postInsertForm
		);
	}
}

?>