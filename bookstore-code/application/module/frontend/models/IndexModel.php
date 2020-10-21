<?php
class IndexModel extends Model
{
	protected $_columns = [
		'id', 'username', 'email', 'fullname', 'password', 'created', 
		'created_by', 'status', 'group_id', 'register_date', 'register_ip'
	];

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);

		$this->userInfo	   	= Session::get('user')['info'];
		$this->username 	= $this->userInfo['username'];
		$this->timeNow    	= date(DB_DATETIME_FORMAT);
	}

	public function saveItems($arrParam, $options = null)
	{
		$arrForm = $arrParam['form'];

		if ($options['task'] == 'user-register') {
			$arrForm['password']		= md5($arrForm['password']);
			$arrForm['register_date']	= $this->timeNow;
			$arrForm['register_ip']		= $_SERVER['REMOTE_ADDR'];
			$arrForm['created_by']		= 'user-register';

			$arrForm['status']			= 'inactive';
			$arrForm['group_id']		= '7';

			$data = array_intersect_key($arrForm, array_flip($this->_columns));
			$result = $this->insert($data);

			Helper::showNotify($result, 'success', SUCCESS_ADD, 'warning', FAIL_ACTION);
			return $this->lastID();
		}
	}

	public function infoItems($arrParam, $options = null){
		if($options['task'] == null) {
			$email		= $arrParam['form']['email'];
			$password	= md5($arrParam['form']['password']);

			$query[]	= "SELECT `u`.`id`, `u`.`fullname`, `u`.`status`, `u`.`password`, `u`.`phone`, `u`.`address`,
			`u`.`email`, `u`.`username`, `u`.`group_id`, `g`.`group_acp`";
			$query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS g ON `u`.`group_id` = `g`.`id`";
			$query[]	= "WHERE `email` = '$email' AND `password` = '$password'";		
		}


		$query		= implode(" ", $query);
		$result		= $this->fetchRow($query);					
		return $result;
	}

	public function listItems($arrParam, $options = null)
	{
		if($options['task'] == 'books-special'){
			$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`sale_off`, `b`.`price`, `b`.`category_id`, `c`.`name` AS `category_name`, 
			`b`.`description`";
			$query[]	= "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";

			$query[] = "WHERE `b`.`status` = 'active' AND `b`.`special` = 1";
			$query[] = "ORDER BY `b`.`ordering` ASC ";
			$query[] = "LIMIT 0, 6";
		}

		if($options['task'] == 'books-special-id'){
			$query[] = "SELECT `b`.`id`, `b`.`picture` ";
			$query[]	= "FROM `".TBL_BOOK."` AS `b` ";

			$query[] = "WHERE `b`.`status` = 'active' AND `b`.`special` = 1";
			$query[] = "ORDER BY `b`.`ordering` ASC ";
			$query[] = "LIMIT 0, 6";
		}


		if($options['task'] == 'books-category' ){

			$query = "SELECT `id` AS `category_id`, `name` FROM `".TBL_CATEGORY."` WHERE `status` = 'active' AND `special` = '1'
			ORDER BY `ordering` ASC LIMIT 0, 3";
			$listCategorySpecial		= $this->fetchAll($query);

			$arrCategorySpecial   = [];
            foreach($listCategorySpecial as $item)
            {
                $arrCategorySpecial[] = ['category_id' => $item['category_id'], 'category_name' => $item['name']];
			}
            $arrTemp = $arrCategorySpecial;

			if(!empty($arrTemp))
            {
                foreach($arrTemp as $key => $item)
                {
					$arr_different_ids = $this->listItems($arrParam, ['task' => 'books-special-id']);
					$IDs = HTML_Frontend::differentIDs($arr_different_ids);

                    $query   = [];
					$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`sale_off`, `b`.`price`, `b`.`category_id`, `c`.`name` AS `category_name` ";
					$query[] = "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";

					$query[] = "WHERE `b`.`category_id` = '{$item['category_id']}'";
					$query[] = "AND `b`.`status` = 'active' AND `b`.`id` NOT IN $IDs ";
					$query[] = "ORDER BY `b`.`ordering` ASC";
					$query[] = "LIMIT 0, 8";

					$query	 = implode(" ", $query);
					$temp	 = $this->fetchAll($query);
                    $arrCategorySpecial[$key]['listBooks'] = $temp;
				}
			}
			// unset($arrTemp);
			return $arrCategorySpecial;
		}

		if($options['task'] == 'slides-active'){
			$query[] = "SELECT `id`, `name`, `picture`, `link`";
			$query[]	= "FROM `".TBL_SLIDE."`";
			$query[] = "WHERE `status` = 'active'";
			$query[] = "ORDER BY `ordering` ASC ";
			$query[] = "LIMIT 0, 4";
		}

		if($options['task'] != 'books-category' ){
			$query		= implode(" ", $query);
			$result		= $this->fetchAll($query);
			return $result;
		}

	}

	public function resetPassword($arrParam, $options = null)
	{
		$arrForm 	= $arrParam['form'];
		$email = $arrForm['email'];
		$newPassword = md5($arrForm['new-password']);

		if ($options['task'] == 'user-list') {

			// Update database New Password
			$query = "UPDATE `$this->table` SET `password` = '$newPassword', `modified_by` = 'Reset Password From Email Login', `modified` = '{$this->timeNow}' WHERE `email` = '$email'";
			$this->query($query);

			// Get info Email Exist
			$query		= "SELECT `username`, `email` FROM `user` WHERE `email` = '$email' ";
			$this->query($query);

			$result = $this->fetchRow($query);
			$result['new-password'] = $arrForm['new-password'];
		}

		return $result;
	}




}
