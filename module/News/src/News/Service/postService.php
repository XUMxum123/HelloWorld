<?php

namespace News\Service;

use News\Model\post;


class postService implements postServiceInterface {
	
	protected $data = array(
			array(
					'id'    => '1',
					'title' => 'Hello World #1',
					'content'  => 'This is our first blog post!'
			),
			array(
					'id'     => '2',
					'title' => 'Hello World #2',
					'content'  => 'This is our second blog post!'
			),
			array(
					'id'     => '3',
					'title' => 'Hello World #3',
					'content'  => 'This is our third blog post!'
			),
			array(
					'id'     => '4',
					'title' => 'Hello World #4',
					'content'  => 'This is our fourth blog post!'
			),
			array(
					'id'     => '5',
					'title' => 'Hello World #5',
					'content'  => 'This is our fifth blog post!'
			)
	);
		
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
		$model->setContent($postData['content']);
		
		return $model;
		
	}	
}

?>