<?php

namespace News\Controller;

use News\Service\postServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController{
	/**
	 * @var \News\Service\postServiceInterface
	 */
	protected $postService;

	public function __construct(postServiceInterface $postService)
	{
		$this->postService = $postService;
	}

	public function deleteAction()
	{
		try {
			$post = $this->postService->findPost($this->params('id'));
		 } catch (\InvalidArgumentException $e) {
		 	return $this->redirect()->toRoute('news',array('action' => 'list'),true);
		 }

		$request = $this->getRequest();

		if ($request->isPost()) {
			$del = $request->getPost('delete_confirmation', 'no');

			if ($del === 'yes') {
				$this->postService->deletePost($post);
			}

			return $this->redirect()->toRoute('news',array('action' => 'list'));
		}
/*         $view = new ViewModel();
        $view->setTemplate('news/delete/delete.phtml');
        $view->setVariable('post', $post);
		return $view; */
		return new ViewModel(array('post' => $post));
	}

}

?>