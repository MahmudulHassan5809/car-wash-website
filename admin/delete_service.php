<?php include 'inc/inc.php'; ?>

<?php
if ((!isset($_GET['id'])or $_GET['id']==NULL) && (!isset($_GET['action'])or $_GET['action'] ==NULL )) {
  	$fm->redirect('service.php');
}else
{

  $id = $_GET['id'];
  $action = $_GET['action'];
  $deleteService=$service->deleteService($id,$action);


  /**/
}
