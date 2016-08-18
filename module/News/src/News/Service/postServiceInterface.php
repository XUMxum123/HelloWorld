<?php

namespace News\Service;

use News\Model\PostInterface;

interface postServiceInterface {
	
	/**
	 * Should return a set of all news posts that we can iterate over. Single entries of the array are supposed to be
	 * implementing \Blog\Model\PostInterface
	 *
	 * @return array|PostInterface[]
	 */
	public function findAllPosts();
	
	/**
	 * Should return a single news post
	 *
	 * @param  int $id Identifier of the Post that should be returned
	 * @return PostInterface
	*/
	public function findPost($id);
	
}

?>