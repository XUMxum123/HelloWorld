<?php

namespace News\Service;

use News\Model\postInterface;

interface postServiceInterface {

	/**
	 * Should return a set of all news posts that we can iterate over. Single entries of the array are supposed to be
	 * implementing \News\Model\postInterface
	 *
	 * @return array|PostInterface[]
	 */
	public function findAllPosts();

	/**
	 * Should return a single news post
	 *
	 * @param  string $id Identifier of the Post that should be returned
	 * @return postInterface
	*/
	public function findPost($id);

	/**
	 * Should save a given implementation of the postInterface and return it. If it is an existing Post the Post
	 * should be updated, if it's a new Post it should be created.
	 *
	 * @param  postInterface $news
	 * @return postInterface
	 */
	public function savePost(postInterface $news);

	/**
	 * Should delete a given implementation of the PostInterface and return true if the deletion has been
	 * successful or false if not.
	 *
	 * @param  postInterface $news
	 * @return bool
	 */
	public function deletePost(postInterface $news);

}

?>