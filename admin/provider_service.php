<!-- Header -->
	<?php include 'inc/header.php'; ?>
<!-- End Header -->


<!-- TopNav -->
	<?php include 'inc/top_nav.php'; ?>
<!-- TopNav -->

<!-- SideNav -->
	<?php include 'inc/side_nav.php'; ?>
<!-- SideNav -->

<?php
	if((!isset($_GET['id']) or $_GET['id']==NULL) && (!isset($_GET['user_name']) or $_GET['user_name']==NULL)){
		$fm->redirect('all_user.php');
	}else{
		$id=$_GET['id'];
		$userName=$_GET['user_name'];
	}
?>


<main class="pt-5 mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12 pt-5 mb-3">
				<?php echo $fm->getMsg('msg'); ?>

				<?php echo $fm->getMsg('msg_notify'); ?>

				<?php
					$result = $service->getAllServiceByProvider($id);
				?>

				<?php if ($result): ?>
					<div class="alert alert-success" role="alert">

							<?php echo $userName; ?> Has Total
							<?php echo mysqli_num_rows($result); ?>
							Services.

					</div>
				<?php else: ?>
					<div class="alert alert-success" role="alert">
						<?php echo $userName; ?> Has Total 0 Services.
					</div>
				<?php endif ?>

					<div class="row">
						<?php
							if($result){
								while ($value = $result->fetch_assoc()) {
						?>
						<div class="col-md-4">
							<figure class="figure">
								<img
								src="upload/<?php echo $value['image']; ?>" class="figure-img img-fluid rounded"
								alt="<?php echo $value['name']; ?>"
								style="height: 150px;"
								>

								<figcaption class="figure-caption">
									<h6 class="m-0 text-dark">Category <?php echo $value['cat_name']; ?></h6>
									<h6 class="m-0 text-dark">Price <?php echo $value['price']; ?></h6>
									<h6 class="m-0 text-dark">Phone <?php echo $value['phone']; ?></h6>
									<h6 class="m-0 text-dark">Created At <?php echo $fm->formatDate($value['date']); ?></h6>
								</figcaption>
							</figure>
						</div>
						<?php } ?>
					</div>
				<?php  } ?>
			</div>
		</div>
	</div>
</main>


<!-- SideNav -->
	<?php include 'inc/footer.php'; ?>
<!-- SideNav -->
