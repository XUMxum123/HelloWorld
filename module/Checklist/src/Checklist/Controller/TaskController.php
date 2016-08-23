<?php

namespace Checklist\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * TaskController
 *
 * @author meng.xu
 *
 * @version 1.0.0
 *
 */
class TaskController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated ChecklistController::indexAction() default action
		$mapper = $this->getTaskMapper();
		return new ViewModel (array('tasks' => $mapper->fetchAll()));
	}

	/**
	 * The add action - add a task
	 */
	public function addAction(){
		return new ViewModel ();
	}

	/**
	 * The edit action - edit a task
	 */
	public function editAction(){
		return new ViewModel ();
	}

	/**
	 * The delete action - delete a task
	 */
	public function deleteAction(){
		return new ViewModel ();
	}

	/**
	 * We can now call getTaskMapper() from within our controller whenever we need to interact with our model layer
	 * example: $mapper = $this->getTaskMapper();
	 */
	public function getTaskMapper()
	{
		$sm = $this->getServiceLocator();
		return $sm->get('TaskMapper');
	}
}