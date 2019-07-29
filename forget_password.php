<?php include 'inc/inc.php'; ?>

<!-- Check Login -->
<?php Session::checkUserLogin(); ?>
<!-- End Of Check Login -->


  <?php
    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['send'])){

        $forgetPassword = $user->forgetPassword($_POST);
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
	<link rel="stylesheet" href="assets/css/login_style.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-5">

				<div class="d-flex justify-content-center h-100">
					<div class="card">
						<div class="card-header">
							<h3>Send Link</h3>
                			<p class="text-white">Please fill in credentials to Get Link.</p>
                			<?php echo $fm->getMsg('msg'); ?>
						</div>
						<div class="card-body">

							<?php
								//getting errors on form
                   				 $err = $fm->getMsg('errors');

                    			//getting data back which was entered on form
                    			$data = $fm->getMsg('form_data');
							?>
							<form method="POST">
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input
									type='text'
									name="email"
									placeholder="Email"
									value="<?php echo($data['email']); ?>" class="form-control form-control-lg <?php echo(isset($err['email_error'])) ? 'is-invalid' : ''; ?>">
                        			<span class="invalid-feedback"><?php echo($err['email_error']); ?></span>

								</div>


								<div class="form-group">
									<input type="submit" name="send" value="Send Link" class="btn float-right login_btn">
								</div>
							</form>
						</div>
						<div class="card-footer">
							<div class="d-flex justify-content-center links">
								Don't have an account?<a href="<?php echo(URLROOT); ?>/register.php">Sign Up</a>
							</div>
							<div class="d-flex justify-content-center">
								<a href="<?php echo(URLROOT); ?>/login.php">Sign In</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
