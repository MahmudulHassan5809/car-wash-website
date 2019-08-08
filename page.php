<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>

<?php
	require 'vendor/autoload.php';
	use Carbon\Carbon;
	$Parsedown = new Parsedown();


?>


<?php
	if(!isset($_GET['pageId']) or $_GET['pageId']==NULL){
		$fm->redirect('index.php');
	}else{
		$id=$_GET['pageId'];
	}
?>


<?php
	$pageById=$page->pageById($id);
	if ($pageById) {
		while ($value=$pageById->fetch_assoc()) {
?>


<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center mb-3"><?php echo $value['title']; ?></h3>
					<hr>
					<?php $desc = htmlspecialchars_decode($value['description']); ?>
					<?php echo $Parsedown->text($desc); ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php } } ?>

<?php include 'inc/footer.php'; ?>
