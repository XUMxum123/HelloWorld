<?php

namespace Checklist\Model;

class NbateamEntity {

	protected $Id;  // 球队Id
	protected $Name; // 球队名字
	protected $Logo; // 球队队徽
	protected $Win; // 赢了多少场球赛
	protected $Lost; // 输了多少场球赛
	protected $Rank; // 在属于自己的联盟中的排名
	protected $Alliance; // 属于哪个联盟(East or West)
	protected $Playoffs; // 是否参加季后赛(Yes or No)
	protected $Partition; // 属于联盟的哪个分区

	public function getId() {
		return $this->Id;
	}
	public function setId($Id) {
		$this->Id = $Id;
		return $this;
	}
	public function getName() {
		return $this->Name;
	}
	public function setName($Name) {
		$this->Name = $Name;
		return $this;
	}
	public function getLogo() {
		return $this->Logo;
	}
	public function setLogo($Logo) {
		$this->Logo = $Logo;
		return $this;
	}
	public function getWin() {
		return $this->Win;
	}
	public function setWin($Win) {
		$this->Win = $Win;
		return $this;
	}
	public function getLost() {
		return $this->Lost;
	}
	public function setLost($Lost) {
		$this->Lost = $Lost;
		return $this;
	}
	public function getRank() {
		return $this->Rank;
	}
	public function setRank($Rank) {
		$this->Rank = $Rank;
		return $this;
	}
	public function getAlliance() {
		return $this->Alliance;
	}
	public function setAlliance($Alliance) {
		$this->Alliance = $Alliance;
		return $this;
	}
	public function getPlayoffs() {
		return $this->Playoffs;
	}
	public function setPlayoffs($Playoffs) {
		$this->Playoffs = $Playoffs;
		return $this;
	}
	public function getPartition() {
		return $this->Partition;
	}
	public function setPartition($Partition) {
		$this->Partition = $Partition;
		return $this;
	}
}