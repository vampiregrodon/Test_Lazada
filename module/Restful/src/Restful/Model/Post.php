<?php

namespace Restful\Model;
  
  
/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Name("User")
 */
class Post
{
    
     public $id;
     public $title;
     public $content;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->title  = (!empty($data['title'])) ? $data['title'] : null;
         $this->content = (!empty($data['content'])) ? $data['content'] : null;
     }

}