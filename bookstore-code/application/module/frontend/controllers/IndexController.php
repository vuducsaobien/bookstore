<?php
class IndexController extends FrontendController{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
	}

	public function indexAction(){
		$title = 'Trang chủ | Book Store';

		$this->_view->booksSpecial 		= $this->_model->listItems($this->_arrParam, ['task' => 'books-special']);
		$this->_view->slides 		= $this->_model->listItems($this->_arrParam, ['task' => 'slides-active']);
		$this->_view->booksCategories = $this->_model->listItems($this->_arrParam, ['task' => 'books-category']);

		$this->_view->setTitle($title);
		$this->_view->render("{$this->_controllerName}/index");
	}

	public function loginAction()
	{
		$title = 'Đăng Nhập | BookStore';
		$userInfo	= Session::get('user');

		if( $userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
			Session::delete('cart');
			URL::redirect('frontend', 'user', 'index', null,'my-account.html');
		}

		if ($this->_arrParam['form']['token'] > 0) {

			$this->_validate->validate($this->_model);

			if ( $this->_validate->isValid() ) {
				$infoUser		= $this->_model->infoItems($this->_arrParam); 
				$arraySession	= array(
					'login'		=> true,
					'info'		=> $infoUser,
					'time'		=> time(),
					'group_acp'	=> $infoUser['group_acp'],
				);
				Session::set('user', $arraySession);
				URL::redirect('frontend', 'index', 'notice', ['type' => 'success-login'], 'success-login.html');

			} else {
				$this->_view->errors	= $this->_validate->showErrorsPublic();
			}
		}
		$this->_view->setTitle($title);
		$this->_view->render('index/login');
	}

	public function forgotAction()
	{
		$title = 'Quên Mật Khẩu | BookStore';
		$arrForm = $this->_arrParam['form'];

		if( !empty($arrForm['submit']) ){
			$this->_validate->validateForgot($this->_model);

			if ( $this->_validate->isValid() ) {
				$this->_view->info = $this->_model->resetPassword($this->_arrParam, ['task' => 'user-list']);	
			} else {
				$this->_view->errors	= $this->_validate->showErrorsPublic();
			}

		}

		$this->_view->setTitle($title);
		$this->_view->render("{$this->_controllerName}/forgot");
	}

	public function noticeAction(){
		$title = 'Lưu Ý | BookStore';
		$this->_view->setTitle($title);
		$this->_view->render('index/notice');
	}

	public function registerAction()
	{
		$title = 'Đăng Ký | BookStore';
		$userInfo	= Session::get('user');
		if( $userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time() ){

			URL::redirect($this->_moduleName, 'user', 'index');
		}

		if(isset($this->_arrParam['form']['submit'])){
			URL::checkRefreshPage($this->_arrParam['form']['token'], $this->_moduleName, 'user', $this->_actionName);

			$this->_validate->validateRegister($this->_model);
			
			$this->_arrParam['form'] = $this->_validate->getResult();
			if ( !$this->_validate->isValid() ) {
				$this->_view->errors = $this->_validate->showErrorsPublic();
			} else {
				$this->_model->saveItems($this->_arrParam, ['task' => 'user-register']);
				URL::redirect($this->_moduleName, $this->_controllerName, 'notice', ['type' => 'success-register']);
			}
		}
		$this->_view->setTitle($title);
		$this->_view->render("{$this->_controllerName}/register");
	}

	public function logoutAction()
	{
		Session::delete('cart');
		Session::delete('user');
		URL::redirect($this->_moduleName, $this->_controllerName, 'index', null, 'index.html');
	}


	
}