<?php

namespace News\Service;

use News\Model\post;


class postService implements postServiceInterface {
	/**
	 * {@inheritDoc}
	 */
	public function findAllPosts()
	{
		// TODO: Implement findAllPosts() method.
		$allPosts = array();
		
		foreach ($this->data as $index => $post) {
			$allPosts[] = $this->findPost($index);
		}
		
		return $allPosts;
		
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function findPost($id)
	{
		// TODO: Implement findPost() method.
		$postData = $this->data[$id];
		
		$model = new post();
		$model->setId($postData['id']);
		$model->setTitle($postData['title']);
		$model->setText($postData['content']);
		
		return $model;
		
	}	
}

?>