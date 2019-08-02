<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>

<?php
  if(!isset($_GET['id']) or $_GET['id']==NULL){
    $fm->redirect('index.php');
  }else
  {
    $id=$_GET['id'];
  }

?>


<!-- Check Session -->
<?php Session::checkUserSession(); ?>
<!-- End Of Check Session -->



<!-- Passed Form Input To Account Class -->
  <?php
    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['confirm'])){

        $request = $request->ConfirmRequest($id);
    }
   ?>
<!-- End of Passing input -->


<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center">Please Confirm Your Request</h3>
					<hr class="hr-dark">
					<ul class="list-group">
						<?php
						$result = $service->getServiceById($id);
					    if($result){
					      while ($value=$result->fetch_assoc()) {
						?>
						<li class="list-group-item">Service Name : <?php echo $value['name']; ?></li>
						<li class="list-group-item">Service Price : <?php echo $value['price']; ?></li>
						<li class="list-group-item">Phone Number : <?php echo $value['phone']; ?></li>
						<li class="list-group-item">Location : <?php echo $value['location']; ?></li>
						<li class="list-group-item">Email : <?php echo $value['email'];
							$_SESSION['provider_email'] = $value['email'];
							$_SESSION['provider_id'] = $value['provider_id'];
						 ?></li>
						<?php } } ?>
					</ul>

					<form method="POST">
						<input class="btn btn-primary" type="submit" name="confirm" value="Confirm">
					</form>

				</div>
			</div>
		</div>
	</div>
</main>


<?php include 'inc/footer.php'; ?>
