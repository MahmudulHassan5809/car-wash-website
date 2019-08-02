<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>



<?php
	require 'vendor/autoload.php';
	use Carbon\Carbon;
	$Parsedown = new Parsedown();

?>

<?php
  if(!isset($_GET['id']) or $_GET['id']==NULL){
    $fm->redirect('index.php');
  }else
  {
    $id=$_GET['id'];
  }

?>

<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">
			<div class="row">
				<div class="col-md-12">
					<?php
					$result = $service->getServiceById($id);
				    if($result){
				      while ($value=$result->fetch_assoc()) {
					?>
						<h1 class="text-danger text-center">
							<i class="fas fa-tools"></i>
							<?php echo $value['name']; ?>
						</h1>
						<hr class="hr-dark mb-5">
						<img class="img-fluid w-100 h-50 mb-5" src="admin/upload/<?php echo $value['image'] ?>" alt="">

						<?php $desc = htmlspecialchars_decode($value['description']); ?>

						<?php echo $Parsedown->text($desc); ?>

						<p>
							Price :&nbsp&nbsp&nbsp&nbsp<i class="fas fa-dollar-sign"></i> <?php echo $value['price']; ?> TK
						</p>

						<p>
							Location :&nbsp&nbsp&nbsp&nbsp<i class="fas fa-map-marker"></i></i> <?php echo $value['location']; ?>
						</p>

						<p>
							Contact No :&nbsp&nbsp&nbsp&nbsp<i class="fas fa-phone"></i>  <?php echo $value['phone']; ?>
						</p>

						<p>
							Service Added At : <?php echo Carbon::parse($value['date'])->diffForHumans(); ?>
						</p>

					<?php } } ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php include 'inc/footer.php'; ?>
