<?php
class BackendController extends Controller{
	
	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/adminlte/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();

		$this->_moduleName 		= $this->_arrParam['module'];
		$this->_controllerName 	= $this->_arrParam['controller'];
		$this->_actionName 		= $this->_arrParam['action'];
	}

	public function changeStateAction()
    {
		$result = $this->_model->ajaxChangeState($this->_arrParam);
		echo json_encode($result);
    }

	// ACTION: MULTI-ACTIVE
	public function multi_activeAction()
	{
		$this->_model->bulkAction($this->_arrParam, ['task' => 'multi-active']);
		URL::redirect($this->_moduleName, $this->_controllerName, 'index');
	}

	// ACTION: MULTI-INACTIVE
	public function multi_inactiveAction()
	{
		$this->_model->bulkAction($this->_arrParam, ['task' => 'multi-inactive']);
		URL::redirect($this->_moduleName, $this->_controllerName, 'index');
	}

	// ACTION: MULTI-DELETE
	public function multi_deleteAction()
	{
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect($this->_moduleName, $this->_controllerName, 'index');
	}

	// ACTION: MULTI-SPECIAL
	public function multi_specialAction()
	{
		$this->_model->bulkAction($this->_arrParam, ['task' => 'multi-special']);
		URL::redirect($this->_moduleName, $this->_controllerName, 'index');
	}

	// ACTION: MULTI-UNSPECIAL
	public function multi_unspecialAction()
	{
		$this->_model->bulkAction($this->_arrParam, ['task' => 'multi-unspecial']);
		URL::redirect($this->_moduleName, $this->_controllerName, 'index');
	}
	
	public function redirectAfterSave($params)
    {
        if ($this->_arrParam['type'] == 'save-close')   URL::redirect($this->_moduleName, $this->_controllerName, 'index');
        if ($this->_arrParam['type'] == 'save-new')     URL::redirect($this->_moduleName, $this->_controllerName, 'form');
        if ($this->_arrParam['type'] == 'save')         URL::redirect($this->_moduleName, $this->_controllerName, 'form', ['id' => $params['id']]);
    }



	
	
}