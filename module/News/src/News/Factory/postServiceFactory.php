<?php

namespace News\Factory;

use News\Service\postService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class postServiceFactory implements FactoryInterface {
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return mixed
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new postService(
				$serviceLocator->get('News\Mapper\postMapperInterface')
		);
	}
	
}

?>