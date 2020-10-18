<?php
class UserController extends BackendController
{

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
	}

	// ACTION: LIST GROUP
	public function indexAction()
	{
		$this->_view->_title 		= ucfirst($this->_controllerName) . ' Manager :: List';

		// Pagination
		$totalItems = $this->_model->countItems($this->_arrParam);
		$configPagination = ['totalItemsPerPage' => ITEM_PER_PAGE, 'pageRange' => PAGE_RANGE];
		$this->setPagination($configPagination);
		$this->_view->pagination  	= new Pagination($totalItems, $this->_pagination);

		// Items
		$this->_view->filterGroup 	= $this->_model->itemInSelectbox($this->_arrParam);
		$this->_view->countActive   = $this->_model->countItems($this->_arrParam, ['task' => 'count-active']);
		$this->_view->countInactive = $this->_model->countItems($this->_arrParam, ['task' => 'count-inactive']);
		$this->_view->Items 		= $this->_model->listItems($this->_arrParam, null);
		
		// Page Error
		$page = $this->_view->arrParam['page'];
		$totalItemsPerPage = $this->_view->arrParam['pagination']['totalItemsPerPage'];
		HTML_Frontend::pageError($page, $totalItems, $totalItemsPerPage, $this->_moduleName, $this->_controllerName, $this->_actionName);

		$this->_view->render("{$this->_controllerName}/index");
	}

	// // ACTION: ADD & EDIT GROUP
	public function formAction()
	{
		$this->_view->_title = ucfirst($this->_controllerName) . ' Manager :: Add';
		$this->_view->filterGroup 	= $this->_model->itemInSelectbox($this->_arrParam);

		if (isset($this->_arrParam['id']) && !isset($this->_arrParam['form']['token'])) {

			$this->_view->_title = ucfirst($this->_controllerName) . ' Manager :: Edit';
			$this->_arrParam['form'] = $this->_model->infoItems($this->_arrParam);

			if (empty($this->_arrParam['form'])) {
				URL::redirect($this->_moduleName, 'index', 'notice', ['type' => 'not-found']);
			}

			if ($this->_arrParam['id'] ==  Session::get('user')['info']['id']){
				URL::redirect($this->_moduleName, 'index', 'notice', ['type' => 'not-permission']);
			}
		}

		if ($this->_arrParam['form']['token'] > 0) {

			$this->_validate->validate($this->_model);
			$this->_arrParam['form'] = $this->_validate->getResult();

			if (!$this->_validate->isValid()) {
				$this->_view->errors = $this->_validate->showErrors();

			} else {
				$task = isset($this->_arrParam['form']['id']) ? 'edit' : 'add';
				$id = $this->_model->saveItems($this->_arrParam, ['task' => $task]);
				$this->redirectAfterSave(['id' => $id]);
			}

		}
		
		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render("{$this->_controllerName}/form");
	}

	public function reset_passwordAction() {	
		$this->_view->sendMail = false;
	
		if (isset($this->_arrParam['id']) && !isset($this->_arrParam['form']['token'])) {
			$this->_view->_title = ucfirst($this->_controllerName) . ' Manager :: Reset Password';
			$this->_arrParam['form'] = $this->_model->infoItems($this->_arrParam);

			if (empty($this->_arrParam['form'])) {
				URL::redirect($this->_moduleName, 'index', 'notice', ['type' => 'not-found']);
			}
		}
		
		if ($this->_arrParam['form']['token'] > 0) {
			$userInfo = Session::get('user')['info'];
			
			if($userInfo['id'] == $this->_view->arrParam['id']){

				$this->_validate->validateResetPassword();

				$this->_arrParam['form'] = $this->_validate->getResult();
				if (!$this->_validate->isValid()) {
					$this->_view->errors = $this->_validate->showErrors();
				} else {
					$id = $this->_model->resetPassword($this->_arrParam, ['task' => 'user-info-profile']);
					if ($this->_arrParam['type'] == 'save') URL::redirect($this->_moduleName, $this->_controllerName, 'reset_password', ['id' => $id]);

				}

			}else{
				$this->_arrParam['form'] = $this->_model->infoItems($this->_arrParam);

				$id = $this->_model->resetPassword($this->_arrParam, ['task' => 'user-list']);
				$this->_view->sendMail = true;
				// if ($this->_arrParam['type'] == 'save') URL::redirect($this->_moduleName, $this->_controllerName, 'reset_password', ['id' => $id]);
			}

		}
		

		$this->_view->arrParam = $this->_arrParam;
        $this->_view->render("{$this->_controllerName}/reset-password");
	}
	
	public function ajaxChangeGroupAction()
    {
        $result = $this->_model->changeGroup($this->_arrParam);
        echo json_encode($result);
    }


}
