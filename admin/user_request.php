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
			<div class="col-md-12 mt-5">
				<h3 class="text-center">All Request From <?php echo $userName; ?></h3>
				<hr class="hr-dark">
					<table id="dtBasicExample"  class="table table-hover table-inverse">
						<thead>
							<tr>
								<th>No</th>
								<th>Service Name</th>
								<th>Provider Phone</th>
								<th>Request Date</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$result = $request->getAllRequestForUser($id);
							$i = 0;
							if($result){
								while($value = $result->fetch_assoc()){
								$i++;
								?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $value['service_name']; ?></td>
								<td><?php echo $value['service_phone']; ?></td>

								<td><?php echo $fm->formatDate($value['request_date']); ?></td>

							</tr>
							<?php } } ?>
						</tbody>
					</table>
			</div>

		</div>
	</div>
</main>



<!-- Footer -->
	<?php include 'inc/footer.php'; ?>
<!-- Footer -->

