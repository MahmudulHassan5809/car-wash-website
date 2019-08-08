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
			<?php
			$result = $service->getServiceById($id);
			if($result){
				while ($value=$result->fetch_assoc()) {
			?>
				<h1 class="my-4">
				    <i class="fas fa-tools"></i>
					<?php echo $value['name']; ?>
				</h1>
				<hr class="hr-dark">
				<div class="row">
					<div class="col-md-5">
						<img class="img-fluid" src="admin/upload/<?php echo $value['image'] ?>" alt="">
					</div>
					<div class="col-md-7">
						<h3 class="my-3">Service Description</h3>
						<?php $desc = htmlspecialchars_decode($value['description']); ?>
						<p>
							<?php echo $Parsedown->text($desc); ?>
						</p>
						<h3 class="my-3">Service Details</h3>
						<ul>
					        <li>
					        	Price :&nbsp&nbsp&nbsp&nbsp<i class="fas fa-dollar-sign"></i> <?php echo $value['price']; ?> TK
					        </li>
					        <li>
					        	Location :&nbsp&nbsp&nbsp&nbsp<i class="fas fa-map-marker"></i></i> <?php echo $value['location']; ?>
					        </li>
					        <li>
					        	Contact No :&nbsp&nbsp&nbsp&nbsp<i class="fas fa-phone"></i>  <?php echo $value['phone']; ?>
					        </li>
					        <li>
					        	Service Added At : <?php echo Carbon::parse($value['date'])->diffForHumans(); ?>

					        </li>
					    </ul>
					    <a href="request.php?id=<?php echo $value['id'] ;?>" class="btn-link">
				    	<h5>
					    	Request For Service
					    </h5>
					</a>
					</div>

				</div>



			 <!-- Related Projects Row -->
			<h3 class="my-4">Related Services (<?php echo $value['cat_name'] ?>)</h3>

			<div class="row">
				<?php
					$serviceByCategory = $service->serviceByCategory($value['cat_id']);
					if($serviceByCategory){
						while ($Categoryservice = $serviceByCategory->fetch_assoc()) {
				?>
				    <div class="col-md-3 col-sm-6 mb-4">
				      <a href="service.php?id=<?php echo $Categoryservice['service_id'] ?>">
				            <img class="img-fluid" src="admin/upload/<?php echo $Categoryservice['image'] ?>" alt="">
				          </a>
				    </div>

				<?php } }  ?>



			</div>
			<!-- /.row -->
			<?php } } ?>
		</div>
	</div>
</main>

<?php include 'inc/footer.php'; ?>
