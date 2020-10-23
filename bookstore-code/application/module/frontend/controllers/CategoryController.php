<?php
class CategoryController extends FrontendController
{
	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
	}

	// ACTION: LIST GROUP
	public function indexAction()
	{
		$title = ucfirst($this->_controllerName);

		// Pagination
		$totalItems	 = $this->_model->countItems($this->_arrParam);
		$this->_view->totalItems['totalItems'] = $totalItems;
		$configPagination = ['totalItemsPerPage' => 15, 'pageRange' => PAGE_RANGE];
		$this->setPagination($configPagination);
		$this->_view->pagination	= new Pagination($totalItems, $this->_pagination);

		// Items
		$this->_view->listCategory = $this->_model->listItems($this->_arrParam);

		// Page Error
		$page = $this->_view->arrParam['page'];
		$totalItemsPerPage = $this->_view->arrParam['pagination']['totalItemsPerPage'];
		HTML_Frontend::pageError($page, $totalItems, $totalItemsPerPage, $this->_moduleName, $this->_controllerName, $this->_actionName);

		$this->_view->setTitle($title);
		$this->_view->render("{$this->_controllerName}/index");
	}


}
