<?php
class BookController extends Controller
{
	public function __construct($arrParamms)
	{
		parent::__construct($arrParamms);
		$this->_templateObj->setFolderTemplate('frontend/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();

		$this->_moduleName = $this->_arrParam['module'];
		$this->_controllerName = $this->_arrParam['controller'];
		$this->_actionName = $this->_arrParam['action'];
	}

	// ACTION: LIST BOOKS
	public function listAction()
	{
		$this->_view->listCategories  = $this->_model->listItemsCategory($this->_arrParam, ['task' =>'categories-active']);

		if( $this->_arrParam['category_id'] != null ){
			$title = $this->_model->infoItems($this->_arrParam, ['task' =>'get-category-name'])['name'];

			// Pagination
			$totalItems					= $this->_model->countItems($this->_arrParam, ['task' => 'books-in-category']);
			$this->_view->totalItems 		= $totalItems;
			$configPagination 			= ['totalItemsPerPage' => 8, 'pageRange' => 3];
			$this->setPagination($configPagination);
			$this->_view->pagination	= new Pagination($totalItems, $this->_pagination);

			// Items
			$this->_view->booksSpecial	= $this->_model->list_Books_Special($this->_arrParam, ['task' => 'special-books-different-book-in-category']);
			$this->_view->booksCategory = $this->_model->listItems($this->_arrParam, ['task' => 'books-in-category']);

		}else{
			$totalItems	= $this->_model->countItems($this->_arrParam, ['task' => 'books-active']);

			// Title
			if(!empty($this->_arrParam['search'])){
				$searchValue = $this->_arrParam['search'];
				$title = "Tìm kiếm cho '$searchValue': $totalItems Kết quả.";
			}else{
				$title 		= 'Tất Cả Sách | Book-Store';
			}

			switch ($this->_arrParam['sort']) {
				case 'price_asc':	$title = 'Giá Sách Tăng Dần | Book-Store';	break;
				case 'price_desc':	$title = 'Giá Sách Giảm Dần | Book-Store';	break;				
				case 'latest':		$title = 'Sách Mới Nhất | Book-Store';		break;				
			}

			// Pagination
			$this->_view->totalItems 	= $totalItems;
			$configPagination 		 	= ['totalItemsPerPage' => 12, 'pageRange' => 3];
			$this->setPagination($configPagination);
			$this->_view->pagination 	= new Pagination($totalItems, $this->_pagination);

			// Items
			$this->_view->booksSpecial	= $this->_model->list_Books_Special($this->_arrParam, ['task' => 'special-books-different-active']);
			$this->_view->booksActive   = $this->_model->listItems($this->_arrParam, ['task' =>'books-active']);
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

		// Items
		$this->_view->bookInfo  = $this->_model->infoItems($this->_arrParam, ['task' =>'book-info']);
		
		$this->_view->book_Relate  		= $this->_model->listItems($this->_arrParam, ['task' => 'different-relate']);
		$this->_view->books_News 		= $this->_model->list_Books_News($this->_arrParam, ['task' => 'news-books-different-relate']);
		$this->_view->books_Special		= $this->_model->list_Books_Special($this->_arrParam, ['task' => 'special-books-different-relate-news']);

		$this->_view->setTitle($title);
		$this->_view->render("{$this->_controllerName}/index");
	}

	public function quickViewAction()
	{
		$result = $this->_model->infoItems($this->_arrParam, ['task' => 'info-book']);
		echo json_encode($result);
	}

	


}
