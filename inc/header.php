<!-- include.php -->
<?php include 'inc.php'; ?>
<!-- End Of include.php -->




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php
		if(!isset($_GET['pageId']) or $_GET['pageId']==NULL){
			$pageTitle = $fm->title();
		}else{
			$pageId = $_GET['pageId'];
			$pageTitle = $page->pageTitle($pageId);
		}
	?>
	<title><?php echo $pageTitle; ?></title>

	<link rel="stylesheet" href="assets/css/font.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/mdb.min.css">
	<link rel="stylesheet" href="assets/css/summernote.css">
	<link rel="stylesheet" href="assets/css/style.css">


	</style>
</head>
<body>


