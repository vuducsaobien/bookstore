<?php
class IndexController extends Controller{

	public function __construct($arrParams){
		parent::__construct($arrParams);

		$this->_templateObj->setFolderTemplate('admin/adminlte/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();

		$this->_moduleName 		= $this->_arrParam['module'];
        $this->_controllerName  = $this->_arrParam['controller'];
        $this->_actionName 		= $this->_arrParam['action'];
	}

	public function forgotAction()
	{
		echo '<h3>' . __METHOD__ . '</h3>';
		die;
		echo '<h3>Die is Called</h3>';
	}

	public function loginAction()
	{
		$arrForm = $this->_arrParam['form'];
		$userInfo	= Session::get('user');
		// echo '<pre>$userInfo ';
		// print_r($userInfo);
		// echo '</pre>';
		if( $userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time() ){
			URL::redirect($this->_moduleName, 'dashboard', 'index');
		}

		$this->_templateObj->setFolderTemplate('admin/adminlte/');
		$this->_templateObj->setFileTemplate('login.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
		$this->_view->_title = 'Login Admin';

		if ($this->_arrParam['form']['token'] > 0 ) {

			$this->_validate->validate($this->_model);

			if ( $this->_validate->isValid() ) {
				$infoUser		= $this->_model->infoItems($this->_arrParam, ['task' => 'backend-admin-login']);
				$arraySession	= array(
					'login'		=> true,
					'info'		=> $infoUser,
					'time'		=> time(),
					'group_acp'	=> $infoUser['group_acp'],
					'status'	=> $infoUser['status'],
				);

				Session::set('user', $arraySession);
				URL::redirect($this->_moduleName, 'index', 'notice', ['type' => 'success-login']);
			} else {
				$this->_view->errors	= $this->_validate->showErrors();
			}
		}

		if( $this->_arrParam['form']['token'] > 0 && $this->_actionName=='forgot'){
			$this->_templateObj->setFolderTemplate('admin/adminlte/');
			$this->_templateObj->setFileTemplate('login.php');
			$this->_templateObj->setFileConfig('template.ini');
			$this->_templateObj->load();
			$this->_view->_title = 'Forgot Password';
			$this->_view->errors = '';

			if( !empty($arrForm['email']) && !empty($arrForm['new-password']) ){	
				$this->_view->info = $this->_model->resetPassword($this->_arrParam, ['task' => 'user-list']);	
			}
			
			$this->_view->render("{$this->_controllerName}/forgot");
		}

		// Lock
		$this->_view->render("index/login");
	}

	public function dashboardAction()
	{	
		$this->_view->_title = 'DashBoard';

		$totalItems['group']	= $this->_model->countItemsDashboard($this->_arrParam, 'group');
		$totalItems['user']		= $this->_model->countItemsDashboard($this->_arrParam, 'user');
		$totalItems['book']		= $this->_model->countItemsDashboard($this->_arrParam, 'book');
		$totalItems['category']	= $this->_model->countItemsDashboard($this->_arrParam, 'category');
		$totalItems['cart']		= $this->_model->countItemsDashboard($this->_arrParam, 'cart');
		$totalItems['slide']	= $this->_model->countItemsDashboard($this->_arrParam, 'slide');

		$this->_view->Items = $totalItems;
		$this->_view->render("{$this->_controllerName}/dashboard");
	}

	public function profileAction()
	{
		$this->_view->_title 		= ucfirst($this->_controllerName) . ' Manager :: My Profile';

		if ( !isset($this->_arrParam['form']['token']) ) {
			$this->_arrParam['form'] = $this->_model->infoItems($this->_arrParam);

			if (empty($this->_arrParam['form'])) {
				URL::redirect($this->_moduleName, 'index', 'notice', ['type' => 'not-found']);
			}
		}

		if ($this->_arrParam['form']['token'] > 0) {
				$id = $this->_model->saveItems($this->_arrParam, ['task' => 'index-admin-profile'] );
				if ($this->_arrParam['type'] == 'save-close')  URL::redirect($this->_moduleName, 'user', 'index');
				if ($this->_arrParam['type'] == 'save') 	   URL::redirect($this->_moduleName, $this->_controllerName, 'profile', ['id' => $id]);
		}

		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render("{$this->_controllerName}/profile");
	}

	public function logoutAction(){
		Session::delete('cart');
		Session::delete('user');
		URL::redirect($this->_moduleName, $this->_controllerName, 'login');
	}

	public function noticeAction(){
		if($this->_arrParam['type'] == 'success-login'){
			$this->_view->_title = 'Success - Login';

		}elseif($this->_arrParam['type'] == 'not-found'){
			$this->_view->_title = 'Not - Found';

		}elseif($this->_arrParam['type'] == 'not-permission'){
			$this->_view->_title = 'Not - Permission';
		}
		
		$this->_view->render("{$this->_controllerName}/notice");
	}




}