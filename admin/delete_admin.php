<?php include 'inc/inc.php'; ?>

<?php
if (!isset($_GET['id'])or $_GET['id']==NULL) {
  	$fm->redirect('all_admin.php');
}else
{

  $id=$_GET['id'];
  $deleteAdmin=$ad->deleteAdmin($id);


  /**/
}
