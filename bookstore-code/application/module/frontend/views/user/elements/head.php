<?php
$module         = $this->arrParam['module'];
$controller     = $this->arrParam['controller'];
$action         = $this->arrParam['action'];

$linkMyAccount      = URL::createLink($module, 'user', 'index', null, 'my-account.html');
$linkChangePass     = URL::createLink($module, 'user', 'reset_password', null, 'change-password.html');
$linkHistory        = URL::createLink($module, 'user', 'history', null, 'history.html');
$linkLogout         = URL::createLink($module, 'index', 'logout');

$imageURL           = $this->_dirImg;
$userObj 		    = Session::get('user');
$userInfo			= $userObj['info'];

$error 				= $this->errors;