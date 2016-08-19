<?php

namespace News\Mapper;

use News\Model\postInterface;

interface postMapperInterface {
	/**
	 * @param int|string $id
	 * @return postInterface
	 * @throws \InvalidArgumentException
	 */
	public function find($id);
	
	/**
	 * @return array|PostInterface[]
	*/
	public function findAll();
	
}

?>