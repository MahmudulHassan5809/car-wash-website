<?php include 'inc/inc.php'; ?>

<?php
if (!isset($_GET['id'])or $_GET['id']==NULL) {
  	$fm->redirect('service.php');
}else
{

  $id = $_GET['id'];
  $editServiceType = $service->editServiceType($id);


  /**/
}
