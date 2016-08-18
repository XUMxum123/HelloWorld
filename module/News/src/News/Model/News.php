<?php
namespace News\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class News implements InputFilterAwareInterface {
	
	public $id;
	public $title;
	public $content;
	protected $inputFilter;

	public function exchangeArray($data){
		$this->id          = (isset($data['id'])) ? $data['id'] :null;
		$this->title       = (isset($data['title']))? $data['title'] : null;
		$this->content     = (isset($data['content'])) ? $data['content'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
	
	// 牵一发而动全身
	public function getInputFilter() {
		if(!$this->inputFilter){
			$this->inputFilter = new InputFilter();
			$factory           = new InputFactory();
/* 			$this->inputFilter->add($factory->createInput(array(
					'name'=>'id',
					'required'=>true,
 					'filters'=>array(
							//array('name'=>'Char'),
 							array('name'=>'NotEmpty')
					), 
			))); */
			 
			$this->inputFilter->add($factory->createInput(array(
					'name'=>'content',
					'required'=>true,
					'filters'=>array(
							array('name'=>'StripTags'),
							array('name'=>'StringTrim'),
					),
					'validators'=>array(
							array(
									'name'=>'StringLength',
									'options'=>array(
											'encoding'=>'UTF-8',
											'min'=>5,
											'max'=>1000,
									),
							),
					),
			)));
			 
			$this->inputFilter->add($factory->createInput(array(
					'name'=>'title',
					'required'=>true,
					'filters'=>array(
							array('name'=>'StripTags'),
							array('name'=>'StringTrim'),
					),
					'validators'=>array(
							array(
									'name'=>'StringLength',
									'options'=>array(
											'encoding'=>'UTF-8',
											'min'=>3,
											'max'=>100,
									),
							),
					),
			)));
		}
		return $this->inputFilter;
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter) {// 新添加，实现接口方法
		throw new \Exception('Not used');
	}
		
}