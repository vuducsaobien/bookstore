<?php
class ErrorController extends Controller{
	public function __construct(){
		$this->_controllerName = $this->_arrParam['controller'];
	}
	
	public function indexAction(){
		$this->_view->data	= '<h3>This is an error!</h3>';
		$this->_view->render("{$this->_controllerName}/index");
	}

}