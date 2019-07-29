<?php include 'inc/inc.php'; ?>

<?php
if (!isset($_GET['id'])or $_GET['id']==NULL) {
  	$fm->redirect('category.php');
}else
{

  $id=$_GET['id'];
  $deleteCategory=$category->deleteCategory($id);


  /**/
}
