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
use Checklist\Model\TaskEntity;
use Checklist\Form\TaskForm;
use Checklist\Mapper\TableMapper;

//require_once '/common/function.php';

class TaskController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated ChecklistController::indexAction() default action

		$function_name = "uuid";
		$parameter = array(
            "xyz",  "xum"
		);
		$result = $this->getCommonFunction($function_name,$parameter);
        //var_dump($my);//die();
		$mapper = $this->getTableMapper('news');
		return new ViewModel (array('tasks' => $mapper->fetchAll(),'my'=>$result));
	}

	/**
	 * The add action - add a task
	 */
	public function addAction(){
		$form = new TaskForm();
		$task = new TaskEntity();
		$form->bind($task);

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getTableMapper('news')->saveTask($task);

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
		$task = $this->getTableMapper('news')->getTask($id);

		$form = new TaskForm();
		$form->bind($task);

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getTableMapper('news')->saveTask($task);

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
		$task = $this->getTableMapper('news')->getTask($id);
		if (!$task) {
			return $this->redirect()->toRoute('task');
		}

		$request = $this->getRequest();
		if ($request->isPost()) {
			if ($request->getPost()->get('del') == 'Yes') {
				$this->getTableMapper('news')->deleteTask($id);
			}

			return $this->redirect()->toRoute('task');
		}

		return array(
				'id' => $id,
				'task' => $task
		);
		//return new ViewModel ();
	}


	public function getCommonFunction($function_name,$parameter=null)
	{
		$para = ",";
		if($parameter != null){
           foreach($parameter as $key=>$value){
           	//print_r($key."}".$value);
                $para = $para."'".$value."'".",";
           }
           $para = trim($para,",");
		}
		print_r($para);
		$config = $this->getServiceLocator()->get('Config');
		$result = $config['common_function']['function'][$function_name]('xum','xyz');
		return $result;
	}

	/**
	 * We can now call getTaskMapper() from within our controller whenever we need to interact with our model layer
	 * example: $mapper = $this->getTableMapper($tableName);
	 */
	public function getTableMapper($tableName)
	{
		$sm = $this->getServiceLocator();
		$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		$mapper = new TableMapper($dbAdapter,$tableName);
		return $mapper;
		//return $sm->get('TableMapper');
	}
}