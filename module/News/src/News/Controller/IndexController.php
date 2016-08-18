<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace News\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use News\Service\postServiceInterface;
use News\Form\NewsForm;
use News\Model\News;

class IndexController extends AbstractActionController
{
	protected $newsTable;
	
    public function indexAction()
    {
    	return new ViewModel(array(
    			'posts' => $this->postService->findAllPosts()
    	));    	
    	/* example */
        //echo __METHOD__;
        //$newsmodel = new NewsModel();
       // $data = $newsmodel->fetchAll('news',$where=null);
    	//var_dump($data);
        //$arr = array("name" => "xum","sex" => "男");
        //return new ViewModel();
    }
    
    public function listAction(){  
    	$paginator = $this->getNewsTable()->fetchAll(true);
    	$paginator->setCurrentPageNumber((int)$this->params()->fromRoute('page',1));
    	$paginator->setItemCountPerPage(4);
    	return new ViewModel(array('paginator'=>$paginator));   
    		
/*      $paginator = $this->getNewsTable()->fetchAll();
    	$view = new ViewModel();
    	$view->setTemplate('news/index/list.phtml');
    	$view->setVariable('paginator', $paginator);
    	$view->setVariable('table', 'myTable');
    	return $view;  */
    	
    	/*
    	 * another method *
              $paginator = $this->getNewsTalbe()->fetchAll();
              return new ViewModel(array('paginator'=>$paginator));
    	 * */
    	//var_dump($paginator);
    	//exit;
    }
    
    public function paginatorAction(){
    	$paginator = $this->getNewsTable()->fetchAll(true);
    	$paginator->setCurrentPageNumber((int)$this->params()->fromRoute('page',1));
    	$paginator->setItemCountPerPage(5);
        return new ViewModel(array('paginator'=>$paginator)); 	 
    }
    
    public function addAction(){
    	$form = new NewsForm('news');
    	$form->get('submit')->setValue('Add');
     	$request = $this->getRequest();
    	if($request->isPost()){
    		$news = new News();
    		$form->setInputFilter($news->getInputFilter());
    		$form->setData($request->getPost());
     		if($form->isValid()){
    			$news->exchangeArray($form->getData());
    			$this->getNewsTable()->saveNews($news);
    			//也可以使用URL 
    			//return $this->redirect()->toUrl('/news/list');
    			return $this->redirect()->toRoute('news',array('action' => 'list'));
    		}
    	} 
    	return array('form'=>$form);   	
    }
    
    public function editAction(){
    	$id = (string) $this->params()->fromRoute('id',0);
    	if(!$id){
    		return $this->redirect()->toRoute('news',array('action' => 'list'));
    	}
    	try{
    		$news = $this->getNewsTable()->getNewsInfoWithId($id);
    	}catch(\Exception $e){
    		return $this->redirect()->toRoute('news',array('action' => 'list'));
    	}
    	$form = new NewsForm();
    	$form->bind($news);
    	$form->get('submit')->setAttribute('value', 'Edit');
    	$request = $this->getRequest();
    	if($request->isPost()){
    		$form->setInputFilter($news->getInputFilter());
    		$form->setData($request->getPost());
    		if($form->isValid()){
    			$this->getNewsTable()->saveNews($news);
    			$this->redirect()->toUrl('/news/list');
    		}
    	}
    	return array('id'=>$id,'form'=>$form);  	
    }
    
    public function deleteAction(){
    	$id = (string) $this->params()->fromRoute('id',0);
    	if(!$id){
    		$this->redirect()->toUrl('/news/list');
    	}
    	$request = $this->getRequest();
    	if($request->isPost()){
    		// acquire input name='del' value, dedfault id No
    		$del = $request->getPost('del','No'); 
    		if($del=='Yes'){
    			$id = (string)$request->getPost('id');
    			$this->getNewsTable()->deleteNewsWithId($id);
    		}
    		$this->redirect()->toUrl('/news/list');
    	}
    	return array('id' => $id,
    			   'news' => $this->getNewsTable()->getNewsInfoWithId($id),
    			   'title' => 'delete title'
    	);    	
    }
    
    public function getNewsTable(){
    	$register_name = 'News\Model\NewsTable';
    	if(!$this->newsTable){
    		$sm = $this->getServiceLocator();
    		$this->newsTable = $sm->get($register_name);
    	}
    	return $this->newsTable;
    }
    
    /*******************************************************/
    /*      server manage     */
    /*******************************************************/
    /**
     * @var \News\Service\postServiceInterface
     */
    protected $postService;
    
    public function __construct(postServiceInterface $postService)
    {
    	$this->postService = $postService;
    }
    
    
/*     public function loginAction()
    {
    	echo __METHOD__;
    	exit; 
    }
    
    public function registerAction()
    {
    	echo __METHOD__;
    	exit;
    }
    
    public function xumAction()
    {
    	echo __METHOD__;
    	exit;
    } */
}
