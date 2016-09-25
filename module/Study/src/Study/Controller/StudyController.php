<?php
/**
 * TaskController
 *
 * @author meng.xu
 *
 * @version 1.0.0
 *
 */
namespace Study\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class StudyController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated ChecklistController::indexAction() default action
		return new ViewModel (array('xum' => "hello world"));
	}

}