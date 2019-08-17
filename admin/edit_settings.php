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
		$fm->redirect('page.php');
	}else{
		$id=$_GET['id'];
	}
?>


<!-- Passed Form Input To Service Class -->
  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])){

		$editSettings = $settings->editSettings($_POST,$id);
    }
   ?>
<!-- End of Passing input -->



<main class="pt-5 mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto pt-5">
				<h2 class="text-center">Edit Category</h2>
				<?php

					echo $fm->getMsg('msg_notify');
					//getting errors on form
				    $err = $fm->getMsg('errors');

			    ?>
			    <?php
					$settingsById = $settings->settingsById($id);
					if ($settingsById) {
						while ($value=$settingsById->fetch_assoc()) {
				?>
				<form method="POST" >

					<div class="form-group">
						<input
						type="text"
						name="name"
						placeholder="Comapny Name"
						class="form-control <?php echo(isset($err['name_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['name']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['name_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="address"
						placeholder="Comapny address"
						class="form-control <?php echo(isset($err['address_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['address']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['address_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="phone"
						placeholder="Comapny phone"
						class="form-control <?php echo(isset($err['phone_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['phone']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['phone_error']); ?>
	                    </span>
					</div>


					<div class="form-group">
						<input
						type="email"
						name="email"
						placeholder="Comapny email"
						class="form-control <?php echo(isset($err['email_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['email']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['email_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="facebook"
						placeholder="Comapny facebook"
						class="form-control <?php echo(isset($err['facebook_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['facebook']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['facebook_error']); ?>
	                    </span>
					</div>


					<div class="form-group">
						<input
						type="text"
						name="linkedin"
						placeholder="Comapny linkedin"
						class="form-control <?php echo(isset($err['linkedin_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['linkedin']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['linkedin_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="instagram"
						placeholder="Comapny instagram"
						class="form-control <?php echo(isset($err['instagram_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['instagram']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['instagram_error']); ?>
	                    </span>
					</div>



					<div class="form-group">
						<input type="submit" class="btn btn-dark btn-block" name="edit" value="Edit Settings">
					</div>
				</form>
				<?php } } ?>
			</div>
		</div>
	</div>
</main>


<!-- SideNav -->
	<?php include 'inc/footer.php'; ?>
<!-- SideNav -->
