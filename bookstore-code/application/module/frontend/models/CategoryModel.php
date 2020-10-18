<?php
class CategoryModel extends Model
{
	protected $_columnsCategory = [
		'id', 'name', 'picture', 'created', 'created_by', 
		'modified', 'modified_by', 'status', 'ordering'
	];
	protected $fieldSearchAcceptedCategory = ['id', 'name'];

	public function __construct()
	{
		parent::__construct();
		$this->userInfo	   = Session::get('user')['info'];
		$this->setTable(TBL_CATEGORY);
	}

	public function listItems($arrParam, $options = null)
	{
		$query[] = "SELECT `c`.`id` AS `category_id`, `c`.`name`, `c`.`picture`";
		$query[] = "FROM `".TBL_CATEGORY."` AS `c`";
		$query[] = "WHERE `c`.`status` = 'active'";
		$query[] = "ORDER BY `c`.`ordering` ASC ";

		// PAGINATION
		$pagination			= $arrParam['pagination'];
		$totalItemsPerPage	= $pagination['totalItemsPerPage'];
		if ($totalItemsPerPage > 0) {
			$position	= ($pagination['currentPage'] - 1) * $totalItemsPerPage;
			$query[]	= "LIMIT $position, $totalItemsPerPage";
		}

		$query		= implode(" ", $query);
		$result		= $this->fetchAll($query);
		return $result;
	}

	public function countItems($arrParam, $options = null)
    {
		$query[]	= "SELECT COUNT(`c`.`id`) AS `total`";
		$query[]	= "FROM `".TBL_CATEGORY."` AS `c`";
		$query[]	= "WHERE `c`.`status` = 'active'";
		$query[]	= "GROUP BY `c`.`id`";

		// PAGINATION
		if($options!=null){
			$pagination			= $arrParam['pagination'];
			$totalItemsPerPage	= $pagination['totalItemsPerPage'];
			if ($totalItemsPerPage > 0) {
				$position	= ($pagination['currentPage'] - 1) * $totalItemsPerPage;
				$query[]	= "LIMIT $position, $totalItemsPerPage";
			}
		}

		$query		= implode(" ", $query);

		$resultQuery		= $this->fetchAll($query);
		$result = count($resultQuery);

		return $result;
    }


	
}
