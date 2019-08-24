<!-- Header -->
<?php include 'inc/header.php'; ?>
<!-- End Header -->


<!-- Header -->
<?php include 'inc/top_nav.php'; ?>
<!-- End Header -->

<!-- Header -->
<?php include 'inc/side_nav.php'; ?>
<!-- End Header -->

<?php
if(!isset($_GET['id']) or $_GET['id']==NULL){
	$fm->redirect('messages.php');
}else{
	$id=$_GET['id'];
}
?>






<main class="pt-5 mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto pt-5">
				<h2 class="text-center">View Mssage</h2>

				<?php
				$messageById = $cm->messageById($id);
				if ($messageById) {
					while ($value=$messageById->fetch_assoc()) {
						?>

						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Name : <?php echo $value['name']; ?></h5>
								<h6 class="card-subtitle mb-2 text-muted">Subject : <?php echo $value['subject']; ?></h6>
								<p class="card-text">Message : <?php echo $value['message']; ?></p>
								<a class="card-link" onclick="return confirm('Are You Sure?');" href="delete_message.php?id=<?php echo $value['id']; ?>">
									Delete
								</a>

							</div>
						</div>

					<?php } } ?>
				</div>
			</div>
		</div>
	</main>


	<!-- SideNav -->
	<?php include 'inc/footer.php'; ?>
	<!-- SideNav -->
