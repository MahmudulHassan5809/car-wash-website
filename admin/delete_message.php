<?php include 'inc/inc.php'; ?>

<?php
if (!isset($_GET['id'])or $_GET['id']==NULL) {
  	$fm->redirect('messages.php');
}else
{

  $id=$_GET['id'];
  $deleteMessage = $cm->deleteMessage($id);


  /**/
}
