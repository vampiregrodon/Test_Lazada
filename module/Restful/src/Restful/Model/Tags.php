<?php

namespace Restful\Model;
  
  
/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Name("User")
 */
class Tags
{
    
     public $id;
     public $post_id;
     public $name;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->post_id     = (!empty($data['post_id'])) ? $data['post_id'] : null;
         $this->name  = (!empty($data['name'])) ? $data['name'] : null;
         
     }

}