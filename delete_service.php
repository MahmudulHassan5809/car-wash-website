<?php include 'inc/inc.php'; ?>

<?php
if ((!isset($_GET['id'])or $_GET['id']==NULL)) {
  	$fm->redirect('provider_dashboard.php');
}else
{

  $id = $_GET['id'];

  $deleteService=$service->deleteService($id,$action);


  /**/
}
