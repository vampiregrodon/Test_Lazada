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
use Restful\Model\Post;
 
class RestfulPostController extends AbstractRestfulController
{    
    private $_errorCode = 0;
    private $_message = 'Success';
    protected $postTable;

    public function get($id)
    {
        $arrPost = (array)$this->getPostTable()->get($id);

        $this->responseData($arrPost);

    }

    public function countListByTagAction()
    {
        $arrParams = $this->params()->fromPost();
        $count = $this->getPostTable()->fetchAllCount($arrParams);

        $arrPost = array(
                'total' => $count
            );
        
        $this->responseData($arrPost);
    }

    public function getListByTagAction()
    {
        $arrParams = $this->params()->fromPost();
        $rsPost = $this->getPostTable()->fetchAll($arrParams);

        $arrPost = array();
        foreach ($rsPost as $key => $value) {
            $arrPost[] = $value;
        }


        $this->responseData($arrPost);
    }

     
    public function getList()
    {
        $rsPost = $this->getPostTable()->fetchAll();

        $arrPost = array();
        foreach ($rsPost as $key => $value) {
            $arrPost[] = $value;
        }

        $this->responseData($arrPost);
    }
     
    public function create($data)
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
            $model = new Post();
            $model->exchangeArray($data);

            $id = $this->getPostTable()->save($model); 
            $data['id'] = $id;
        }
        
        $this->responseData($data);
    }
     
    public function update($data)
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

            $model = new Post();
            $model->exchangeArray($data);

            $id = $this->getPostTable()->save($model);
        }
        
        $this->responseData($data);
    }
     
    public function delete($id)
    {

        $arrPost = array();
        $result_delete = $this->getPostTable()->delete($id);
        if(!$result_delete){
            $this->_errorCode = 1;
            $this->_message = 'Delete Success';
        }else{
            $this->_errorCode = 1;
            $this->_message = 'Delete Failed';
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

    public function getPostTable()
     {
         if (!$this->postTable) {
             $sm = $this->getServiceLocator();
             $this->postTable = $sm->get('Restful\Model\PostTable');
         }
         return $this->postTable;
     }
}
