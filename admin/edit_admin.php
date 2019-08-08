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
	if(!isset($_GET['id']) or $_GET['id']==NULL){
		$fm->redirect('all_admin.php');
	}else{
		$id=$_GET['id'];
		if($id !== Session::get('adminId')){
			$fm->setMsg('msg_notify','This is Not Your Profile','warning');
			$fm->redirect('all_admin.php');
		}
	}
?>

<!-- Passed Form Input To Service Class -->
  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])){

		$editAdmin = $ad->editAdmin($_POST,$id);
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
					$adminById=$ad->adminById($id);
					if ($adminById) {
						while ($value=$adminById->fetch_assoc()) {
				?>
				<form method="POST" >

					<div class="form-group">
						<input
						type="text"
						name="name"
						placeholder="Admin Name"
						class="form-control <?php echo(isset($err['name_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['name']); ?>">

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
						value="<?php echo($value['email']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['email_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="phone"
						placeholder="Admin Phone"
						class="form-control <?php echo(isset($err['phone_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['phone']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['phone_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-dark btn-block" name="edit" value="Edit">
					</div>
				</form>
				<?php } } ?>
				<a class="btn btn-primary btn-block" href="change_password.php">Change Password</a>
			</div>
		</div>
	</div>
</main>




<!-- SideNav -->
	<?php include 'inc/footer.php'; ?>
<!-- SideNav -->
