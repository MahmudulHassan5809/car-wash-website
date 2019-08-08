<?php include 'inc/inc.php'; ?>

<?php
if (!isset($_GET['id'])or $_GET['id']==NULL) {
  	$fm->redirect('page.php');
}else
{

  $id=$_GET['id'];
  $deletePage=$page->deletePage($id);


  /**/
}
