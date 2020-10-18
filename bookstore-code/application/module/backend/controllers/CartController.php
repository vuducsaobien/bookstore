<?php
class CartController extends BackendController
{

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
	}

	// ACTION: LIST CART
	public function indexAction()
	{
		$this->_view->_title 		= ucfirst($this->_controllerName) . ' Manager :: List';

		// Pagination
		$totalItems					= $this->_model->countItems($this->_arrParam);
		$configPagination = ['totalItemsPerPage' => ITEM_PER_PAGE, 'pageRange' => PAGE_RANGE];
		$this->setPagination($configPagination);
		$this->_view->pagination	= new Pagination($totalItems, $this->_pagination);

		// Page Error
		$page = $this->_view->arrParam['page'];
		$totalItemsPerPage = $this->_view->arrParam['pagination']['totalItemsPerPage'];
		HTML_Frontend::pageError($page, $totalItems, $totalItemsPerPage, $this->_moduleName, $this->_controllerName, $this->_actionName);				

		// Items
		$this->_view->countActive 	= $this->_model->countItems($this->_arrParam, ['task' => 'count-active']);
		$this->_view->countInactive = $this->_model->countItems($this->_arrParam, ['task' => 'count-inactive']);
		$this->_view->Items 		= $this->_model->listItems($this->_arrParam);
		
		$this->_view->render("{$this->_controllerName}/index");
	}

	public function viewAction()
	{
		$this->_view->_title 		= ucfirst($this->_controllerName) . ' Manager :: View';

		// Pagination
		// $Items = $this->_model->listItems($this->_arrParam, ['task' => 'view-cart']);
		if(!empty($Items)){
			foreach($Items as $item){
				$arrId		    = json_decode($item['books']);
				echo $totalItems = count($arrId);
			}
		}	

		$configPagination = ['totalItemsPerPage' => 2, 'pageRange' => PAGE_RANGE];
		$this->setPagination($configPagination);
		$this->_view->pagination	= new Pagination($totalItems, $this->_pagination);

		// Items
		$this->_view->Items = $this->_model->listItems($this->_arrParam, ['task' => 'view-cart']);
		
		$this->_view->render("{$this->_controllerName}/view");
	}


	

}
