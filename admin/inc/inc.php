<?php

	include '../lib/Session.php' ;

	Session::init();
	Session::checkSession();



	spl_autoload_register(function($class){
	  include_once "../classes/".$class.".php";

	});

	include '../helpers/Format.php';

    $fm   = new Format();

	$ad = new Admin();
	$service = new Service();
	$category = new Category();
	$Usercategory = new UserCategory();
	$page = new Page();
	$settings = new Settings();
?>
