<?php

namespace News\Service;

//use News\Model\post;
use News\Mapper\postMapperInterface;
use News\Model\postInterface;

class postService implements postServiceInterface {

	/**
	 * @var \News\Mapper\postMapperInterface
	 */
	protected $postMapper;

	/**
	 * @param postMapperInterface $postMapper
	 */
	public function __construct(postMapperInterface $postMapper)
	{
		$this->postMapper = $postMapper;
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAllPosts()
	{
		// TODO: Implement findAllPosts() method.
		return $this->postMapper->findAll();
/* 		$allPosts = array();

		foreach ($this->data as $index => $post) {
			$allPosts[] = $this->findPost($index);
		}

		return $allPosts; */

	}

	/**
	 * {@inheritDoc}
	 */
	public function findPost($id)
	{
		// TODO: Implement findPost() method.
		return $this->postMapper->find($id);
/* 		$postData = $this->data[$id];

		$model = new post();
		$model->setId($postData['id']);
		$model->setTitle($postData['title']);
		$model->setContent($postData['content']);

		return $model; */

	}

	/**
	 * {@inheritDoc}
	 */
	public function savePost(postInterface $post)
	{
		return $this->postMapper->save($post);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deletePost(postInterface $post)
	{
		return $this->postMapper->delete($post);
	}

}

?>