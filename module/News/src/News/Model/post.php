<?php

namespace News\Model;

class post implements postInterface{
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var string
	 */
	protected $title;
	
	/**
	 * @var string
	 */
	protected $content;
	
	/**
	 * {@inheritDoc}
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getContent()
	{
		return $this->content;
	}
	
	/**
	 * @param string $content
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}
	
}

?>