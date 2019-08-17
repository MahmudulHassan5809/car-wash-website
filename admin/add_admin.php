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

		$addAdmin = $ad->addAdmin($_POST);
    }
   ?>
<!-- End of Passing input -->


<main class="pt-5 mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto pt-5">
				<h2 class="text-center">Add Admin</h2>
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
						placeholder="Admin Name"
						class="form-control <?php echo(isset($err['name_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['name']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['name_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="email"
						placeholder="Admin Email"
						class="form-control <?php echo(isset($err['email_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['email']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['email_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="password"
						name="password"
						placeholder="Admin Password"
						class="form-control <?php echo(isset($err['password_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['password']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['password_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="phone"
						placeholder="Admin Phone"
						class="form-control <?php echo(isset($err['phone_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['phone']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['phone_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-dark btn-block" name="add" value="Add Admin">
					</div>

				</form>
			</div>
		</div>
	</div>
</main>


<!-- SideNav -->
	<?php include 'inc/footer.php'; ?>
<!-- SideNav -->
