<?php
class FrontendController extends Controller{
	
	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('frontend/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();

		$this->_moduleName 		= $this->_arrParam['module'];
		$this->_controllerName 	= $this->_arrParam['controller'];
		$this->_actionName 		= $this->_arrParam['action'];
	}




	
	
}