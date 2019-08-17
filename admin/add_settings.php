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
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])){

		$addSettings = $settings->addSettings($_POST);
    }
   ?>
<!-- End of Passing input -->

<?php
	$result = $settings->getAllSettings();
	if(mysqli_num_rows($result) > 0){
		$fm->setMsg('msg','Please Update Existing Settings...');
	    $fm->redirect('settings.php');
	}

?>


<main class="pt mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto pt-5">
				<h2 class="text-center mt-5">Add Settings</h2>
				<?php
					echo $fm->getMsg('msg_notify');
					//getting errors on form
				    $err = $fm->getMsg('errors');
					//getting data back which was entered on form
				    $data = $fm->getMsg('form_data');
			    ?>

			    <form method="POST" >

					<div class="form-group">
						<input
						type="text"
						name="name"
						placeholder="Site Name"
						class="form-control <?php echo(isset($err['name_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['name']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['name_error']); ?>
	                    </span>
					</div>


					<div class="form-group">
						<input
						type="text"
						name="address"
						placeholder="Site Address"
						class="form-control <?php echo(isset($err['address_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['address']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['address_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="phone"
						placeholder="Site Phone"
						class="form-control <?php echo(isset($err['phone_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['phone']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['phone_error']); ?>
	                    </span>
					</div>


					<div class="form-group">
						<input
						type="email"
						name="email"
						placeholder="Site Email"
						class="form-control <?php echo(isset($err['email_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['email']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['email_error']); ?>
	                    </span>
					</div>
					<span class="lead">Socal Settings Are Not Required</span>

					<div class="form-group mt-3">
						<input
						type="text"
						name="facebook"
						placeholder="Facebook Link"
						class="form-control <?php echo(isset($err['facebook_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['facebook']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['facebook_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="linkedin"
						placeholder="LinkedIn Link"
						class="form-control <?php echo(isset($err['linkedin_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['linkedin']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['linkedin_error']); ?>
	                    </span>
					</div>


					<div class="form-group">
						<input
						type="text"
						name="instagram"
						placeholder="Instagram Link"
						class="form-control <?php echo(isset($err['instagram_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['instagram']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['instagram_error']); ?>
	                    </span>
					</div>



					<div class="form-group">
						<input type="submit" class="btn btn-dark btn-block" name="add" value="Add Settings">
					</div>

				</form>
			</div>
		</div>
	</div>
</main>




<!-- SideNav -->
	<?php include 'inc/footer.php'; ?>
<!-- SideNav -->
