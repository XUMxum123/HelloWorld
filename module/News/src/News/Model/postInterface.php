<?php

namespace News\Model;

interface postInterface {
	/**
	 * Will return the ID of the news post
	 * @return string
	 */
	public function getId();
	
	/**
	 * Will set the ID of the news post
	 * @return string
	 */
	public function setId($Id);
	
	/**
	 * Will return the TITLE of the news post
	 * @return string
	*/
	public function getTitle();
	
	/**
	 * Will set the TITLE of the news post
	 * @return string
	 */
	public function setTitle($title);
	
	/**
	 * Will return the CONTENT of the news post
	 * @return string
	*/
	public function getContent();
		
	/**
	 * Will set the CONTENT of the news post
	 * @return string
	*/
	public function setContent($content);
	
}

?>