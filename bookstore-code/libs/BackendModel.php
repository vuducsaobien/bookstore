<?php
class BackendModel extends Model
{
	protected $_columns;
	protected $fieldSearchAccepted;

	public function __construct()
	{
		parent::__construct();

		$this->init();

		$this->userInfo	   	= Session::get('user')['info'];
		$this->username 	= $this->userInfo['username'];
		$this->timeNow    	= date(DB_DATETIME_FORMAT);
	}

	public function init(){

		if (isset($this->_columnsGroup)) {
			$this->setTable(TBL_GROUP);
			$tableName = ucfirst(TBL_GROUP);

		} elseif (isset($this->_columnsUser)) {
			$this->setTable(TBL_USER);
			$tableName = ucfirst(TBL_USER);
			
		} elseif (isset($this->_columnsCategory)) {
			$this->setTable(TBL_CATEGORY);
			$tableName = ucfirst(TBL_CATEGORY);

		} elseif (isset($this->_columnsBook)) {
			$this->setTable(TBL_BOOK);
			$tableName = ucfirst(TBL_BOOK);

		} elseif (isset($this->_columnsCart)) {
			$this->setTable(TBL_CART);
			$tableName = ucfirst(TBL_CART);

		} elseif (isset($this->_columnsSlide)) {
			$this->setTable(TBL_SLIDE);
			$tableName = ucfirst(TBL_SLIDE);
		}

		$_columns 			 		= '_columns' . $tableName;
		$fieldSearchAccepted 		= 'fieldSearchAccepted' . $tableName;
		$this->_columns 			= $this->$_columns;
		$this->fieldSearchAccepted 	= $this->$fieldSearchAccepted;
	}

	public function listItems($arrParam, $options = null)
	{
		switch ($this->table) {
			case TBL_GROUP:		$tableAs = '`g`';
				$query[] = "SELECT COUNT(`u`.`id`) AS `total_members`, `g`.`id`, `g`.`name`, `g`.`group_acp`, `g`.`status`, `g`.`created`, `g`.`created_by`,
					`g`.`modified`, `g`.`modified_by`";
				$query[] = "FROM `$this->table` AS `g` LEFT JOIN `".TBL_USER."` AS `u` ON `g`.`id` = `u`.`group_id`";	break;	

			case TBL_USER: 		$tableAs = '`u`';
				$query[] = "SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`fullname`, `u`.`status`, `u`.`group_id`,
				`u`.`created`, `u`.`created_by`, `u`.`modified`, `u`.`modified_by`, `g`.`name` AS `group_name`";
				$query[] = "FROM `$this->table` AS `u` LEFT JOIN `".TBL_GROUP."` AS `g` ON `u`.`group_id` = `g`.`id`";	break;

			case TBL_CATEGORY: 	$tableAs = '`c`';
				$query[] = "SELECT COUNT(`b`.`id`) AS `total_books`, `c`.id, `c`.`name`, `c`.`picture`, `c`.`status`, `c`.`ordering`, `c`.`created`, `c`.`created_by`,
				`c`.`modified`, `c`.`modified_by`, `c`.`special`";
				$query[] = "FROM `$this->table` AS `c` LEFT JOIN `".TBL_BOOK."` AS `b` ON `c`.`id` = `b`.`category_id`";	break;

			case TBL_BOOK:		$tableAs = '`b`';
				$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`description`, `b`.`price`, `b`.`sale_off`, `b`.`picture`, `b`.`special`,
				`b`.`category_id`, `b`.`status`, `b`.`ordering`, `b`.`created`, `b`.`created_by`, `b`.`modified`, `b`.`modified_by`";
				$query[] = "FROM `$this->table` AS `b` LEFT JOIN `" . TBL_CATEGORY . "` AS `c` ON `b`.`category_id` = `c`.`id`";	break;

			case TBL_SLIDE:		$tableAs = '`s`';
				$query[] = "SELECT `s`.`id`, `s`.`name`, `s`.`picture`, `s`.`status`, `s`.`ordering`, `s`.`description`, `s`.`link`,
				`created`, `s`.`created_by`, `s`.`modified`, `s`.`modified_by`";
				$query[] = "FROM `$this->table` AS $tableAs";	break;	
		}

		switch ($this->table) {
			default:		$query[] = "WHERE $tableAs.`id` >= 0";	break;
			case TBL_USER:	$query[] = "WHERE $tableAs.`id` <> '{$this->userInfo['id']}'";	break;
		}

			// FILTER : KEYWORD SEARCH
			if (!empty($arrParam['search'])) {
				$keyword     		 = "'%{$arrParam['search']}%'";
				if ($arrParam['filter_search_by'] == 'all') {
					$query[] 	 		 = "AND (";

					foreach ($this->fieldSearchAccepted as $field) {
						$query[] = "$tableAs.`$field` LIKE $keyword";
						$query[] = "OR";
					}

					array_pop($query);
					$query[] = ")";
				}

				$filterSearch = $arrParam['filter_search_by'];
				$searchBy = "`$filterSearch`";
				if (!empty($filterSearch) && $filterSearch != 'all') {
					$query[] = "AND $tableAs.$searchBy LIKE $keyword";
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

			if($this->table==TBL_GROUP || $this->table==TBL_CATEGORY )	$query[]	= "GROUP BY $tableAs.`id`";

			// SORT
				if (!empty($arrParam['sort_field']) && !empty($arrParam['sort_order'])) {
					$sort_field	= $arrParam['sort_field'];
					$sort_order	= $arrParam['sort_order'];
					$query[]	= "ORDER BY `$sort_field` $sort_order";
				} else {
					$query[]	= "ORDER BY $tableAs.`id` ASC ";
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
		switch ($this->table) {
			case TBL_GROUP: 	$tableAs = '`g`';	break;
			case TBL_USER: 		$tableAs = '`u`';	break;
			case TBL_CATEGORY:	$tableAs = '`c`';	break;
			case TBL_BOOK:		$tableAs = '`b`';	break;
			case TBL_SLIDE:		$tableAs = '`s`';	break;
		}

		$query[] 	= "SELECT COUNT($tableAs.`id`) AS `total`";
		$query[] 	= "FROM `$this->table` AS $tableAs";

		switch ($this->table) {
			default:	$query[]	= "WHERE $tableAs.`id` > 0";	break;	
			case TBL_USER:	$query[] 	= "WHERE $tableAs.`id` <> '{$this->userInfo['id']}'";	break;
		}

		if ($options['task'] == null) {
			if (isset($arrParam['filter_status']) && $arrParam['filter_status'] != 'all')
				$query[] = "AND $tableAs.`status` = '{$arrParam['filter_status']}'";
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

					foreach ($this->fieldSearchAccepted as $field) {
						$query[] = "$tableAs.`$field` LIKE $keyword";
						$query[] = "OR";
					}

					array_pop($query);
					$query[] = ")";
				}

				$filterSearch = $arrParam['filter_search_by'];
				$searchBy = "`$filterSearch`";
				if (!empty($filterSearch) && $filterSearch != 'all') {
					$query[] = "AND $tableAs.$searchBy LIKE $keyword";
				}

			}

			// FILTER : STATUS
				if (isset($arrParam['filter_status']) && $arrParam['filter_status'] != 'all') {
					$query[] = "AND $tableAs.`status` = '{$arrParam['filter_status']}'";
				}

				// FILTER : GROUP ACP
				if (isset($arrParam['filter_group_acp']) && $arrParam['filter_group_acp'] != 'default') {
					$query[] = "AND $tableAs.`group_acp` = {$arrParam['filter_group_acp']}";
				}

				// FILTER : GROUP ID
				if (isset($arrParam['filter_group_id']) && $arrParam['filter_group_id'] != 'default') {
					$query[] = "AND $tableAs.`group_id` = '{$arrParam['filter_group_id']}'";
				}

				// FILTER : CATEGORY ID
				if (isset($arrParam['filter_category_id']) && $arrParam['filter_category_id'] != 'default') {
					$query[] = "AND $tableAs.`category_id` = {$arrParam['filter_category_id']}";
				}

				if (isset($arrParam['filter_special']) && $arrParam['filter_special'] != 'default') {
					$query[] = "AND $tableAs.`special` = {$arrParam['filter_special']}";
			// FILTER : SPECIAL

		}
			
		$query		= implode(" ", $query);
		$result = $this->fetchRow($query)['total'];
		return $result;
	}

	public function saveItems($arrParam, $options = null)
	{
		$mysqli  = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$arrForm = $arrParam['form'];

		$arrForm['name']	  	  		= mysqli_real_escape_string($mysqli, $arrForm['name']);
		$arrForm['short_description']  	= mysqli_real_escape_string($mysqli, $arrForm['short_description']);
		$arrForm['description']  		= mysqli_real_escape_string($mysqli, $arrForm['description']);	

		require_once PATH_LIBRARY_EXT . 'Upload.php';
		$uploadObj = new Upload();


		if ($options['task'] == 'add') {
			$arrForm['created_by']  		= $this->username;
			$arrForm['created'] 	  		= $this->timeNow;

			switch ($this->table) {
				case TBL_USER:
					$arrForm['password'] 	= md5($arrForm['password']);
				break;
	
				case TBL_CATEGORY:
					$arrForm['picture'] 	= $uploadObj->uploadFile($arrForm['picture'], TBL_CATEGORY);
				break;
	
				case TBL_BOOK:
					$arrForm['picture'] 	= $uploadObj->uploadFile($arrForm['picture'], TBL_BOOK, '98', '150');
				break;
	
				case TBL_SLIDE:
					$arrForm['picture'] 	= $uploadObj->uploadFile($arrForm['picture'], TBL_SLIDE, '300', '124');
				break;	
			}

			$data 	= array_intersect_key($arrForm, array_flip($this->_columns));
			$result = $this->insert($data);

			Helper::showNotify($result, 'success', SUCCESS_ADD, 'warning', FAIL_ACTION);
			return $this->lastID();
		}

		if ($options['task'] == 'edit') {
			$arrForm['modified_by']  		= $this->username;
			$arrForm['modified'] 	  		= $this->timeNow;

			if ($this->table == TBL_USER) {
				if ($arrForm['password'] != null) {
					$arrForm['password'] = md5($arrForm['password']);
				} else { unset($arrForm['password']) ;}
			}

			if ($this->table == TBL_CATEGORY || $this->table == TBL_BOOK || $this->table == TBL_SLIDE) {

				if ($arrForm['picture']['name'] == null) {
					unset($arrForm['picture']);

				} else {

					$uploadObj->removeFile($this->table, $arrForm['hidden_picture']);
					if ($this->table == TBL_CATEGORY) {
						$arrForm['picture'] = $uploadObj->uploadFile($arrForm['picture'], TBL_CATEGORY);
						$uploadObj->removeFile(TBL_CATEGORY, '60x90-' . $arrForm['hidden_picture']);

					} elseif($this->table == TBL_BOOK) {
						$arrForm['picture'] = $uploadObj->uploadFile($arrForm['picture'], TBL_BOOK, '98', '150');
						$uploadObj->removeFile(TBL_BOOK, '98x150-' . $arrForm['hidden_picture']);

					} elseif($this->table == TBL_SLIDE) {
						$arrForm['picture'] = $uploadObj->uploadFile($arrForm['picture'], TBL_SLIDE, '300', '124');
						$uploadObj->removeFile(TBL_SLIDE, '300x124-' . $arrForm['hidden_picture']);
					}
				}
			}



			$data 	= array_intersect_key($arrForm, array_flip($this->_columns));
			$result = $this->update($data, array(array('id', $arrForm['id'])));

			Helper::showNotify($result, 'success', SUCCESS_EDIT, 'warning', FAIL_ACTION);
			return $arrForm['id'];
		}

	}

	public function infoItems($arrParam, $options = null)
	{
		if ($options['task'] == null) {
			$query = "SELECT * FROM `$this->table` WHERE `id` = '{$arrParam['id']}' ";

			$result		= $this->fetchRow($query);
			return $result;
		}
	}

	public function deleteItems($arrParam, $options = null)
	{
		die('<h3>Die is Called</h3>');
		if ($options == null) {
			$ids = [];
			if (isset($arrParam['id'])) $ids = [$arrParam['id']];
			if (isset($arrParam['checkbox'])) $ids = $arrParam['checkbox'];

			if ($this->table == TBL_CATEGORY || $this->table == TBL_BOOK || $this->table == TBL_SLIDE) 
			{
				require_once PATH_LIBRARY_EXT . 'Upload.php';
				$uploadObj 	= new Upload();
				$ids 		= implode(',', $ids);
				$query		= "SELECT `id`, `picture` AS `name` FROM `$this->table` WHERE `id` IN ($ids)";

				$arrImg = $this->fetchPairs($query);
				foreach ($arrImg as $image) {
					$uploadObj->removeFile($this->table, $image);

					switch ($this->table) {
						case TBL_CATEGORY:	$uploadObj->removeFile(TBL_CATEGORY, '60x90-' . $image);	break;
						case TBL_CATEGORY:	$uploadObj->removeFile(TBL_BOOK, '98x150-' . $image);		break;
						case TBL_CATEGORY:	$uploadObj->removeFile(TBL_SLIDE, '300x124-' . $image);		break;
					}
				}

				$ids = [];
				if (isset($arrParam['id'])) $ids = [$arrParam['id']];
				if (isset($arrParam['checkbox'])) $ids = $arrParam['checkbox'];
			}

			// DELETE FROM DATABASE
			$result = $this->delete($ids);
			Helper::showNotify($result, 'success', SUCCESS_DELETE, 'warning', FAIL_ACTION);
		}
	}

	public function bulkAction($arrParam, $options = null)
	{
		$ids 			= $arrParam['checkbox'];
		$ids 			= implode("','", $ids);
		$ids 			= "('$ids')";

		switch ($options['task']) {
			case 'multi-active':	$stateName	=	'status';	$state	=	'active';	break;
			case 'multi-inactive':	$stateName	=	'status';	$state	=	'inactive';	break;
			case 'multi-special':	$stateName	=	'special';	$state	=	'1';		break;
			case 'multi-unspecial':	$stateName	=	'special';	$state	=	'0';		break;
		}

		$query  = "UPDATE `$this->table` SET `$stateName` = '$state', `modified_by` = '{$this->username}', `modified` = '{$this->timeNow}' WHERE `id` IN $ids";
		$this->query($query);

		if ($this->affectedRows()) {
			Session::set('notify', Helper::createNotify('success', SUCCESS_CHANGE));
		} else {
			Session::set('notify', Helper::createNotify('warning', FAIL_ACTION));
		}
	}

	public function ajaxChangeState($arrParam, $options = null)
	{
		$id = $arrParam['id'];

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

				} elseif ( isset($arrParam['ordering']) ) {
					$stateName 	= 'ordering';
					$state		= $arrParam['ordering'];
					if($state <= '0') $state='1';
			}

			$query  = "UPDATE `$this->table` SET `$stateName` = '$state', `modified_by` = '{$this->username}', `modified` = '{$this->timeNow}' WHERE `id` = '$id'";
			$this->query($query);

			return [
				'id'        => $id,
				'state'     => $state,
				'modified'  => HTML::showItemHistory($this->username, $this->timeNow),
				'link'      => URL::createLink($arrParam['module'], $arrParam['controller'], 'changeState', ['id' => $id, "$stateName" => $state])
			];

		}
	}




}
