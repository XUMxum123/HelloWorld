<?php

namespace News\Model;

interface postInterface {
	/**
	 * Will return the ID of the news post
	 *
	 * @return string
	 */
	public function getId();
	
	/**
	 * Will return the TITLE of the news post
	 *
	 * @return string
	*/
	public function getTitle();
	
	/**
	 * Will return the CONTENT of the news post
	 *
	 * @return string
	*/
	public function getContent();
	
}

?>