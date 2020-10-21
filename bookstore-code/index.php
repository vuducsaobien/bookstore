<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once 'define.php';
require_once 'define_notice.php';
date_default_timezone_set(DEFAULT_TIMEZONE);


function __autoload($clasName)
{
	require_once PATH_LIBRARY . "{$clasName}.php";
}
Session::init();
// Session::delete('user');
// Session::delete('cart', $cart);
$bootstrap = new Bootstrap();
$bootstrap->init();

