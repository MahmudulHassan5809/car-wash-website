<?php include 'inc/inc.php'; ?>
<?php
if (isset($_GET['action']) && $_GET['action'] == "logout" ) {
	$ad->logOut();

}else
{
	$fm->redirect('index.php');
}
