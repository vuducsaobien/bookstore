<?php
class UserModel extends Model
{
	private $_columns 	  	   = [
		'id', 'username', 'email', 'fullname', 'password', 'created', 
		'created_by', 'status', 'group_id', 'modified', 'modified_by', 'address', 'phone'
	];

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);

		$this->userInfo	   	= Session::get('user')['info'];
		$this->username 	= $this->userInfo['username'];
		$this->timeNow    	= date(DB_DATETIME_FORMAT);
	}

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

		return $arrForm['id'];
	}

	public function infoItems($arrParam, $options = null){
		$email			= Session::get('user')['info']['email'];
		$arrForm = $arrParam['form'];

		if($options == null) {
			$password	= md5($arrForm['password']);
			$query[]	= "SELECT `u`.`id`, `u`.`fullname`, `u`.`status`, `u`.`password`, `u`.`phone`, `u`.`address`,
			`u`.`email`, `u`.`username`, `u`.`group_id`, `g`.`group_acp`";
			$query[]	= "FROM `".TBL_USER."` AS `u` LEFT JOIN `".TBL_GROUP."` AS g ON `u`.`group_id` = `g`.`id`";
			$query[]	= "WHERE `email` = '$email' AND `password` = '$password'";
		}

		if($options['task'] == 'change-user-info') {
			$query[]	= "SELECT `u`.`id`, `u`.`fullname`, `u`.`phone`, `u`.`address`, `u`.`email`, `u`.`username` ";
			$query[]	= "FROM `".TBL_USER."` AS `u`";
			$query[]	= "WHERE `u`.`email` = '$email' ";
		}

		if($options['task'] == 'order-book') {
			$query[]	= "SELECT `sale_off`, `price` ";
			$query[]	= "FROM `".TBL_BOOK."` ";
			$query[]	= "WHERE `id` = {$arrParam['book_id']}";
		}

		$query		= implode(" ", $query);
		$result		= $this->fetchRow($query);
		return $result;
	}

	public function deleteItems($arrParam, $options = null){
		if($options['task'] == 'delete-order'){
			$id 		= $arrParam['id'];
			$cartOld	= Session::get('cart');

			unset($cartOld['quantity'][$id]);
			unset($cartOld['price'][$id]);

			Session::set('cart', $cartOld);
		}
	}

	public function listItems($arrParam, $options = null){
		if($options['task'] == 'books-in-cart'){
			$cart	= Session::get('cart');
			$result	= [];
			if(!empty($cart)){
				$ids	= "(";
				foreach($cart['quantity'] as $key => $value) $ids .= "'$key', ";
				$ids	.= " '0')" ;

				$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`sale_off`, `b`.`special`, `b`.`ordering`, `b`.`price`, `b`.`category_id`, `c`.`name` AS `category_name` ";
				$query[]	= "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
				$query[]	= "WHERE `b`.`status`  = 'active' AND `b`.`id` IN $ids";
				$query[]	= "ORDER BY `b`.`id` ASC";
	
		
				$query		= implode(" ", $query);
				$result		= $this->fetchAll($query);

				// echo '<pre>$arrParam ';
				// print_r($arrParam);
				// echo '</pre>';

				// echo '<pre>$result ';
				// print_r($result);
				// echo '</pre>';
				// die('<h3>Die is Called</h3>');

				foreach($result as $key => $value){
					$result[$key]['quantity']	= $cart['quantity'][$value['id']];
					$result[$key]['price'] = HTML_Frontend::moneyFormat(null, 'price_order', $result[$key]['price'], $result[$key]['sale_off']);
				}


			}
			return $result;
		}
		
		if($options['task'] == 'history-cart'){
			$username	= $this->username;

			$query[]	= "SELECT `id`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`";
			$query[]	= "FROM `".TBL_CART."`";
			$query[]	= "WHERE `username` = '$username'";
			$query[]	= "ORDER BY `date` ASC";
		
			$query		= implode(" ", $query);
			$result		= $this->fetchAll($query);
				
			return $result;
		}
	}

	public function saveItems($arrParam, $options = null){
		$arrForm = $arrParam['form'];

		if($options['task'] == 'submit-cart'){
			$id			= $this->randomString(7);
			$username	= $this->username;
			$books		= json_encode($arrForm['book_id'], 	JSON_UNESCAPED_UNICODE );
			$prices		= json_encode($arrForm['price'], 	JSON_UNESCAPED_UNICODE );
			$quantities	= json_encode($arrForm['quantity'], JSON_UNESCAPED_UNICODE );
			$names		= json_encode($arrForm['name'], 	JSON_UNESCAPED_UNICODE );
			$pictures	= json_encode($arrForm['picture'], 	JSON_UNESCAPED_UNICODE );
			$date		= date(DB_DATETIME_FORMAT);

			$query	= "INSERT INTO `".TBL_CART."`(
					`id`, `username`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`)
			VALUES ('$id', '$username', '$books', '$prices', '$quantities', '$names', '$pictures', 'inactive', '$date')";

			$result = $this->query($query);
			Session::delete('cart');

			if($result==true){
				URL::redirect('frontend', 'index', 'notice', ['type' => 'success-buy'], 'success-buy.html');
			}
		}

		if ($options['task'] == 'edit') {
			$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			$arrForm['modified'] 	= $this->timeNow;
			$arrForm['modified_by'] = $this->username;
			$arrForm['fullname']	= mysqli_real_escape_string($mysqli, $arrForm['fullname']);
			$arrForm['phone']  		= mysqli_real_escape_string($mysqli, $arrForm['phone']);
			$arrForm['address']  	= mysqli_real_escape_string($mysqli, $arrForm['address']);

			$data 	= array_intersect_key($arrForm, array_flip($this->_columns));
			$result = $this->update($data, [ ['email', $arrForm['email']] ]    );

			Helper::showNotify($result, 'success', SUCCESS_EDIT, 'warning', FAIL_ACTION);
		}

		if ($options['task'] == 'change-password') {
			$id 					= $this->userInfo['id'];
			$arrForm['modified'] 	= $this->timeNow;
			$arrForm['modified_by'] = $this->username;
			$oldPassword 			= md5($arrForm['old-password']);
			$newPassword 			= md5($arrForm['new-password']);

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

			Helper::showNotify($result, 'success', SUCCESS_EDIT, 'warning', FAIL_ACTION);
		}
	}
	
	private function randomString($length = 5){
	
		$arrCharacter = array_merge(range('a','z'), range(0,9), range('A','Z'));
		$arrCharacter = implode('', $arrCharacter);
		$arrCharacter = str_shuffle($arrCharacter);
	
		$result		= substr($arrCharacter, 0, $length);
		return $result;
	}


}
