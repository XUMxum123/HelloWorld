<?php
namespace Checklist\Model;

class UsersEntity {

	protected $id;  // 用户的Id
	protected $newsid; // 用户添加新闻的id
	protected $nbateamid; // 用户喜欢球队的id
	protected $name; // 用户名字
	protected $sex; // 用户性别(boy or girl)
	protected $country; // 用户属于哪个国家

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getNewsid() {
		return $this->newsid;
	}
	public function setNewsid($newsid) {
		$this->newsid = $newsid;
		return $this;
	}
	public function getNbateamid() {
		return $this->nbateamid;
	}
	public function setNbateamid($nbateamid) {
		$this->nbateamid = $nbateamid;
		return $this;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getSex() {
		return $this->sex;
	}
	public function setSex($sex) {
		$this->sex = $sex;
		return $this;
	}
	public function getCountry() {
		return $this->country;
	}
	public function setCountry($country) {
		$this->country = $country;
		return $this;
	}

}