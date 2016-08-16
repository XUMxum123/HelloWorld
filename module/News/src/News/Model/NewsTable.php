<?php
namespace News\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class NewsTable {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tg){
		$this->tableGateway = $tg;
	}
	
	public function fetchAll($paginated=false){
		if($paginated){
			$select = new Select('news');
			$rs = new ResultSet();
			$rs->setArrayObjectPrototype(new News());
			$pageAdapter = new DbSelect($select,$this->tableGateway->getAdapter(),$rs);
			$paginator = new Paginator($pageAdapter);
			return $paginator;
		}		
		$resultSet  = $this->tableGateway->select();
		return $resultSet;
	}
	
	public function getNewsInfoWithId($id)
	{
		$id  = (string) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row {$id} select error");
		}
		return $row;
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
	
   /** Save or Update
	 * @param object  what data to save or update
	 */
	public function saveNews(News $news)
	{
		$data = array(
				'content' => $news->content,
				'title' => $news->title
		);
		$id = (string)$news->id;
		if($id == null){ // save
			//$tableId = (int)mt_rand('1000000001','9999999999');
			$tableId = $this->uuid();
			$data['id'] = $tableId; 
			$this->tableGateway->insert($data);
		}else{ // update
			if($this->getNewsInfoWithId($id)){
				$this->tableGateway->update($data,array('id'=>$id));
			}else{
				throw new \Exception("Could not find row {$id} update error");
			}
		}
	}
	
	/** delete
	 * @param string  the delete record of id
	 */
	public function deleteNewsWithId($id)
	{
		$this->tableGateway->delete(array('id'=>$id));
	}
	
	
}