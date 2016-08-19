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
     	return new ViewModel(array(
     			'form' => $this->postForm
     	));
     }
 }
 


?>