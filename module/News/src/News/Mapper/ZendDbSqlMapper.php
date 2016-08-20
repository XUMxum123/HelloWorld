<?php

namespace News\Mapper;

use News\Model\postInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Delete;

class ZendDbSqlMapper implements postMapperInterface{
     /**
      * @var \Zend\Db\Adapter\AdapterInterface
      */
     protected $dbAdapter;

     /**
      * @var \Zend\Stdlib\Hydrator\HydratorInterface
      */
     protected $hydrator;

     /**
      * @var \Blog\Model\PostInterface
      */
     protected $postPrototype;

     /**
      * @param AdapterInterface  $dbAdapter
      * @param HydratorInterface $hydrator
      * @param PostInterface    $postPrototype
      */
     public function __construct(
         AdapterInterface $dbAdapter,
         HydratorInterface $hydrator,
         postInterface $postPrototype
     ) {
         $this->dbAdapter      = $dbAdapter;
         $this->hydrator       = $hydrator;
         $this->postPrototype  = $postPrototype;
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

	/**
	 * @param int|string $id
	 *
	 * @return PostInterface
	 * @throws \InvalidArgumentException
	 */
	public function find($id)
	{
		$sql    = new Sql($this->dbAdapter);
		$select = $sql->select('news'); // news is table name
		$where = array('id = ?' => $id);
		$select->where($where);

		$stmt   = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();

		if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
			return $this->hydrator->hydrate($result->current(), $this->postPrototype);
		}

		throw new \InvalidArgumentException("News with given ID:{$id} not found.");
	}

	/**
	 * @return array|PostInterface[]
	 */
	public function findAll()
	{
        $sql    = new Sql($this->dbAdapter);
         $select = $sql->select('news'); // news is table name

         $stmt   = $sql->prepareStatementForSqlObject($select);
         $result = $stmt->execute();

         if ($result instanceof ResultInterface && $result->isQueryResult()) {
             $resultSet = new HydratingResultSet(new \Zend\Stdlib\Hydrator\ClassMethods(), new \News\Model\post());

             return $resultSet->initialize($result);
         }

         return array();
	}

	/**
	 * @param postInterface $postObject
	 *
	 * @return postInterface
	 * @throws \Exception
	 */
	public function save(postInterface $postObject)
	{
		$postData = $this->hydrator->extract($postObject);
		unset($postData['id']); // Neither Insert nor Update needs the ID in the array

		var_dump($postObject->getId());
		if ($postObject->getId()) {
			// ID present, it's an Update
			$action = new Update('news'); // news is table name
			$action->set($postData);
			$where = array('id = ?' => $postObject->getId());
			$action->where($where);
		} else {
			// ID NOT present, it's an Insert
			$newId = $this->uuid(); // generate ID by ourself define
			$postData['id'] = $newId; // then add into $postData
			$action = new Insert('news'); // news is table name
			$action->values($postData);
		}

		$sql    = new Sql($this->dbAdapter);
		$stmt   = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();

		if ($result instanceof ResultInterface) {
			$newId = $result->getGeneratedValue();
			if ($newId) {
				// When a value has been generated, set it on the object
				$postObject->setId($newId);
			}

			return $postObject;
		}

		throw new \Exception("Database error");
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete(postInterface $postObject)
	{
		$action = new Delete('news'); // news is table name
		$where = array('id = ?' => $postObject->getId());
		$action->where($where);

		$sql    = new Sql($this->dbAdapter);
		$stmt   = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();

		return (bool)$result->getAffectedRows();
	}

}

?>