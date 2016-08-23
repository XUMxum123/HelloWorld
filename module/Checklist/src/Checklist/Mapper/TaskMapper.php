<?php

namespace Checklist\Mapper;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Checklist\Model\TaskEntity;

class TaskMapper {

	protected $tableName = 'news';
	protected $dbAdapter;
	protected $sql;

	public function __construct(Adapter $dbAdapter)
	{
		$this->dbAdapter = $dbAdapter;
		$this->sql = new Sql($dbAdapter);
		$this->sql->setTable($this->tableName);
	}

	public function fetchAll()
	{
		$select = $this->sql->select();
		$select->order(array('id ASC', 'title ASC'));
        // select * from news order by id asc,title asc
		$statement = $this->sql->prepareStatementForSqlObject($select);
		$results = $statement->execute();

		$entityPrototype = new TaskEntity();
		$hydrator = new ClassMethods();
		$resultset = new HydratingResultSet($hydrator, $entityPrototype);
		$resultset->initialize($results);
		return $resultset;
	}

}

?>