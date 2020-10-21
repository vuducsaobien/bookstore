<?php
class UserController extends Controller
{

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('frontend/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();

		$this->_moduleName = $this->_arrParam['module'];
		$this->_controllerName = $this->_arrParam['controller'];
		$this->_actionName = $this->_arrParam['action'];
	}

	public function indexAction(){
		$title = 'Thông Tin Tài Khoản';

		if (!isset($this->_arrParam['form']['token'])) {
			$this->_arrParam['form'] = $this->_model->infoItems($this->_arrParam , ['task' => 'change-user-info']);
		}

		if ($this->_arrParam['form']['token'] > 0) {
			$this->_validate->validate($this->_model);
			
			$this->_arrParam['form'] = $this->_validate->getResult();
			if ( !$this->_validate->isValid() ) {
				$this->_view->errors = $this->_validate->showErrors();
			} else {
				$this->_model->saveItems($this->_arrParam, ['task' => 'edit']);
			}
		}

		$this->_view->arrParam = $this->_arrParam;
		$this->_view->setTitle($title);
		$this->_view->render("{$this->_controllerName}/index");
	}

	public function reset_passwordAction(){
		$title = 'Thay Đổi Mật Khẩu';
		
		if ($this->_arrParam['form']['token'] > 0) {
			$this->_validate->validateResetPassword();

			$this->_arrParam['form'] = $this->_validate->getResult();
			if ( !$this->_validate->isValid() ) {
				$this->_view->errors = $this->_validate->showErrors();

			} else {
				$id = $this->_model->resetPassword($this->_arrParam, ['task' => 'user-info-profile']);
				if ($this->_arrParam['type'] == 'save') URL::redirect($this->_moduleName, $this->_controllerName, 'reset_password', ['id' => $id]);
			}


		}

		$this->_view->arrParam = $this->_arrParam;
		$this->_view->setTitle($title);
		$this->_view->render("{$this->_controllerName}/change-password");
	}

	public function historyAction(){
		$title = 'Lịch Sử Mua Hàng';
		$this->_view->Items		= $this->_model->listItems($this->_arrParam, ['task' => 'history-cart']);

		$this->_view->setTitle($title);
		$this->_view->render('user/history');
	}
	
	public function buyAction(){
		$title = ucfirst($this->_controllerName);
		$this->_model->saveItems($this->_arrParam, ['task' => 'submit-cart']);
		// URL::redirect('default', 'index', 'index');
		$this->_view->setTitle($title);
		URL::redirect($this->_moduleName, 'index', 'index');
	}

	public function deleteAction(){
		$this->_model->deleteItems($this->_arrParam, ['task' => 'delete-order']);
		URL::redirect($this->_moduleName, 'user', 'cart');
	}

	public function ajaxQuantitiesCartAction(){
		$result = $this->_model->ajaxQuantities($this->_arrParam);
		echo json_encode($result);
		URL::redirect($this->_moduleName, 'user', 'cart');

	}

	public function cartAction(){
		$title = 'Giỏ Hàng';
		$this->_view->Items		= $this->_model->listItems($this->_arrParam, ['task' => 'books-in-cart']);

		$this->_view->setTitle($title);
		$this->_view->render('user/cart');
	}

	public function orderAction(){
		$cart	= Session::get('cart');
		$bookID	= $this->_arrParam['book_id'];
		$price	= $this->_arrParam['price'];
		$quantity = $this->_arrParam['quantity'];
		
		// echo '<pre>$this->_arrParam ';
		// print_r($this->_arrParam);
		// echo '</pre>';

		// echo '<pre>$cart ';
		// print_r($cart);
		// echo '</pre>';

		if(empty($cart)){
			$cart['quantity'][$bookID]	= 1;
			$cart['price'][$bookID]		= $price;

		}else{
			if(key_exists($bookID, $cart['quantity'])){
				$cart['quantity'][$bookID]	+= 1;
				$cart['price'][$bookID]		= $price * $cart['quantity'][$bookID];
			}else{
				$cart['quantity'][$bookID]	= 1;
				$cart['price'][$bookID]		= $price;
			}
		}
		Session::set('cart', $cart);
		// Session::delete('cart', $cart);


		// URL::redirect($this->_moduleName, 'book', 'index', ['book_id' => $bookID]);
		echo json_encode(array_sum($cart['quantity']));
	}











	
}
