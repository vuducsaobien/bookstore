<?php
class UserModel extends BackendModel
{
	protected $_columnsUser = [
		'id', 'username', 'email', 'fullname', 'password', 'created', 
		'created_by', 'status', 'group_id', 'modified', 'modified_by'
	];
	protected $fieldSearchAcceptedUser = ['id', 'username', 'email', 'fullname'];

	public function __construct()
	{
		parent::__construct();
	}

	/*----- ELSE -----*/
	public function resetPassword($arrParam, $options = null)
    {
		$arrForm 	= $arrParam['form'];
		$id 		= $arrForm['id'];

		if ($options['task'] == 'user-info-profile') {
			$oldPassword = md5($arrForm['old-password']);
			$newPassword = md5($arrForm['new-password']);

			$queryOldPass	= "SELECT `password` FROM `$this->table` WHERE `id` = '{$id}'";
			$resultOldPass		= $this->fetchRow($queryOldPass);
			$oldPassData = $resultOldPass['password'];

			if($oldPassword == $oldPassData){
				$query = "UPDATE `$this->table` SET `password` = '$newPassword', `modified_by` = '{$this->username}', `modified` = '{$this->timeNow}' WHERE `id` = '$id'";
				$this->query($query);
				$result = $this->affectedRows();
			}else{
				$result = false;
			}

			Helper::showNotify($result, 'success', SUCCESS_CHANGE_PASSWORD, 'warning', FAIL_RESET_PASSWORD);
		}

		if ($options['task'] == 'user-list') {
			$newPassword = md5($arrParam['new-password']);

			$query = "UPDATE `$this->table` SET `password` = '$newPassword', `modified_by` = '{$this->username}', `modified` = '{$this->timeNow}' WHERE `id` = '$id'";
			$this->query($query);
			$result = $this->affectedRows();
			Helper::showNotify($result, 'success', SUCCESS_RESET_PASSWORD, 'warning', FAIL_ACTION);
		}


		return $arrForm['id'];
	}

	public function changeGroup($arrParam, $options = null)
    {
        $id 		= $arrParam['id'];
		$groupId 	= $arrParam['group_id'];
        $query 		= "UPDATE `$this->table` SET `group_id` = $groupId, `modified_by` = '{$this->username}', `modified` = '{$this->timeNow}' WHERE `id` = '$id'";
        $this->query($query);
        return [
            'id' => $id,
			'modified'  => HTML::showItemHistory($this->username, $this->timeNow),
        ];
    }

	public function itemInSelectbox($arrParam, $options = null){
		if($options == null){
			$query 	= "SELECT `id`, `name` FROM `".TBL_GROUP."`";
			$result = $this->fetchPairs($query);
			$result['default'] = "- Select Group -";
			ksort($result);
		}
		
		return $result;
	}




}
