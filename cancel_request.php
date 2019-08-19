<?php include 'inc/inc.php'; ?>

<?php
if ((!isset($_GET['reqId'])or $_GET['reqId']==NULL) && (!isset($_GET['userId'])or $_GET['userId']==NULL)) {
  	$fm->redirect('user_dashboard.php');
}else
{

  $reqId=$_GET['reqId'];
  $userId=$_GET['userId'];
  $cancelRequest = $request->cancelRequest($reqId,$userId);


  /**/
}
