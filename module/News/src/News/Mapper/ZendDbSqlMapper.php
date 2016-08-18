<?php

namespace News\Mapper;

use News\Model\postInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Sql;

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
         PostInterface $postPrototype
     ) {
         $this->dbAdapter      = $dbAdapter;
         $this->hydrator       = $hydrator;
         $this->postPrototype  = $postPrototype;
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
		$select->where(array('id = ?' => $id));
		
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
	
}

?>