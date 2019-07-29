<?php
include 'lib/Session.php' ;
ob_start();
Session::init();

//error_reporting(0);

	include 'lib/Database.php' ;
	include 'helpers/Format.php';
	spl_autoload_register(function($class){
	  include_once "classes/".$class.".php";
	});

	$fm = new Format();
	$userCategory = new UserCategory();
	$user = new User();

?>
