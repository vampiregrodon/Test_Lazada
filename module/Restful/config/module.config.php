<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'Restful\Controller\RestfulPost' => 'Restful\Controller\RestfulPostController',
            'Restful\Controller\RestfulTags' => 'Restful\Controller\RestfultagsController',
        ),
    ),
    'router' => array(
        'routes' => array(

            'RestfulPost' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/json-restful-post',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Restful\Controller',
                        'controller'    => 'RestfulPost',
                    ),
                ),
            ),

            'RestfulTags' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/json-restful-tags',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Restful\Controller',
                        'controller'    => 'RestfulTags',
                    ),
                ),
            ),

            'post' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/post',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Restful\Controller',
                        'controller'    => 'RestfulPost',
                    ),
                ),
                 
                'may_terminate' => true,
                'child_routes' => array(
                    'getByTag' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/get-list-by-tag[/:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'RestfulPost',
                                'action'     => 'getListByTag'
                            ),
                        ),
                    ),
                    'countByTag' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/count-list-by-tag[/:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'RestfulPost',
                                'action'     => 'countListByTag'
                            ),
                        ),
                    ),

                ),

            ),
        ),
    ),

    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),


);