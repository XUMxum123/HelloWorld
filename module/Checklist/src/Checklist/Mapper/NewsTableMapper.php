<?php

namespace Checklist\Mapper;

//use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ClassMethods;
//use Zend\Db\TableGateway\TableGateway;
//use Zend\Db\Adapter\Adapter;
//use Zend\Db\Sql\Select;
use Checklist\Model\NewsEntity;

class NewsTableMapper {

	protected $tableGateway;
	protected $tableName;

	protected $sql;

	public function __construct($tableGateway)
	{
/* 		$this->tableName = $tableName;
		$resultSet = new HydratingResultSet(new ClassMethods(), new NewsEntity());
		$tableGateway = new TableGateway($this->tableName, $dbAdapter, null, $resultSet); */
		$this->tableGateway = $tableGateway;


/* 		$this->dbAdapter = $dbAdapter;
		$this->sql = new Sql($dbAdapter);
		$this->tableName = $tableName;
		$this->sql->setTable($this->tableName); */
	}

	/** Generates an UUID
	 * @param string  an optional prefix
	 * @return string  the formatted uuid
	 */
	function uuid($prefix = ''){
		$chars = md5(uniqid(mt_rand(), true));
		$uuid  = substr($chars,0,8);
		$uuid .= substr($chars,8,4);
		$uuid .= substr($chars,12,4);
		$uuid .= substr($chars,16,4);
		$uuid .= substr($chars,20,12);
		return $prefix.$uuid;
	}

	public function fetchAll()
	{
		$where = array('id != ""');
		$order = array('id ASC');
		//$group = array();
		$select = $this->tableGateway->getSql()->select();
		$select->where($where)->order($order);
		$resultSet = $this->tableGateway->selectWith($select);
		return $resultSet;
/* 		$select = $this->sql->select();
		$select->order(array('id ASC')); // array('id ASC', 'title ASC')
        // select * from news order by id asc,title asc
		$statement = $this->sql->prepareStatementForSqlObject($select);
		$results = $statement->execute();

		$entityPrototype = new NewsEntity();
		$hydrator = new ClassMethods();
		$resultset = new HydratingResultSet($hydrator, $entityPrototype);
		$resultset->initialize($results);
		return $resultset; */
	}

	public function getNewsInfo($id)
	{
/* 		$select = $this->sql->select();
		$select->where(array('id' => $id));

		$statement = $this->sql->prepareStatementForSqlObject($select);
		$result = $statement->execute()->current();
		if (!$result) {
			return null;
		}

		$hydrator = new ClassMethods();
		$task = new NewsEntity();
		$hydrator->hydrate($result, $task);

		return $task; */

		$select = $this->tableGateway->getSql()->select();
		$where = array('id'=>$id);
		$select->where($where);
		$resultSet = $this->tableGateway->selectWith($select);
		return $resultSet;
	}

	public function saveTask(NewsEntity $task)
	{
		$hydrator = new ClassMethods();
		$data = $hydrator->extract($task);

		if ($task->getId()) {
			// update action
			$action = $this->sql->update();
			$action->set($data);
			$action->where(array('id' => $task->getId()));
		} else {
			// insert action
			$action = $this->sql->insert();
			//unset($data['id']);
			$newId = $this->uuid(); // generate ID by ourself define
			$data['id'] = $newId; // then add into $postData
			$action->values($data);
		}
		$statement = $this->sql->prepareStatementForSqlObject($action);
		$result = $statement->execute();

		if (!$task->getId()) {
			$task->setId($result->getGeneratedValue());
		}
		return $result;
	}

	public function xumsaveNews($data){
/* 		$action = $this->sql->insert();
		$action->values($data);
		$statement = $this->sql->prepareStatementForSqlObject($action);
		$result = $statement->execute(); */
		$result = $this->tableGateway->insert($data);
		return $result;
	}

	public function xumsaveEditNews($data,$id){
		$where = array('id'=>$id);
		$result = $this->tableGateway->update($data,$where);
/* 		if($result == 0){
			throw new \Exception('update error');
		} */
		return $result;
	}

	public function xumdeleteNews($id){
		$where = array('id' => $id);
		//$insert = $this->tableGateway->getSql()->insert();
		$result = $this->tableGateway->delete($where);
		/* 		$action->values($data);
		 $statement = $this->sql->prepareStatementForSqlObject($action);
		$result = $statement->execute(); */
		return $result;
	}

	public function deleteTask($id)
	{
		$delete = $this->sql->delete();
		$delete->where(array('id' => $id));

		$statement = $this->sql->prepareStatementForSqlObject($delete);
		return $statement->execute();
	}

}

?>