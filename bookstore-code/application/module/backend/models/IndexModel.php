<?php
class IndexModel extends Model
{
	protected $_columns = ['id', 'username', 'password', 'email', 'fullname', 'phone', 'address', 'created', 'created_by', 'status', 'group_id', 'modified', 'modified_by'];

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);

		$this->userInfo	   	= Session::get('user')['info'];
		$this->username 	= $this->userInfo['username'];
		$this->timeNow    	= date(DB_DATETIME_FORMAT);
	}

	public function infoItems($arrParam, $options = null)
	{
		$id = $this->userInfo['id'];

		if ($options['task'] == null) {
			$query[]	= "SELECT `id`, `status`, `username`, `email`, `fullname`";
			$query[]	= "FROM `$this->table`";
			$query[]	= "WHERE `id` = '$id' ";
			$query		= implode(" ", $query);

			$result		= $this->fetchRow($query);
		}

		if ($options['task'] == 'backend-admin-login') {
			$username	= $arrParam['form']['username'];
			$password	= md5($arrParam['form']['password']);

			$query[]	= "SELECT `u`.`id`, `u`.`fullname`, `u`.`status`, `u`.`password`, `u`.`phone`, `u`.`address`, `u`.`email`, `u`.`username`, `u`.`group_id`, `g`.`group_acp`, `g`.`name`, `g`.`privilege_id`";
			$query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
			$query[]	= "WHERE `username` = '$username' AND `password` = '$password'";

			$query		= implode(" ", $query);
			$result		= $this->fetchRow($query);

			if ($result['group_acp'] == 1 && $result['status'] == 'active') {
				$arrPrivilege = explode(',', $result['privilege_id']);
				$strPrivilegeID = '';
				foreach ($arrPrivilege as $privilegeID) $strPrivilegeID .= "'$privilegeID', ";

				$queryP[] = "SELECT `id`, CONCAT(`module`, '-', `controller`, '-',  `action`) AS `name`";
				$queryP[] = "FROM `" . TBL_PRIVELEGE . "` AS `p`";
				$queryP[] = "WHERE `id` IN ($strPrivilegeID'0')";

				$queryP					= implode(" ", $queryP);
				$result['privilege']	= $this->fetchPairs($queryP);
			}
		}

		return $result;
	}

	public function saveItems($arrParam, $options = null)
	{
		$arrForm 	= $arrParam['form'];
		$id			= $this->userInfo['id'];

		if ($options['task'] == 'index-admin-profile') {

			$arrForm['id'] = $id;
			$arrForm['modified_by']  = $this->username;
			$arrForm['modified'] 	 = $this->timeNow;

			$data = array_intersect_key($arrForm, array_flip($this->_columns));
			$result = $this->update($data, 
				[ 
					['id', $id ]
				] 
			);

			Helper::showNotify($result, 'success', SUCCESS_EDIT, 'warning', FAIL_ACTION);
			return $id;
		}

	}

	public function countItemsDashboard($arrParam, $option = null){
		$query[]	= "SELECT COUNT(`id`) AS `total`";
		$query[]	= "FROM `$option`";

		$query		= implode(" ", $query);
		$result		= $this->fetchRow($query);
		return $result['total'];
	}

	/*----- ELSE -----*/
	public function resetPassword($arrParam, $options = null)
	{
		$arrForm 	= $arrParam['form'];
		$email		= $arrForm['email'];
		$query		= "SELECT `id` FROM `user` WHERE `email` = '$email' ";

		$this->query($query);
		$result['email_exist'] = $this->affectedRows();

		if($result['email_exist'] == '1'){

			if ($options['task'] == 'user-list') {

				// Update database New Password
				$newPassword = md5($arrForm['new-password']);
				$query = "UPDATE `$this->table` SET `password` = '$newPassword', `modified_by` = 'Reset Password From Email Login', `modified` = '{$this->timeNow}' WHERE `email` = '$email'";
				$this->query($query);

				// Get info Email Exist
				$query		= "SELECT `id`, `username` FROM `user` WHERE `email` = '$email' ";
				$this->query($query);
				$result['email_info'] = $this->fetchRow($query);
			}

		}else{
			$result['email_exist'] = '0';
		}

		return $result;
	}

	


}
