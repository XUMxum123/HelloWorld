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
	 * @return array|postInterface[]
	*/
	public function findAll();

	/**
	 * @param postInterface $postObject
	 *
	 * @param postInterface $postObject
	 * @return postInterface
	 * @throws \Exception
	 */
	public function save(postInterface $postObject);

	/**
	 * @param postInterface $postObject
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function delete(postInterface $postObject);


}

?>