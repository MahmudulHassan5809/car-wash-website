<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>

<!-- Check Session -->
<?php Session::checkUserSession(); ?>
<!-- End Of Check Session -->

<?php $user->checkServieProvider(); ?>


<!-- Passed Form Input To Service Class -->
  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])){

		$addService = $service->addService($_POST,$_FILES);
    }
   ?>
<!-- End of Passing input -->

<?php
	if ($category->getAllCategory() === false) {
		$fm->setMsg('msg_notify','There Is No Category Available');
		$fm->redirect('index.php');
	}
?>


<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center">Add Your Service</h3>
					<?php
					echo $fm->getMsg('msg_notify');
					//getting errors on form
				    $err = $fm->getMsg('errors');
					//getting data back which was entered on form
				    $data = $fm->getMsg('form_data');
			    	?>
					<form method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<input
							type="text"
							name="name"
							placeholder="Service Name"
							class="form-control <?php echo(isset($err['name_error'])) ? 'is-invalid' : ''; ?>"
							value="<?php echo($data['name']); ?>">

							<span class="invalid-feedback">
		                    	<?php echo($err['name_error']); ?>
		                    </span>
						</div>

						<div class="form-group">
							<input
							type="text"
							name="location"
							placeholder="Service Location"
							class="form-control <?php echo(isset($err['location_error'])) ? 'is-invalid' : ''; ?>"
							value="<?php echo($data['location']); ?>">

							<span class="invalid-feedback">
		                    	<?php echo($err['location_error']); ?>
		                    </span>
						</div>

						<div class="form-group">
							<input
							type="text"
							name="phone"
							placeholder="Service Phone Number"
							class="form-control <?php echo(isset($err['phone_error'])) ? 'is-invalid' : ''; ?>"
							value="<?php echo($data['phone']); ?>">

							<span class="invalid-feedback">
		                    	<?php echo($err['phone_error']); ?>
		                    </span>
						</div>

						<div class="form-group">
							<select class="form-control <?php echo(isset($err['category_error'])) ? 'is-invalid' : ''; ?>" name="category_id">
								<option value="" selected>Choose Category</option>
								<?php
								$result = $category->getAllCategory();
								if($result){
									while ($value = $result->fetch_assoc()) {

								?>
								<option value="<?php echo $value['id']; ?> "><?php echo $value['name']; ?> </option>
								<?php } } ?>
							</select>

							<span class="invalid-feedback">
		                    	<?php echo($err['category_error']); ?>
		                    </span>
						</div>

						<div class="form-group">
							<input
							type="text"
							name="price"
							placeholder="Service Price"
							class="form-control <?php echo(isset($err['price_error'])) ? 'is-invalid' : ''; ?>"
							value="<?php echo($data['price']); ?>">

							<span class="invalid-feedback">
		                    	<?php echo($err['price_error']); ?>
		                    </span>
						</div>

						<div class="form-group">
							<textarea
							name="description"
							id="summernote"
							placeholder="Description"
							class="form-control <?php echo(isset($err['description_error'])) ? 'is-invalid' : ''; ?>"><?php echo($data['description']); ?></textarea>

							<span class="invalid-feedback">
		                    	<?php echo($err['description_error']); ?>
		                    </span>
						</div>

						<div class="form-group">
							<input type="file" name="image" class="form-control-file  <?php echo(isset($err['file_error'])) ? 'is-invalid' : ''; ?>">

							<span class="invalid-feedback">
		                    	<?php echo($err['file_error']); ?>
		                    </span>
						</div>

						<input type="hidden" name="redirect" value="index.php">

						<input type="hidden" name="service_provider" value="1">

						<div class="form-group">
							<input type="submit" class="btn btn-dark btn-block" name="add" value="Add Service">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>


<?php include 'inc/footer.php'; ?>
