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

				<a href="add_admin.php" class="btn-floating deep-purple"><i class="fas fa-plus fa-3x" title="Add Admin" aria-hidden="true"></i></a>

				<?php echo $fm->getMsg('msg'); ?>

				<?php echo $fm->getMsg('msg_notify'); ?>

				<table  id="dtBasicExample" class="table table-striped table-bordered table-sm mt-2" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Type</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$allAdmin = $ad->allAdmin();
							if($allAdmin){
								while($value = $allAdmin->fetch_assoc()){
						?>

						<tr>
							<td><?php echo $value['name']; ?></td>
							<td><?php echo $value['email']; ?></td>
							<td><?php echo $value['phone']; ?></td>
							<?php if ($value['admin_type'] == 1): ?>
								<td>Main Admin</td>
							<?php else: ?>
								<td>Co Admin</td>
							<?php endif ?>
							<td>
								<a href="edit_admin.php?id=<?php echo $value['id']; ?>">
									<i class="fas fa-user-edit"></i>
								</a>
							</td>
							<?php if ($value['admin_type'] == 0): ?>
								<td>
									<a onclick="return confirm('Are You Sure?');" href="delete_admin.php?id=<?php echo $value['id']; ?>">
										<i class="fas fa-user-times"></i>
									</a>
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
