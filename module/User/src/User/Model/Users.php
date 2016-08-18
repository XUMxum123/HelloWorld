<?php
namespace User\Model;

class Users {
	
	public $userid;
	public $usertitle;
	public $usercontent;
	
	public function exchangeArray($data){
		$this->userid             = (isset($data['userid'])) ? $data['userid'] :null;
		$this->usertitle       = (isset($data['usertitle']))? $data['usertitle'] : null;
		$this->usercontent        =(isset($data['usercontent'])) ? $data['usercontent'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}
