<!-- Header -->
	<?php include 'inc/header.php'; ?>
<!-- End Header -->


<!-- TopNav -->
	<?php include 'inc/top_nav.php'; ?>
<!-- TopNav -->

<!-- SideNav -->
	<?php include 'inc/side_nav.php'; ?>
<!-- SideNav -->

<main class="pt-5 mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12 pt-5 mb-3">
				<?php echo $fm->getMsg('msg'); ?>

				<?php echo $fm->getMsg('msg_notify'); ?>
				<table  id="dtBasicExample" class="table table-striped table-bordered table-sm mt-2" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Full Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>User Type</th>
							<th>User Service/Request</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$allProvider = $service->allUsers();
							if($allProvider){
								while($value = $allProvider->fetch_assoc()){

						?>

						<tr>
							<td><?php echo $value['full_name']; ?></td>
							<td><?php echo $value['email']; ?></td>
							<td><?php echo $value['phone']; ?></td>
							<td><?php echo $value['user_type']; ?></td>
							<?php if ($value['user_type'] === 'Service Provider'): ?>
								<td>
									<a href="provider_service.php?id=<?php echo $value['user_id'] ;?>&user_name=<?php echo $value['full_name'] ;?>">View All Service</a>
								</td>
							<?php else: ?>
								<td>
									<a href="user_request.php?id=<?php echo $value['user_id'] ;?>&user_name=<?php echo $value['full_name'] ;?>">View All Request</a>
								</td>
							<?php endif ?>


						</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>


<!-- SideNav -->
	<?php include 'inc/footer.php'; ?>
<!-- SideNav -->
