<?php
class Controller{
	
	// View Object
	protected $_view;
	
	// Model Object
	protected $_model;
	
	// Template object
	protected $_templateObj;
	
	// Params (GET - POST)
	protected $_arrParam;
	
	// Pagination
	protected $_pagination	= array(
		'totalItemsPerPage'	=> 1,
		'pageRange'			=> 5,
	);

	// Validate object
	protected $_validate;


	// METHOD
	public function __construct($arrParams){
		$this->_pagination['currentPage']	= ($arrParams['page']) ?? 1;
		$arrParams['pagination'] 			= $this->_pagination;


		$this->setParams($arrParams);
		$this->setModel($arrParams['module'], $arrParams['controller']);
		$this->setValidate($arrParams['module'], $arrParams['controller']);
		$this->setTemplate($this);
		$this->setView($arrParams['module']);

		// DUC
		// $this->_moduleName = $this->_arrParam['module'];
		// $this->_controllerName = $this->_arrParam['controller'];
		// $this->_actionName = $this->_arrParam['action'];
		// DUC

		$this->_view->arrParam = $arrParams;
	}

	// SET PAGINATION
	public function setPagination($config){
		$this->_pagination['totalItemsPerPage'] = $config['totalItemsPerPage'];
		$this->_pagination['pageRange']			= $config['pageRange'];
		$this->_arrParam['pagination']			= $this->_pagination;
		$this->_view->arrParam					= $this->_arrParam;
	}
	

	// SET VALIDATE
	public function setValidate($moduleName, $controllerName){
		$validateName = ucfirst($controllerName) . 'Validate';
		$path = PATH_MODULE . $moduleName . DS . 'validates' .  DS . $validateName . '.php';
		if(file_exists($path)){
			require_once $path;
			$this->_validate	= new $validateName($this->_arrParam);
		}
	}
	
	// GET VALIDATE
	// public function getValidate(){
	// 	return $this->_validate;
	// }
	
	// GET PAGINATION
	public function getPagination($config){
	}
		
	// SET MODEL
	public function setModel($moduleName, $modelName){
		$modelName = ucfirst($modelName) . 'Model';
		$path = PATH_MODULE . $moduleName . DS . 'models' .  DS . $modelName . '.php';
		if(file_exists($path)){
			require_once $path;
			$this->_model	= new $modelName();
		}
	}
	
	// GET MODEL
	public function getModel(){
		return $this->_model;
	}
	
	// SET VIEW
	public function setView($moduleName){
		$this->_view = new View($moduleName);
	}
	
	// GET VIEW
	public function getView(){
		return $this->_view;
	}
	
	// SET TEMPLATE
	public function setTemplate(){
		$this->_templateObj = new Template($this);	
	}
	
	// GET TEMPLATE
	public function getTemplate(){
		return $this->_templateObj;
	}
	
	// GET PARAMS
	public function setParams($arrParam){
		$this->_arrParam= $arrParam;
	}
	
	// SET PARAMS
	public function getParams($arrParam){
		$this->_arrParam= $arrParam;
	}
	
	
}