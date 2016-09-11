<?php

namespace Checklist\Mapper;

//use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ClassMethods;
//use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
//use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Paginator;
//use Zend\Db\Adapter\Adapter;
//use Zend\Db\Sql\Sql;
//use Zend\Paginator\Adapter\DbSelect;
//use Zend\Db\ResultSet\ResultSet;
//use Zend\Paginator\Paginator;
//use Zend\Db\Adapter\Adapter;
//use Zend\Db\Sql\Select;
//use Zend\Db\Sql\Sql;
use Checklist\Model\UsersEntity;

class UsersTableMapper {

	protected $tableGateway;
/* 	protected $tableName; */

	protected $sql;

	public function __construct($tableGateway)
	{
/* 		$this->tableName = $tableName;
		$resultSet = new HydratingResultSet(new ClassMethods(), new UsersEntity());
		$tableGateway = new TableGateway($this->tableName, $dbAdapter, null, $resultSet); */
		$this->tableGateway = $tableGateway;

/* 		$resultSetPrototype = new ResultSet();
		$resultSetPrototype->setArrayObjectPrototype(new UsersEntity());
		$this->dbAdapter = $dbAdapter;
		$this->sql = new Sql($dbAdapter);

		$this->sql->setTable($this->tableName);
		$this->tableGateway = $tableGateway; */
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

	public function fetchAll($paginated=false)
	{
/* 		if ($paginated) {

			$select = new Select($this->tableName);
			$resultSetPrototype = new ResultSet();
			$resultSetPrototype->setArrayObjectPrototype(new UsersEntity());
		//if ($paginated) {

			//$select = new Select($this->tableName);
			//$resultSetPrototype = new ResultSet();
/* 			$resultSetPrototype->setArrayObjectPrototype(new UsersEntity());
			$paginatorAdapter = new DbSelect(
					$select,
					$this->dbAdapter,
					$resultSetPrototype
			);
			$paginator = new Paginator($paginatorAdapter);
			return $paginator;
		} */

/* 		$select = $this->sql->select();
			$paginator = new Paginator($paginatorAdapter); */
			//return $paginator;
		//}

		/*$select = $this->sql->select();
		$select->order(array('id ASC')); // array('id ASC', 'title ASC')
		// select * from news order by id asc,title asc
		$statement = $this->sql->prepareStatementForSqlObject($select);
		$results = $statement->execute();

		$entityPrototype = new UsersEntity();
		$hydrator = new ClassMethods();
		$resultset = new HydratingResultSet($hydrator, $entityPrototype);

		$resultset->initialize($results);
		$resultset->initialize($results);*/
/* 		if($paginated){
			$paginator = new Paginator($resultset);
			return $paginator;
		} */
		/*
		 * for detail, you can see http://avnpc.com/pages/advanced-database-select-usage-in-zf2
		 * */
		$where = array('id != ""');
		$order = array('id ASC','newsid DESC');
		//$group = array();
		$select = $this->tableGateway->getSql()->select();
		$select->where($where)->order($order);
		if($paginated){
			 $paginatorAdapter = new DbSelect(
                 $select,
                 $this->tableGateway->getAdapter(),
                 $this->tableGateway->getResultSetPrototype()
             );
			 $paginator = new Paginator($paginatorAdapter);
			 return $paginator;
		}else{
			$resultSet = $this->tableGateway->selectWith($select);
			return $resultSet;
			//throw new Exception\InvalidArgumentException('The table inside the provided Sql object must match the table of this TableGateway');
		}
	}

	/*
	 * return @object
	 * */
	public function getOneInfoById($id){
		$select = $this->tableGateway->getSql()->select();
		$where = array('id'=>$id);
		$select->where($where);
		$resultSet = $this->tableGateway->selectWith($select);
		//$resultSet->getColumns();
		//$result = $resultSet->toArray();
		return $resultSet;
	}

	/*
	 * return @object
	 * */
	public function getUserInfo($id)
	{
		$select = $this->tableGateway->getSql()->select();
		$where = array('id'=>$id);
		$select->where($where)->limit(1);
		$resultSet = $this->tableGateway->selectWith($select);
		return $resultSet;
/* 		$select = $this->sql->select();
		$select->where(array('id' => $id));

		$statement = $this->sql->prepareStatementForSqlObject($select);
		$result = $statement->execute()->current();
		if (!$result) {
			return null;
		}

		$hydrator = new ClassMethods();
		$task = new UsersEntity();
		$hydrator->hydrate($result, $task);

		return $task; */
	}

	public function saveTask(UsersEntity $task)
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

	public function xumsaveUsers($data){
		//$insert = $this->tableGateway->getSql()->insert();
		$result = $this->tableGateway->insert($data);
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