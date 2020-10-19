<?php
class BookModel extends Model
{
	protected $_columnsBook = [
		'id', 'name', 'description', 'price', 'sale_off', 'picture', 'special', 'short_description',
		'category_id', 'status', 'ordering', 'created', 'created_by',  'modified', 'modified_by'
	];
	protected $fieldSearchAcceptedBook = ['name'];

	public function __construct()
	{
		parent::__construct();
		$this->userInfo	   = Session::get('user')['info'];
		$this->setTable(TBL_BOOK);
	}

	public function listItems($arrParam, $options = null)
	{
		$bookID = $arrParam['book_id'];

		if($options['task'] == 'books-category'){
			$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`sale_off`, `b`.`special`, `b`.`ordering`, `b`.`price`, `b`.`category_id`, `c`.`name` AS `category_name`, 
			`b`.`description`";
			$query[]	= "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
			
			$query[] = "WHERE `b`.`status` = 'active' AND `category_id` = '".$arrParam['category_id']."' ";
			$query[] = "ORDER BY `b`.`ordering` ASC ";
		}

		if($options['task'] == 'books-special'){
			$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`sale_off`, `b`.`special`, `b`.`ordering`, `b`.`price`, `b`.`category_id`, `b`.`description`, `c`.`name` AS `category_name`";
			$query[]	= "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";

			$query[] = "WHERE `b`.`status` = 'active' AND `b`.`special` = 1 AND `b`.`id` <> '$bookID'";
			$query[] = "ORDER BY `b`.`ordering` ASC ";
			$query[] = "LIMIT 0, 10";
		}

		if($options['task'] == 'books-relate'){
			$queryCate  = "SELECT `category_id` FROM `".TBL_BOOK."` WHERE `id` = '$bookID'";
			$resultCate	= $this->fetchRow($queryCate);
			$cateID		= $resultCate['category_id'];

			$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`sale_off`, `b`.`price`, `b`.`description`";
			$query[] = "FROM `".TBL_BOOK."` AS `b`";
			$query[] = "WHERE `b`.`status` = 'active' AND `b`.`category_id` = '$cateID' AND `b`.`id` <> '$bookID'";
			$query[] = "ORDER BY `b`.`ordering` ASC ";
			$query[] = "LIMIT 0, 6";
		}

		if($options['task'] == 'books-news'){
			$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`sale_off`, `b`.`price`, `b`.`category_id`, `c`.`name` AS `category_name`";
			$query[]	= "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";

			$query[] = "WHERE `b`.`status` = 'active' AND `b`.`id` <> '$bookID'";
			$query[] = "ORDER BY `b`.`id` DESC ";
			$query[] = "LIMIT 0, 7";
		}

		if($options['task'] == 'all-books-active'){
			$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`sale_off`, `b`.`special`, `b`.`ordering`, `b`.`price`, `b`.`category_id`, `c`.`name` AS `category_name`, 
			`b`.`description`";
			$query[]	= "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";

			$query[] = "WHERE `b`.`status` = 'active'";

			if (!empty($arrParam['search'])) {
				$keyword     		 = "'%{$arrParam['search']}%'";
				$query[] 	 		 = "AND (";
				foreach ($this->fieldSearchAcceptedBook as $field) {
					$query[] = "`b`.`$field` LIKE $keyword";
					$query[] = "OR";
				}
				array_pop($query);
				$query[] = ")";
			}

			// SORT
			if (isset($arrParam['sort']) && ($arrParam['sort']!='default')) {

				if($arrParam['sort'] == 'price_asc'){
					$query[] = "ORDER BY `b`.`price` ASC";
				
				}elseif($arrParam['sort'] == 'price_desc'){
					$query[] = "ORDER BY `b`.`price` DESC";
				
				}elseif($arrParam['sort'] == 'latest'){
					$query[] = "ORDER BY `b`.`id` DESC";
				}
			}else{
				$query[] = "ORDER BY `b`.`ordering` ASC ";
			}
		}

		if(
			$options['task'] == 'all-books-active' ||
			$options['task'] == 'books-category'
		){
			// PAGINATION
			$pagination			= $arrParam['pagination'];
			$totalItemsPerPage	= $pagination['totalItemsPerPage'];
			if ($totalItemsPerPage > 0) {
				$position	= ($pagination['currentPage'] - 1) * $totalItemsPerPage;
				$query[]	= "LIMIT $position, $totalItemsPerPage";
			}
		}

		$query		= implode(" ", $query);
		$result		= $this->fetchAll($query);
		return $result;
	}

	public function countItems($arrParam, $options = null)
	{
		if($options==null){

			$query[]	= "SELECT COUNT(`b`.`id`) AS `totalBook`, `b`.`category_id`, 
			`c`.`name` AS `category_name`, `c`.`picture` AS `category_picture`";
			$query[]	= "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";

			$query[]	= "WHERE `b`.`status` = 'active' AND `b`.`category_id` = ".$arrParam['category_id']."    ";

			$query		= implode(" ", $query);
			$result = $this->fetchRow($query)['totalBook'];
		}

		if($options=='all-books-active'){
			$query[]	= "SELECT COUNT(`b`.`id`) AS `totalBook`, `b`.`category_id`, 
			`c`.`name` AS `category_name`, `c`.`picture` AS `category_picture`";
			$query[]	= "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";

			$query[]	= "WHERE `b`.`status` = 'active'";

			if (!empty($arrParam['search'])) {
				$keyword     		 = "'%{$arrParam['search']}%'";
				$query[] 	 		 = "AND (";
				foreach ($this->fieldSearchAcceptedBook as $field) {
					$query[] = "`b`.`$field` LIKE $keyword";
					$query[] = "OR";
				}
				array_pop($query);
				$query[] = ")";
			}

			$query		= implode(" ", $query);
			$result = $this->fetchRow($query)['totalBook'];
		}
		return $result;
	}

	public function infoItems($arrParam, $options = null)
	{
		if ($options['task'] == null) {
			$query[]	= "SELECT `id`, `status`, `picture`, `ordering`, `name`";
			$query[]	= "FROM `".TBL_CATEGORY."`";
			$query[]	= "WHERE `".TBL_CATEGORY."`.`id` > 0";
			$query[]	= "ORDER BY `id` ASC ";

			$query		= implode(" ", $query);
			$result		= $this->fetchAll($query);
			return $result;
		}

		if ($options['task'] == 'book-info') {
			$query[] 	= "SELECT `id`, `name`, `picture`, `sale_off`, `price`, `description`, `short_description`";
			$query[]	= "FROM `".TBL_BOOK."`";
			$query[]	= "WHERE `id` = '" . $arrParam['book_id'] . "'";
			$query[]	= "ORDER BY `id` ASC ";
		}

		if ($options['task'] == 'get-category-name') {
			$query[] 	= "SELECT `name`";
			$query[]	= "FROM `".TBL_CATEGORY."`";
			$query[]	= "WHERE `id` = '" . $arrParam['category_id'] . "'";
		}

		if ($options['task'] == 'get-book-name') {
			$query[] 	= "SELECT `name`";
			$query[]	= "FROM `".TBL_BOOK."`";
			$query[]	= "WHERE `id` = '" . $arrParam['book_id'] . "'";
		}

		$query		= implode(" ", $query);
		$result		= $this->fetchRow($query);
		return $result;


	}

	public function countItemsCategory($arrParam, $options = null)
    {
		$query[] = "SELECT `c`.`id` AS `category_id`, `c`.`name` AS `category_name`";
		$query[] = "FROM `".TBL_CATEGORY."` AS `c`";
		$query[] = "WHERE `c`.`status` = 'active'";
		$query[] = "ORDER BY `ordering` ASC ";
	
		$query		= implode(" ", $query);
		$result   = $this->fetchAll($query);
		return $result;
	}
	



	
}
