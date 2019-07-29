<!-- Header -->
	<?php include 'inc/header.php'; ?>
<!-- End Header -->


<!-- TopNav -->
	<?php include 'inc/top_nav.php'; ?>
<!-- End TopNav -->

<!-- SideNav -->
	<?php include 'inc/side_nav.php'; ?>
<!-- End SideNav -->



<!-- Passed Form Input To Service Class -->
  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['service'])){

		$addService = $service->addService($_POST,$_FILES);
    }
   ?>
<!-- End of Passing input -->


<?php
	if ($category->getAllCategory() === false) {
		$fm->setMsg('msg_notify','There Is No Category .Please Add Some Category');
		$fm->redirect('add_category.php');
	}
?>


<main class="pt-5 mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto pt-5">
				<h2 class="text-center">Add Service</h2>
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

					<input type="hidden" name="redirect" value="add_category.php">

					<div class="form-group">
						<input type="submit" class="btn btn-dark btn-block" name="service" value="Add Service">
					</div>
				</form>
			</div>
		</div>
	</div>
</main>


<!-- SideNav -->
	<?php include 'inc/footer.php'; ?>
<!-- SideNav -->

