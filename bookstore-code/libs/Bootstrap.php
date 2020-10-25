<?php
class Bootstrap{
	
	private $_params;
	private $_controllerObject;
	
	public function init(){
		$this->setParam();
		$controllerName	= ucfirst($this->_params['controller']) . 'Controller';
		$filePath	= PATH_MODULE . $this->_params['module'] . DS . 'controllers' . DS . $controllerName . '.php';
		if(file_exists($filePath)){
			$this->loadExistingController($filePath, $controllerName);
			$this->callMethod();
		}else{
			// URL::redirect('frontend', 'index', 'notice', ['type' => 'not-found'], 'not-found.html');
			if($this->_params['module'] == 'backend'){
				URL::redirect('backend', 'index', 'notice', ['type' => 'not-found'] );
			}else{
				URL::redirect('frontend', 'index', 'notice', ['type' => 'not-found'], 'not-found.html');
			}
		}
	}
	
	// CALL METHODE
	private function callMethod(){
		$actionName = $this->_params['action'] . 'Action';
		if(method_exists($this->_controllerObject, $actionName)==true){
			$module		= $this->_params['module'];
			$controller	= $this->_params['controller'];
			$action		= $this->_params['action'];
			$userObj	= Session::get('user');
			$userInfo	= $userObj['info'];

			$logged		= ($userObj['login'] == true && $userObj['time'] + TIME_LOGIN >= time());

			// MODULE BACKEND ADMIN
			if ($module == 'backend'){
				if($logged==true){
					if($userInfo['group_acp']==1 && $userInfo['status']=='active'){
						// if(in_array($requestURL, $userInfo['info']['privilege'])==true){
							$this->_controllerObject->$actionName();
						// }else{
						// 	URL::redirect('frontend', 'index', 'notice', ['type' => 'not-permission'] );
						// }
					}else{
						URL::redirect('backend', 'index', 'notice', ['type' => 'not-permission'] );
					}
				}else{
					$this->callLoginAction($module);
				}
				
			// MODULE DEFAULT FRONTEND
			}elseif ($module == 'frontend'){
				if($controller == 'user'){
					if($logged == true){
						$this->_controllerObject->$actionName();
					}else{
						$this->callLoginAction($module);
					}
				}else{
					$this->_controllerObject->$actionName();
				}
			}

		}else{
			// die;
			// echo '<h3>Die is Called</h3>';
			URL::redirect('frontend', 'index', 'notice', ['type' => 'not-found'] );
		}

	}
	
	// CALL ACTION LOGIN
	private function callLoginAction($module = 'frontend'){
		Session::delete('user');
		require_once (PATH_MODULE . $module . DS . 'controllers' . DS . 'IndexController.php');
		$indexController = new IndexController($this->_params);
		$indexController->loginAction();
	}

	// SET PARAMS
	public function setParam(){
		$this->_params 	= array_merge($_GET, $_POST);
		$this->_params['module'] 		= isset($this->_params['module']) ? $this->_params['module'] : DEFAULT_MODULE;
		$this->_params['controller'] 	= isset($this->_params['controller']) ? $this->_params['controller'] : DEFAULT_CONTROLLER;
		$this->_params['action'] 		= isset($this->_params['action']) ? $this->_params['action'] : DEFAULT_ACTION;
	}
	
	// LOAD EXISTING CONTROLLER
	private function loadExistingController($filePath, $controllerName){
		require_once $filePath;
		$this->_controllerObject = new $controllerName($this->_params);
	}
	
	// ERROR CONTROLLER
	public function _error(){
		// require_once PATH_MODULE . 'default' . DS . 'controllers' . DS . 'troller.php';
		require_once PATH_MODULE . 'frontend' . DS . 'controllers' . DS . 'ErrorController.php';
		$this->_controllerObject = new ErrorController();
		// $this->_controllerObject->setView('default');
		$this->_controllerObject->setView('frontend');
		$this->_controllerObject->indexAction();
	}
}