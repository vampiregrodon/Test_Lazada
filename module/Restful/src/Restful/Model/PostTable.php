<?php

namespace Restful\Model;
  
use Zend\Db\TableGateway\TableGateway;

 class PostTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAllCount($arrParams)
     {
         $resultSet = $this->tableGateway->select(function($select) use ($arrParams){
            if(isset($arrParams['tag'])){
                $select->join('tags', 'tags.post_id = post.id', array('name'));
                $select->where->like('tags.name', $arrParams['tag']);
            }
         });

         
         return $resultSet->count();
     }

     public function fetchAll($arrParams = array())
     {
         $resultSet = $this->tableGateway->select(function($select) use ($arrParams){
            if(isset($arrParams['tag'])){
                $select->join('tags', 'tags.post_id = post.id', array('name'));
                $select->where->like('tags.name', $arrParams['tag']);
            }
         });

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

     public function save(Post $post)
     {
         $data = array(
             
             'title'  => $post->title,
             'content' => $post->content,

         );

         $id = (int) $post->id;
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