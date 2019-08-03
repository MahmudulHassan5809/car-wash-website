<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>

<!-- Check Session -->
<?php Session::checkUserSession(); ?>
<!-- End Of Check Session -->

<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">
			<div class="col-md-10 mx-auto">
				<h2 class="text-center">Wellcome <?php echo Session::get('userName'); ?></h2>
				<h3 class="text-center">Your Request</h3>
				<hr class="hr-dark">
					<table class="table table-hover table-inverse">
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
							$result = $request->getAllRequestForUser();
							$i = 0;
							if($result){
								while($value = $result->fetch_assoc()){
								$i++;
								?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $value['service_name']; ?></td>
								<td><?php echo $value['service_phone']; ?></td>
								<td><?php echo $value['request_date']; ?></td></td>
							</tr>
							<?php } } ?>
						</tbody>
					</table>

			</div>
		</div>
	</div>
</main>

<?php include 'inc/footer.php'; ?>
