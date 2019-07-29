<?php

    include '../lib/Session.php' ;
    ob_start();
    Session::init();
    Session::checkSession();



    spl_autoload_register(function($class){
      include_once "../classes/".$class.".php";

    });

    include '../helpers/Format.php';

    $fm   = new Format();
    $service   = new Service();
    $category   = new Category();
    $Usercategory = new UserCategory();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $fm->title();?>--<?php echo 'CarWash'; ?></title>
    <!-- Font Awesome -->

    <link rel="stylesheet" href="css/font.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">

    <link href="css/datatables.min.css" rel="stylesheet">


    <link href="css/summernote.css" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <style>

        .map-container{
            overflow:hidden;
            padding-bottom:56.25%;
            position:relative;
            height:0;
        }
            .map-container iframe{
            left:0;
            top:0;
            height:100%;
            width:100%;
            position:absolute;
        }
    </style>
</head>

<body class="grey lighten-3">
