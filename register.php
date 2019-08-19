<?php include 'inc/inc.php'; ?>

<!-- Check Login -->
<?php Session::checkUserLogin(); ?>
<!-- End Of Check Login -->

<!-- Passed Form Input To Admin Class -->
  <?php
    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['register'])){
		$userRegister = $user->register($_POST);
    }
   ?>
<!-- End of Passing input -->


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $fm->title(); ?></title>
	<link rel="stylesheet" href="assets/css/font.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="card bg-warning">
					<article class="card-body mx-auto" style="width: 600px;">
						<h2 class="text-center lead">Car Wash & Reapir Service</h2>
						<h4 class="card-title mt-3 text-center">Create Account</h4>

						<?php echo $fm->getMsg('msg'); ?>
						<?php
						//Getting Errors on Form
                        $err = $fm->getMsg('errors');
						//Getting Data Back Which Was Entered on From
                        $data = $fm->getMsg('form_data');
						?>
						<form method="POST">

							<div class="form-group input-group">
								<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fas fa-user"></i> </span>
								 </div>
						        <input
						        name="full_name"
						       	class="form-control form-control-lg <?php echo(isset($err['full_name_error'])) ? 'is-invalid' : ''; ?>"
						        placeholder="Full name"
						        value="<?php echo($data['full_name']); ?>"
						        type="text">

						          <span class="invalid-feedback"><?php echo($err['full_name_error']); ?></span>
						    </div>

						    <div class="form-group input-group">
						    	<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fas fa-envelope"></i> </span>
								 </div>
						        <input
						        name="email"
						        class="form-control form-control-lg <?php echo(isset($err['email_error'])) ? 'is-invalid' : ''; ?>"
						        placeholder="Email address"
						        value="<?php echo($data['email']); ?>"
						        type="email">

						        <span class="invalid-feedback"><?php echo($err['email_error']); ?></span>
						    </div>

						    <div class="form-group input-group">
						    	<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fas fa-phone"></i> </span>
								</div>

						    	<input
						    	name="phone"
						    	class="form-control form-control-lg <?php echo(isset($err['phone_error'])) ? 'is-invalid' : ''; ?>"
						    	placeholder="Phone number"
						    	value="<?php echo($data['phone']); ?>"
						    	type="text">

						    	<span class="invalid-feedback"><?php echo($err['phone_error']); ?></span>
						    </div>

						    <div class="form-group input-group">
						    	<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fas fa-building"></i> </span>
								</div>

								<select class="form-control" name="user_type">
									<option selected="">Select User type</option>
									<?php
										$result = $userCategory->getAllCategory();
										if($result){
											while ($value = $result->fetch_assoc()) {
									?>
									<option value="<?php echo $value['id']; ?><"><?php echo $value['name']; ?></option>
									<?php } } ?>
								</select>
							</div>

						    <div class="form-group input-group">
						    	<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
								</div>

						        <input
						        class="form-control form-control-lg <?php echo(isset($err['password_error'])) ? 'is-invalid' : ''; ?>"
						        placeholder="Create password"
						        value="<?php echo($data['password']); ?>"
						        name="password"
						        type="password">

						        <span class="invalid-feedback"><?php echo($err['password_error']); ?></span>
						    </div>

						    <div class="form-group input-group">
						    	<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
								</div>

						        <input
						        class="form-control form-control-lg <?php echo(isset($err['confirm_password_error'])) ? 'is-invalid' : ''; ?>"
						        placeholder="Repeat password"
						        value="<?php echo($data['confirm_password']); ?>" name="confirm_password"
						        type="password">

						        <span class="invalid-feedback"><?php echo($err['confirm_password_error']); ?></span>
						    </div>

						    <div class="form-group">
						        <button type="submit" class="btn btn-primary btn-block" name="register"> Create Account  </button>
						    </div>

						    <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>

						</form>
					</article>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
