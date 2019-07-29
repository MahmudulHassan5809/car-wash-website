<!-- Header -->
	<?php include 'inc/login_header.php'; ?>
<!-- End Header -->

<!-- checkLogin -->
	<?php Session::checkLogin(); ?>
<!-- checkLogin -->

<!-- Passed Form Input To Admin Class -->
  <?php
    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['login'])){
		$adminLogin = $ad->login($_POST);
    }
   ?>
<!-- End of Passing input -->


	<div class="container pt-5">
		<div class="row align-items-center justify-content-center" style="height:50vh;">

			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card card-signin my-5">
					<div class="card-body">
						<h5 class="card-title text-center">Admin Login</h5>
						<?php
							echo $fm->getMsg('msg_notify');

		                	//getting errors on form
			                $err = $fm->getMsg('errors');



			                //getting data back which was entered on form
			                $data = $fm->getMsg('form_data');

			            ?>
						<form class="form-signin" method="POST">
							<div class="form-label-group">
				                <input
			                    type="text"
			                    name="email"
			                    placeholder="Admin Email"
			                    value="<?php echo($data['email']); ?>"
			                    class="form-control <?php echo(isset($err['email_error'])) ? 'is-invalid' : ''; ?>"
			                    id="inputEmail"
			                    >

				                <label for="inputEmail">Email address</label>

				                <span class="invalid-feedback">
			                    	<?php echo($err['email_error']); ?>
			                    </span>

				            </div>

				            <div class="form-label-group">
				               <input
			                    type="password"
			                    name="password"
			                    placeholder="Password"
			                    class="form-control <?php echo(isset($err['password_error'])) ? 'is-invalid' : ''; ?>"
			                    value="<?php echo($data['password']); ?>"
			                    id="inputPassword"
			                    >

								<label for="inputPassword">Password</label>

				                <span class="invalid-feedback">
			                    	<?php echo $err['password_error'] ?>
			                    </span>
				            </div>

							<div class="form-group">
			                	<input type="submit" class="btn btn-lg btn-primary btn-block text-uppercase" name="login" value="Login">
							</div>

						</form>
					</div>
				</div>
			</div>

		</div>
	</div>



<!-- Footer -->
	<?php include 'inc/footer.php'; ?>
<!-- Footer -->

