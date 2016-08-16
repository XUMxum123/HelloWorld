<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        echo __METHOD__;
        $arr = array("name" => "xum","sex" => "男");
        return new ViewModel($arr);
    }
    
    public function loginAction()
    {
    	echo __METHOD__;
    }
    
    public function registerAction()
    {
    	echo __METHOD__;
    }
    
    public function xumAction()
    {
    	echo __METHOD__;
    }
}
