<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Restful;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Restful\Model\Post;
use Restful\Model\PostTable;
use Restful\Model\Tags;
use Restful\Model\TagsTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
     {
         return array(
             'factories' => array(

                 'Restful\Model\PostTable' =>  function($sm) {
                     $tableGateway = $sm->get('PostTableGateway');
                     $table = new PostTable($tableGateway);
                     return $table;
                 },
                 'PostTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Post());
                     return new TableGateway('post', $dbAdapter, null, $resultSetPrototype);
                 },

                 'Restful\Model\TagsTable' =>  function($sm) {
                     $tableGateway = $sm->get('TagsTableGateway');
                     $table = new TagsTable($tableGateway);
                     return $table;
                 },
                 'TagsTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Tags());
                     return new TableGateway('tags', $dbAdapter, null, $resultSetPrototype);
                 },

             ),
         );
     }
}
