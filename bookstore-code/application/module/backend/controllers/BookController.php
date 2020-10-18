<?php
class BookController extends BackendController
{

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
	}

	// ACTION: LIST BOOK
	public function indexAction()
	{
		$this->_view->_title 		= ucfirst($this->_controllerName) . ' Manager :: List';
		
		// Pagination
		$totalItems				  	= $this->_model->countItems($this->_arrParam);
		$configPagination = ['totalItemsPerPage' => ITEM_PER_PAGE, 'pageRange' => PAGE_RANGE];
		$this->setPagination($configPagination);
		$this->_view->pagination  	= new Pagination($totalItems, $this->_pagination);

		// Page Error
		$page = $this->_view->arrParam['page'];
		$totalItemsPerPage = $this->_view->arrParam['pagination']['totalItemsPerPage'];
		HTML_Frontend::pageError($page, $totalItems, $totalItemsPerPage, $this->_moduleName, $this->_controllerName, $this->_actionName);		

		// Items
		$this->_view->countActive   	= $this->_model->countItems($this->_arrParam, ['task' => 'count-active']);
		$this->_view->countInactive 	= $this->_model->countItems($this->_arrParam, ['task' => 'count-inactive']);
		$this->_view->filterCategory	= $this->_model->itemInSelectbox($this->_arrParam);
		$this->_view->Items 			= $this->_model->listItems($this->_arrParam);

		$this->_view->render("{$this->_controllerName}/index");
	}

	// ACTION: ADD & EDIT BOOK
	public function formAction()
	{
		$this->_view->_title = ucfirst($this->_controllerName) . ' Manager :: Add';
		$this->_view->filterCategory 	= $this->_model->itemInSelectbox($this->_arrParam);

		if(!empty($_FILES)) {
			$this->_arrParam['form']['picture'] = $_FILES['picture'];
			$this->_validate->setSourceElement('picture', $_FILES['picture']);
		}

		if (isset($this->_arrParam['id']) && !isset($this->_arrParam['form']['token'])) {
			$this->_view->_title = ucfirst($this->_controllerName) . ' Manager :: Edit';
			$this->_arrParam['form'] = $this->_model->infoItems($this->_arrParam);
			if (empty($this->_arrParam['form'])) URL::redirect($this->_moduleName, $this->_controllerName, 'index');
		}

		if ($this->_arrParam['form']['token'] > 0) {
			$this->_validate->validate();
			$this->_arrParam['form'] = $this->_validate->getResult();

			if ( !$this->_validate->isValid() ) {
				$this->_view->errors = $this->_validate->showErrors();

			} else {
				$task = (isset($this->_arrParam['form']['id'])) ? 'edit' : 'add';
				$id = $this->_model->saveItems($this->_arrParam, ['task' => $task]);
				$this->redirectAfterSave(['id' => $id]);
			}
		}

		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render("{$this->_controllerName}/form");
	}
	
	public function ajaxChangeCategoryAction()
    {
        $result = $this->_model->changeCategory($this->_arrParam);
        echo json_encode($result);
	}
	
	public function ajaxOrderingAction()
    {
		$result = $this->_model->ajaxOrdering($this->_arrParam);
        echo json_encode($result);
	}



}
