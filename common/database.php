<?php
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;
use Zend\XmlRpc\Value\String;


class database {
	
	protected $adapter;
	protected $table;
	/**
	 * 构造函数
	 * @param String $table  操作的数据表名
	 * @param Array $config 数据库连接配置
	 */
	public function __construct($table=null)
	{
		$config = array(
					'driver'=>'Pdo_Mysql',  // 驱动类型
					'database'=>'test',     // 数据库
					'hostname'=>'localhost', // 服务器地址
					'username'=>'root',      // 用户名
					'password'=>'1332080218' // 密码
		        );
		$this->adapter = new Adapter($config);
 		//throw new \Exception("Could not find database config");
		if($table==null){
				throw new \Exception("Could not find table");
	    }else{
	    	$this->table = $table;
	    }			
	}
	 
	/**
	 * 返回查询结果的第一行数据
	 * @param String $where   查询条件
	 * @return Array
	 */
	public function fetchRow($where=null){
		$sql = "SELECT * FROM {$this->table}";
		if($where!=null) $sql .= "WHERE {$where}";
		$statement = $this->adapter->createStatement($sql);
		$result = $statement->execute();
		return $result->current();
	}
	 
	/**
	 * 返回查询的所有结果
	 * @param String $where 查询条件
	 * @return Array
	 */
	public function fetchAll($where=null){
		$sql = "SELECT * FROM {$this->table}";
		if($where!=null) $sql .= "WHERE {$where}";
		$stmt = $this->adapter->createStatement($sql);
		$stmt->prepare();
		$result = $stmt->execute();
		 
		$resultset = new ResultSet;
		$resultset->initialize($result);
		$rows = array();
		$rows = $resultset->toArray();
		return $rows;
	}
	 
	/**
	 * 返回该表的所有数据
	 * @return Array
	 */
	public function getTableRecords()
	{
		$sql = new Sql($this->adapter);
		$select = $sql->select();
		$select->from($this->table);
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();
		$resultSet = new ResultSet();
		$resultSet->initialize($result);
		return $resultSet->toArray();
	}
	 
	/**
	 * 插入数据到数据表
	 * @param String $table
	 * @param Array $data
	 * @return Int 返回受影响的行数
	 */
	public function insert($table,$data){
		$sql = new Sql($this->adapter);
		$insert=$sql->insert($this->table);
		$insert->values($data);
		return $sql->prepareStatementForSqlObject($insert)->execute()->getAffectedRows();
	}
	 
	/**
	 * 更新数据表
	 * @param String $data   需要更新的数据
	 * @param String|Array $where  更新条件
	 * @return Int 返回受影响的行数
	 */
	public function update($data,$where){
		$sql = new Sql($this->adapter);
		$update=$sql->update($this->table);
		$update->set($data);
		$update->where($where);
		return $sql->prepareStatementForSqlObject($update)->execute()->getAffectedRows();
	}
	 
	/**
	 * 删除数据
	 * @param String|Array $where 删除条件
	 * @return Int 返回受影响的行数
	 */
	public function delete($where){
		$sql = new Sql($this->adapter);
		$delete = $sql->delete($this->table)->where($where);
		return $sql->prepareStatementForSqlObject($delete)->execute()->getAffectedRows();
	}
	 
	/**
	 * 返回最后插入的主键值
	 * @return Int
	 */
	public function lastInsertId(){
		return $this->adapter->getDriver()->getLastGeneratedValue();
	}
}


