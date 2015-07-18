<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Restful\Controller;
 
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Json\Json;
use Restful\Model\Tags;
 
class RestfulTagsController extends AbstractRestfulController
{    
    private $_errorCode = 0;
    private $_message = 'Success';
    protected $tagsTable;

    public function get($id)
    {
        $arrTags = (array)$this->getTagsTable()->get($id);

        $this->responseData($arrTags);

    }

    public function getList()
    {
        $rsTags = $this->getTagsTable()->fetchAll();

        $arrTags = array();
        foreach ($rsTags as $key => $value) {
            $arrTags[] = $value;
        }

        $this->responseData($arrTags);
    }
     
    public function create($data)
    {
        if(isset($data)) {
            if(empty($data['post_id'])) {
                $this->_errorCode = 1;
                $this->_message = 'empty post id';    
            }
        } else {
            $this->_errorCode = 1;
            $this->_message = 'data not exists';
        }

        if($this->_errorCode == 0){
            $model = new Tags();
            $model->exchangeArray($data);

            $id = $this->getTagsTable()->save($model); 
            $data['id'] = $id;
        }
        
        $this->responseData($data);
    }
     
    public function update($id,$data)
    {
       if(isset($data)) {
            if(empty($data['title'])) {
                $this->_errorCode = 1;
                $this->_message = 'empty title';    
            }
        } else {
            $this->_errorCode = 1;
            $this->_message = 'data not exists';
        }

        if($this->_errorCode == 0){
            $data['id'] = $id;

            $model = new Tags();
            $model->exchangeArray($data);

            $id = $this->getTagsTable()->save($model);
        }
        
        $this->responseData($data);
    }
     
    public function delete($id)
    {
        $arrPost = array();
        $result_delete = $this->getTagsTable()->delete($id);
        if(!$result_delete){
            $this->_errorCode = 1;
            $this->_message = 'Delete Failed';
        }else{
            $this->_errorCode = 0;
            $this->_message = 'Delete Success';
        };
        
        $this->responseData($arrPost);
    }

    public function responseData($arrData = array()) {
        $data = array(
            'status' => $this->_errorCode,
            'message' => $this->_message,
            'data' => $arrData
        );

        echo Json::encode($data); die;
    }

    public function getTagsTable()
     {
         if (!$this->tagsTable) {
             $sm = $this->getServiceLocator();
             $this->tagsTable = $sm->get('Restful\Model\TagsTable');
         }
         return $this->tagsTable;
     }
}
