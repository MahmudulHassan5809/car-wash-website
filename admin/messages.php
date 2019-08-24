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
	require '../vendor/autoload.php';
	use Carbon\Carbon;
?>

<main class="pt-5 mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12 pt-5 mb-3">
				<?php echo $fm->getMsg('msg'); ?>

				<?php echo $fm->getMsg('msg_notify'); ?>
				<table  id="dtBasicExample" class="table table-striped table-bordered table-sm mt-2" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Subject</th>
							<th>Message</th>
							<th>View</th>
							<th>Delete</th>
							<th>Send At</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$allMessage = $cm->allMessages();
							if($allMessage){
								while($value = $allMessage->fetch_assoc()){

						?>

						<tr>
							<td><?php echo $value['name']; ?></td>
							<td><?php echo $value['email']; ?></td>
							<td><?php echo $value['phone']; ?></td>
							<td><?php echo $value['subject']; ?></td>
							<td>
								<?php echo $fm->textShorten($value['message'],200); ?>
							</td>

							<td>
								<a href="view_message.php?id=<?php echo $value['id']; ?>">
									<i class="fas fa-eye"></i>
								</a>
							</td>

							<td>
								<a onclick="return confirm('Are You Sure?');" href="delete_message.php?id=<?php echo $value['id']; ?>">
									<i class="fas fa-trash"></i>
								</a>
							</td>

							<td>
								<?php echo Carbon::parse($value['created_at'])->diffForHumans(); ?>
							</td>


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
