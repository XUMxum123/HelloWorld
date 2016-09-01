<?php
/**
 * TaskController
 *
 * @author meng.xu
 *
 * @version 1.0.0
 *
 */
namespace Checklist\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Checklist\Model\NewsEntity;
use Checklist\Form\TaskForm;

//require_once '/common/function.php';

class TaskController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated ChecklistController::indexAction() default action

/* 		$function_name = "uuid";
		$prefix = "xum";
		$sub = "xyz";
		$uuid_function = $this->getCommonFunction($function_name);
        $result = $uuid_function($prefix,$sub); 'my'=>$result */
        //var_dump($config = $this->getServiceLocator()->get('Config'));die();
		$newsTableMapper = $this->getServiceLocator()->get('newsTableMapper');
		return new ViewModel (array('tasks' => $newsTableMapper->fetchAll()));
	}

	/**
	 * The add action - add a task
	 */
	public function addAction(){
		$form = new TaskForm();
		$task = new NewsEntity();
		$form->bind($task);

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getTableMapper('newsTableMapper')->saveTask($task);

				// Redirect to list of tasks
				// return $this->redirect()->toUrl('/checklist/index');
				return $this->redirect()->toRoute('task');
			}
		}

		return array('form' => $form);
		//return new ViewModel ();
	}

	/**
	 * The edit action - edit a task
	 */
	public function editAction(){
		$id = (int)$this->params('id');
		if (!$id) {
			return $this->redirect()->toRoute('task');
		}
		$task = $this->getTableMapper('newsTableMapper')->getTask($id);

		$form = new TaskForm();
		$form->bind($task);

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getTableMapper('newsTableMapper')->saveTask($task);

				return $this->redirect()->toRoute('task');
			}
		}

		return array(
				'id' => $id,
				'form' => $form,
		);
		//return new ViewModel ();
	}

	/**
	 * The delete action - delete a task
	 */
	public function deleteAction(){
		$id = $this->params('id');
		$task = $this->getTableMapper('newsTableMapper')->getTask($id);
		if (!$task) {
			return $this->redirect()->toRoute('task');
		}

		$request = $this->getRequest();
		if ($request->isPost()) {
			if ($request->getPost()->get('del') == 'Yes') {
				$this->getTableMapper('newsTableMapper')->deleteTask($id);
			}

			return $this->redirect()->toRoute('task');
		}

		return array(
				'id' => $id,
				'task' => $task
		);
		//return new ViewModel ();
	}

	/*
	 * add xumindex and xumadd method, in order to study multi-table operate
	 * */
	public function xumindexAction(){
		$view = new ViewModel();
		$nbateamTableMapper = $this->getTableMapper('nbateamTableMapper');
		$nbateamInfo = $nbateamTableMapper->fetchAll();
		//var_dump($nbateamInfo);
		//die();
		$view->setVariable('nbateamInfo', $nbateamInfo);
		$sexInfo = array("boy","girl");
		$countryInfo = array("America","China","France","German");
		$init_sex = "boy";
		$view->setVariable('sexInfo', $sexInfo);
		$view->setVariable('init_sex', $init_sex);
		$init_country = "China";
		$view->setVariable('countryInfo', $countryInfo);
		$view->setVariable('init_country', $init_country);
		$init_nbateam = "骑士";
		$view->setVariable('init_nbateam', $init_nbateam);
		$view->setTemplate('checklist/task/xumindex.phtml');
		return $view;
	}

	public function xumaddAction(){
		$view = new ViewModel();
		$params['title'] = $this->params('title');
		$params['content'] = $this->params('content');
		$params['name'] = $this->params('name');
		$params['sex'] = $this->params('sex');
		$params['country'] = $this->params('country');
		$params['nbateam'] = $this->params('nbateam');
		//$arr = $this->getRequest()->getPost();
		//$arr =  $this->params('title');
		$request = $this->getRequest();
		//$view->setVariable('params', $params);
		//var_dump($request);
		print_r($request);
		//$view->setVariable('title', $this->params('title'));
		//return $view;
	}

    /*
     * maybe not used in future
     * */
/* 	public function getCommonFunction($functionName)
	{
		$config = $this->getServiceLocator()->get('Config');
		$function = $config['common_function']['function'][$functionName];
		return $function;
	} */

	/**
	 * We can now call getNewsTableMapper() from within our controller whenever we need to interact with our model layer
	 * example: $mapper = $this->getNewsTableMapper($tableName);
	 */

	public function getTableMapper($tableTableMapper){
        return $this->getServiceLocator()->get($tableTableMapper);
	}

/* 	public function getNewsTableMapper($tableName)
	{
		$sm = $this->getServiceLocator();
		$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		$mapper = new TableMapper($dbAdapter,$tableName);
		return $mapper;
		//return $sm->get('TableMapper');
	} */
}