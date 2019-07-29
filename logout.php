<?php include 'inc/inc.php'; ?>
<?php
if (isset($_GET['action']) && $_GET['action'] == "logout" ) {
	$user->logOut();

}else
{

echo "<script>window.location='index.php'</script>";
  //header("Location:catlist.php");
}
