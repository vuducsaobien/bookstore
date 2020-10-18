<?php
class BookController extends Controller
{
	public function __construct($arrParamms)
	{
		parent::__construct($arrParamms);
		$this->_templateObj->setFolderTemplate('frontend/main/');
		$this->_templateObj->setFileTemplate('list.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();

		$this->_moduleName = $this->_arrParam['module'];
		$this->_controllerName = $this->_arrParam['controller'];
		$this->_actionName = $this->_arrParam['action'];
	}

	// ACTION: LIST GROUP
	public function listAction()
	{
		$this->_view->listCategories  = $this->_model->countItemsCategory($this->_arrParamm, ['task' =>'categories-active']);
		$this->_view->booksSpecial 		= $this->_model->listItems($this->_arrParamm, ['task' => 'books-special']);

		if(!empty($this->_arrParamm['category_id'])){
			$title = $this->_model->infoItems($this->_arrParamm, ['task' =>'get-category-name'])['name'];

			$totalItems					= $this->_model->countItems($this->_arrParamm);
			$this->_view->totalItems 		= $totalItems;
			$configPagination 			= ['totalItemsPerPage' => 8, 'pageRange' => 3];
			$this->setPagination($configPagination);
			$this->_view->pagination	= new Pagination($totalItems, $this->_pagination);

			$this->_view->booksCategory = $this->_model->listItems($this->_arrParamm, ['task' => 'books-category']);

		}else{
			$totalItems	= $this->_model->countItems($this->_arrParamm, 'all-books-active');

			if(!empty($this->_arrParamm['search'])){
				$searchValue = $this->_arrParamm['search'];
				$title = "Tìm kiếm cho '$searchValue': $totalItems Kết quả.";
			}else{
				$title 		= 'Tất Cả Sách | Book-Store';
			}

			switch ($this->_arrParamm['sort']) {
				case 'price_asc':	$title = 'Giá Sách Tăng Dần | Book-Store';	break;
				case 'price_desc':	$title = 'Giá Sách Giảm Dần | Book-Store';	break;				
				case 'latest':		$title = 'Sách Mới Nhất | Book-Store';		break;				
			}

			$this->_view->totalItems 	= $totalItems;
			$configPagination 		 	= ['totalItemsPerPage' => 12, 'pageRange' => 3];
			$this->setPagination($configPagination);
			$this->_view->pagination 	= new Pagination($totalItems, $this->_pagination);
			$this->_view->booksActive   = $this->_model->listItems($this->_arrParam, ['task' =>'all-books-active']);
		}

		// Page Error
		$page = $this->_view->arrParam['page'];
		$totalItemsPerPage = $this->_view->arrParam['pagination']['totalItemsPerPage'];
		HTML_Frontend::pageError($page, $totalItems, $totalItemsPerPage, $this->_moduleName, $this->_controllerName, $this->_actionName);

		$this->_view->setTitle($title);
		$this->_view->render("{$this->_controllerName}/list");
	}

	// ACTION: DETAIL INFO BOOK
	public function indexAction()
	{
		$title = $this->_model->infoItems($this->_arrParam, ['task' =>'get-book-name'])['name'];

		$this->_view->bookInfo  = $this->_model->infoItems($this->_arrParam, ['task' =>'book-info']);
		$this->_view->bookRelate  = $this->_model->listItems($this->_arrParam, ['task' =>'books-relate']);
		$this->_view->booksSpecial 		= $this->_model->listItems($this->_arrParam, ['task' => 'books-special']);
		$this->_view->booksNews 		= $this->_model->listItems($this->_arrParam, ['task' => 'books-news']);

		$this->_view->setTitle($title);
		$this->_view->render("{$this->_controllerName}/index");
	}
	


}
