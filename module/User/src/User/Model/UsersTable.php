<?php
namespace User\Model;

use Zend\Db\TableGateway\TableGateway;

class UsersTable {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tg)
	{
		$this->tableGateway = $tg;
	}
	
	public function fetchAll()
	{
		$resultSet  = $this->tableGateway->select();
		return $resultSet;
	}
	
	/* other sql method */
}
