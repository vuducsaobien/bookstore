<?php
class CartModel extends Model
{
	protected $_columns = [
		'id', 'username', 'status', 'dates', 'modified', 'modified_by'
	];

	protected $fieldSearchAcceptedUser = ['fullname', 'email', 'phone', 'address'];
	protected $fieldSearchAcceptedCart = ['id', 'username'];

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_CART);

		$this->userInfo	   	= Session::get('user')['info'];
		$this->username 	= $this->userInfo['username'];
		$this->timeNow    	= date(DB_DATETIME_FORMAT);
	}

	public function listItems($arrParam, $options = null)
	{
		// if ($options == null) {
			$tableAs = '`c`';
			$tableTwo = '`u`';

			$query[] = "SELECT `c`.`id`, `c`.`username`, `c`.`books`, `c`.`names`, `c`.`prices`, `c`.`quantities`, `c`.`pictures`, `c`.`status`, `c`.`date`, 
			`u`.`email`, `u`.`fullname`, `u`.`phone`, `u`.`address`";

			$query[] = "FROM `$this->table`
			AS $tableAs LEFT JOIN `" . TBL_USER . "` AS `u` ON `c`.`username` = `u`.`username`";

			if ($options == null) {
			$query[] = "WHERE $tableAs.`id` <> '0'";
			}

			if ($options['task'] == 'view-cart') {
				$id = $arrParam['id'];
				$query[] = "WHERE `c`.`id` = '$id'";
			}	


			// FILTER : KEYWORD SEARCH
			if (!empty($arrParam['search'])) {
				$keyword     		 = "'%{$arrParam['search']}%'";

				if ($arrParam['filter_search_by'] == 'all') {
					$query[] 	 		 = "AND (";

					foreach ($this->fieldSearchAcceptedCart as $field) {
						$query[] = "$tableAs.`$field` LIKE $keyword";
						$query[] = "OR";
					}

					foreach ($this->fieldSearchAcceptedUser as $fieldUser) {
						$query[] = "$tableTwo.`$fieldUser` LIKE $keyword";
						$query[] = "OR";
					}

					array_pop($query);
					$query[] = ")";
				}

				$filterSearch = $arrParam['filter_search_by'];
				$searchBy = "`$filterSearch`";
				if ( !empty($filterSearch) && $filterSearch != 'all' ) {

					if($filterSearch == 'id' || $filterSearch == 'username' ){
						$query[] = "AND $tableAs.$searchBy LIKE $keyword";

					}elseif($filterSearch == 'fullname' || $filterSearch == 'email' || $filterSearch == 'phone' || $filterSearch == 'address'){
						$query[] = "AND $tableTwo.$searchBy LIKE $keyword";
					}

				}

			}

			// FILTER : STATUS
				if (isset($arrParam['filter_status']) && $arrParam['filter_status'] != 'all') {
					$query[] = "AND $tableAs.`status` = '{$arrParam['filter_status']}'";
				}

				if (isset($arrParam['filter_category_id']) && $arrParam['filter_category_id'] != 'default') {
					$query[] = "AND $tableAs.`category_id` = {$arrParam['filter_category_id']}";
				}

				if (isset($arrParam['filter_group_acp']) && $arrParam['filter_group_acp'] != 'default') {
					$query[] = "AND $tableAs.`group_acp` = {$arrParam['filter_group_acp']}";
				}

				if (isset($arrParam['filter_group_id']) && $arrParam['filter_group_id'] != 'default') {
					$query[] = "AND $tableAs.`group_id` = '{$arrParam['filter_group_id']}'";
				}
				
				if (isset($arrParam['filter_category_id']) && $arrParam['filter_category_id'] != 'default') {
					$query[] = "AND $tableAs.`category_id` = {$arrParam['filter_category_id']}";
				}

				if (isset($arrParam['filter_special']) && $arrParam['filter_special'] != 'default') {
					$query[] = "AND $tableAs.`special` = {$arrParam['filter_special']}";
				}
			// FILTER

			// SORT
			if (!empty($arrParam['sort_field']) && !empty($arrParam['sort_order'])) {
				$sort_field	= $arrParam['sort_field'];
				$sort_order	= $arrParam['sort_order'];
				$query[]	= "ORDER BY `$sort_field` $sort_order";
			} else {
				$query[]	= "ORDER BY $tableAs.`date` DESC ";
			}

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
		$tableAs = '`c`';
		$tableTwo = '`u`';

		$query[] = "SELECT COUNT($tableAs.`id`) AS `total`";
		$query[] = "FROM `$this->table` AS $tableAs LEFT JOIN `" . TBL_USER . "` AS `u` ON `c`.`username` = `u`.`username`";
		$query[] = "WHERE $tableAs.`id` <> '0'";

			if ($options['task'] == null) {
				if (isset($arrParam['status']) && $arrParam['status'] != 'all')
				$query[] = "AND $tableAs.`status` = '{$arrParam['status']}'";
			}

			if ($options['task'] == 'count-active') {
				$query[] = "AND $tableAs.`status` = 'active'";
			}

			if ($options['task'] == 'count-inactive') {
				$query[] = "AND $tableAs.`status` = 'inactive'";
			}

			// FILTER : KEYWORD SEARCH
			if (!empty($arrParam['search'])) {
				$keyword     		 = "'%{$arrParam['search']}%'";

				if ($arrParam['filter_search_by'] == 'all') {
					$query[] 	 		 = "AND (";

					foreach ($this->fieldSearchAcceptedCart as $field) {
						$query[] = "$tableAs.`$field` LIKE $keyword";
						$query[] = "OR";
					}

					foreach ($this->fieldSearchAcceptedUser as $fieldUser) {
						$query[] = "$tableTwo.`$fieldUser` LIKE $keyword";
						$query[] = "OR";
					}

					array_pop($query);
					$query[] = ")";
				}

				$filterSearch = $arrParam['filter_search_by'];
				$searchBy = "`$filterSearch`";
				if ( !empty($filterSearch) && $filterSearch != 'all' ) {

					if($filterSearch == 'id' || $filterSearch == 'username' ){
						$query[] = "AND $tableAs.$searchBy LIKE $keyword";

					}elseif($filterSearch == 'fullname' || $filterSearch == 'email' || $filterSearch == 'phone' || $filterSearch == 'address'){
						$query[] = "AND $tableTwo.$searchBy LIKE $keyword";
					}

				}

			}

			// FILTER : STATUS
				if (isset($arrParam['filter_status']) && $arrParam['filter_status'] != 'all') {
					$query[] = "AND $tableAs.`status` = '{$arrParam['filter_status']}'";
				}

				if (isset($arrParam['filter_category_id']) && $arrParam['filter_category_id'] != 'default') {
					$query[] = "AND $tableAs.`category_id` = {$arrParam['filter_category_id']}";
				}

				if (isset($arrParam['filter_group_acp']) && $arrParam['filter_group_acp'] != 'default') {
					$query[] = "AND $tableAs.`group_acp` = {$arrParam['filter_group_acp']}";
				}

				if (isset($arrParam['filter_group_id']) && $arrParam['filter_group_id'] != 'default') {
					$query[] = "AND $tableAs.`group_id` = '{$arrParam['filter_group_id']}'";
				}
				
				if (isset($arrParam['filter_category_id']) && $arrParam['filter_category_id'] != 'default') {
					$query[] = "AND $tableAs.`category_id` = {$arrParam['filter_category_id']}";
				}

				if (isset($arrParam['filter_special']) && $arrParam['filter_special'] != 'default') {
					$query[] = "AND $tableAs.`special` = {$arrParam['filter_special']}";
				}
			// FILTER

		$query		= implode(" ", $query);
		$result = $this->fetchRow($query)['total'];
		return $result;
	}

	public function ajaxChangeState($arrParam, $options = null)
	{
		$id         	= $arrParam['id'];

		if ($options['task'] == null) {
			if (isset($arrParam['group_acp'])) {
				$stateName 	= 'group_acp';
				$state 		= ($arrParam['group_acp'] == 0) ? 1 : 0;

			} elseif (isset($arrParam['status'])) {
				$stateName 	= 'status';
				$state 		= ($arrParam['status'] == 'inactive') ? 'active' : 'inactive';

			} elseif (isset($arrParam['special'])) {
				$stateName 	= 'special';
				$state 		= ($arrParam['special'] == 0) ? 1 : 0;

			} elseif (isset($arrParam['ordering'])) {
				$stateName 	= 'ordering';
				$state			= $arrParam['ordering'];
			}

			$query  = "UPDATE `$this->table` SET `$stateName` = '$state', `modified_by` = '{$this->username}', `modified` = '{$this->timeNow}' WHERE `id` = '$id'";

			$this->query($query);
			return [
				'id'        => $id,
				'state'     => $state,
				'modified'  => HTML::showItemHistory($this->username, $this->timeNow),
				'link'      => URL::createLink($arrParam['module'], $arrParam['controller'], 'ajaxChangeStatus', ['id' => $id, "$stateName" => $state])
			];
		}
	}

	public function bulkAction($arrParam, $options = null)
	{
		$ids 			= $arrParam['checkbox'];
		$ids 			= implode("','", $ids);
		$ids 			= "('$ids')";

		switch ($options['task']) {
			case 'multi-active':
				$stateName 	= 'status';
				$state 		= 'active';
				break;
			case 'multi-inactive':
				$stateName 	= 'status';
				$state 		= 'inactive';
				break;
			case 'multi-special':
				$stateName 	= 'special';
				$state 		= '1';
				break;
			case 'multi-unspecial':
				$stateName 	= 'special';
				$state 		= '0';
				break;
		}

		$query  = "UPDATE `$this->table` SET `$stateName` = '$state', `modified_by` = '{$this->username}', `modified` = '{$this->timeNow}' WHERE `id` IN $ids";
		$this->query($query);

		if ($this->affectedRows()) {
			Session::set('notify', Helper::createNotify('success', SUCCESS_CHANGE));
		} else {
			Session::set('notify', Helper::createNotify('warning', FAIL_ACTION));
		}
	}








}
