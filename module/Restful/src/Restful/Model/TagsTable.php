<?php

namespace Restful\Model;
  
use Zend\Db\TableGateway\TableGateway;

 class TagsTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

    
    public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();

         return $resultSet;
     }

     public function get($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function save(Tags $tags)
     {
         $data = array(
             
             'post_id'  => $tags->post_id,
             'name' => $tags->name,

         );

         $id = (int) $tags->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
             $id = $this->tableGateway->lastInsertValue;
         } else {
             if ($this->get($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Id does not exist');
             }
         }
         return $id;
     }

     public function delete($id)
     {
         return $this->tableGateway->delete(array('id' => (int) $id));
         
     }
 }