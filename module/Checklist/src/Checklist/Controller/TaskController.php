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

	function uuid($prefix = ''){
		$chars = md5(uniqid(mt_rand(), true));
		$uuid  = substr($chars,0,8);
		$uuid .= substr($chars,8,4);
		$uuid .= substr($chars,12,4);
		$uuid .= substr($chars,16,4);
		$uuid .= substr($chars,20,12);
		return $prefix.$uuid;
	}


	public function xumlistAction() {
		// TODO Auto-generated ChecklistController::indexAction() default action

		/* 		$function_name = "uuid";
			$prefix = "xum";
		$sub = "xyz";
		$uuid_function = $this->getCommonFunction($function_name);
		$result = $uuid_function($prefix,$sub); 'my'=>$result */
		//var_dump($config = $this->getServiceLocator()->get('Config'));die();
		$usersTableMapper = $this->getTableMapper('usersTableMapper');
		$paginator = $usersTableMapper->fetchAll(true);
		$paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
		$paginator->setItemCountPerPage(2);
		//var_dump($paginator);
/* 		var_dump($this->getServiceLocator());*/
		//die();
		return new ViewModel (array('paginator' => $paginator));
	}

	public function xumnbateam2Action(){ //[normal way]
		$nbateamId = $this->getRequest()->getQuery('id','default value');
		// 返回值是一维数组
		$nbateamInfo = $this->getTableMapper('nbateamTableMapper')->getNbateam($nbateamId);
		return new ViewModel (array('nbateamInfo' => $nbateamInfo));
	}
    // why have two method xumnbateam or xumnbateam2, because get param way different,[view helper way] and [normal way]
	public function xumnbateamAction(){ //[view helper way]
		$nbateamId = $this->params('id');
		// 返回值是一维数组
		$nbateamInfo = $this->getTableMapper('nbateamTableMapper')->getNbateam($nbateamId);
		var_dump($nbateamInfo);
		die();
		//return new ViewModel (array('nbateamInfo' => $nbateamInfo));
	}

	// obtain the parameter by [view helper way]
	public function xumnewsAction(){
		$newsId = $this->params('id');
		$newsInfo = $this->getTableMapper('newsTableMapper')->getTask($newsId);
        //var_dump($newsInfo);
		return new ViewModel (array('newsInfo' => $newsInfo));
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
		$init_sex = "boy"; // default value
		$view->setVariable('sexInfo', $sexInfo);
		$view->setVariable('init_sex', $init_sex);
		$init_country = "China"; // default value
		$view->setVariable('countryInfo', $countryInfo);
		$view->setVariable('init_country', $init_country);
		$init_nbateam = "骑士"; // default value
		$view->setVariable('init_nbateam', $init_nbateam);
		$view->setTemplate('checklist/task/xumindex.phtml');
		return $view;
	}

	public function xumeditAction(){

		$usersId = $this->params('id');
		return new ViewModel (array("usersId"=>$usersId));
	}

	public function xumdeleteAction(){
		$usersId = $this->params('id');
		return new ViewModel (array("usersId"=>$usersId));
	}

	public function xumaddAction(){
		$view = new ViewModel();
		$request = $this->getRequest();
		$params = $request->getQuery(); /* 取得所有值  */

		$newsTableMapper = $this->getTableMapper('newsTableMapper');
		$newsId = $this->uuid();
        $newsData['id'] = $newsId;
        $newsData['title'] = $request->getQuery('title','default value');
        $newsData['content'] = $request->getQuery('content','default value');
        $newsTableMapper->xumsaveNews($newsData);

        $usersTableMapper = $this->getTableMapper('usersTableMapper');
        $usersId = $this->uuid();
        $usersData['id'] = $usersId;
        $usersData['newsid'] = $newsId;
        $usersData['nbateamid'] = $request->getQuery('nbateamid','default value');
        $usersData['name'] = $request->getQuery('name','default value'); //目前name的值只支持英文和数字,不支持中文,后续会改动...
        $usersData['sex'] = $request->getQuery('sex','default value');
        $usersData['country'] = $request->getQuery('country','default value');
        $usersTableMapper->xumsaveUsers($usersData);

		//$view->setVariable('params', $params);
		//return $view;

		/*******************************************************************/
		/**************************下面操作是个人学习************************/
		/*******************************************************************/
		/*  一个一个的取值  */
		/*$params['title'] = $request->getQuery('title','default value');
		$params['content'] = $request->getQuery('content','default value');
		$params['name'] = $request->getQuery('name','default value');
		$params['sex'] = $request->getQuery('sex','default value');
		$params['country'] = $request->getQuery('country','default value');
		$params['nbateam'] = $request->getQuery('nbateam','default value'); */
		//echo $request->getBasePath()."<br />";
		//echo $request->getServer("REQUEST_URI","default value")."<br />";
		//echo $request->getUri()."<br />";
        //echo $request->getQuery("title","没有值")."<br />";
        /* foreach($request->getQuery() as $key=>$value){
        	echo $key."---".$value."<br />";
        } */
        /* foreach($request->getHeaders() as $key=>$value){
		 echo $key."---".$value."<br />";
		} */
		//echo $request->getHeaders('headersKeys');
		//var_dump($request);
		//$arr = $this->getRequest()->getPost();
		//$arr =  $this->params('title');
		//print_r((new Request())->getHeaders());
		//die();
	    /*******************************************************************/
		/**************************上面操作是个人学习************************/
		/*******************************************************************/
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
	 * We can now call getTableMapper() from within our controller whenever we need to interact with our model layer
	 * example: $mapper = $this->getTableMapper($tableName);
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