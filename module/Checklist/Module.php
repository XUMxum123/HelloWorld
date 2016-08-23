<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Checklist;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Checklist\Mapper\TaskMapper;


/**
 * @author meng.xu
 *
 */

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

    /*
     * Fixed function name--not change--- gerServiceConfig
     *
     * */
     public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'TaskMapper' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $mapper = new TaskMapper($dbAdapter);
                     return $mapper;
                 }
             ),
         );
     }
}
