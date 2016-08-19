<?php

namespace News\Controller;

use News\Service\postServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

 class WriteController extends AbstractActionController
 {
     protected $postService;

     protected $postForm;

     public function __construct(
         postServiceInterface $postService,
         FormInterface $postForm
     ) {
         $this->postService = $postService;
         $this->postForm    = $postForm;
     }

     public function addAction()
     {
     $request = $this->getRequest();

         if ($request->isPost()) {
             $this->postForm->setData($request->getPost());

             if ($this->postForm->isValid()) {
                 try {
                 	// \Zend\Debug\Debug::dump($this->postForm->getData());die(); // debug what you post data
                 	$this->postService->savePost($this->postForm->getData());
                     return $this->redirect()->toRoute('news',array('action' => 'list'));
                     //return $this->redirect()->toUrl('/news/list');
                 } catch (\Exception $e) {
                 	// Some DB Error happened, log it and let the user know
                 	throw new \Exception("Could not save data or update data! Please check the result!");
                 	//echo $e;                     
                 }
             }
         }

         return new ViewModel(array(
             'form' => $this->postForm
         ));
     }    
 }
 


?>