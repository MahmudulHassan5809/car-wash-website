<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>

<?php $user->checkServieProvider(); ?>

<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">
			<?php echo $fm->getMsg('msg'); ?>

			<?php echo $fm->getMsg('msg_notify'); ?>
			<div class="row">

				<div class="col-md-6">
					<h3 class="text-center">Your Serv<i class="fas fa-tools"></i>ices</h3>
					<hr class="hr-dark">
					<?php
						$result = $service->getAllServiceByProvider();
						if($result){
							while ($value = $result->fetch_assoc()) {
					?>


						<!-- Card -->
						<div class="card card-cascade wider reverse">

							 <!-- Card image -->
							<div class="view view-cascade overlay">
							    <img class="card-img-top" src="admin/upload/<?php echo $value['image'] ?>" alt="Card image cap">
							    <a href="#!">
							      <div class="mask rgba-white-slight"></div>
							    </a>
							</div>

							<!-- Card content -->
							<div class="card-body card-body-cascade text-center">

							    <!-- Title -->
							    <h4 class="card-title"><strong><?php echo $value['name']; ?></strong></h4>
							    <!-- Subtitle -->
							    <h6 class="font-weight-bold indigo-text py-2"><?php echo $value['cat_name']; ?></h6>
							    <!-- Text -->
							    <p class="card-text">
							    	<?php echo $fm->textShorten(htmlspecialchars_decode($value['description']),150) ?>
							    </p>

							    <a href="edit_service.php?id=<?php echo $value['id'] ;?>" class="btn btn-dark">Edit</a>

							    <a href="delete_service.php?id=<?php echo $value['id'] ;?>" class="btn btn-dark">Delete</a>

							</div>

						</div>
						<br>
						<!-- Card -->
					<?php }  } else { ?>
						<div class="alert alert-warning" role="alert">
						  You Dont Have Any Service <a href="add_service.php" class="alert-link">Add Service</a>. Give it a click if you like.
						</div>
					<?php }  ?>
				</div>

				<div class="col-md-6" style="border-left: 1px dashed #333;">
					<h3 class="text-center text-success">Your <i class="fas fa-inbox"></i> Request</h3>

						<table class="table table-responsive table-inverse">
							<thead>
								<tr>
									<th>Client Name</th>
									<th>Client Email</th>
									<th>Client Phone</th>
									<th>Service Name</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$result = $request->getAllRequestForProvider();
									if($result){
										while ($value = $result->fetch_assoc()) {
								?>
								<tr>
									<td><?php echo $value['user_name'] ?></td>
									<td><?php echo $value['email'] ?></td>
									<td><?php echo $value['phone'] ?></td>
									<td><?php echo $value['service_name'] ?></td>
								</tr>
								<?php } } ?>
							</tbody>
						</table>


				</div>
			</div>
		</div>
	</div>
</main>


<?php include 'inc/footer.php'; ?>
