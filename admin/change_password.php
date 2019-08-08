<!-- Header -->
	<?php include 'inc/header.php'; ?>
<!-- End Header -->


<!-- Header -->
	<?php include 'inc/top_nav.php'; ?>
<!-- End Header -->

<!-- Header -->
	<?php include 'inc/side_nav.php'; ?>
<!-- End Header -->


<!-- Passed Form Input To Service Class -->
  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_password'])){

		$changePassword = $ad->changePassword($_POST);
    }
   ?>
<!-- End of Passing input -->

<main class="pt-5 mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto pt-5">
				<?php
                echo $fm->getMsg('msg');

                echo $fm->getMsg('msg_notify');
                //getting errors on form
                $err = $fm->getMsg('errors');

                //getting data back which was entered on form
                $data = $fm->getMsg('form_data');
                ?>

                <form method="POST">

                	<div class="form-group">
                        <label for='password'>Old Password: <sup>*</sup></label>

                        <input type='password' name="old_password"  value="<?php echo($data['old_password']); ?>" class="form-control form-control-lg <?php echo(isset($err['old_password_error'])) ? 'is-invalid' : ''; ?>">

                      	<span class="invalid-feedback"><?php echo($err['old_password_error']); ?></span>
                    </div>

                    <div class="form-group">
                        <label for='password'>Password: <sup>*</sup></label>
                        <input type='password' name="password" value="<?php echo($data['password']); ?>" class="form-control form-control-lg <?php echo(isset($err['password_error'])) ? 'is-invalid' : ''; ?>">
                         <span class="invalid-feedback"><?php echo($err['password_error']); ?></span>
                    </div>

                    <div class="form-group">
                        <label for='confirm_password'>Confirm Password: <sup>*</sup></label>
                        <input type='password' name="confirm_password" value="<?php echo($data['confirm_password']); ?>" class="form-control form-control-lg <?php echo(isset($err['confirm_password_error'])) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo($err['confirm_password_error']); ?></span>
                    </div>

                    <div class="form-group">
                    	 <input type='submit' name='reset_password' value='Reset Password' class='btn btn-info  btn-block'>
                    </div>

                </form>
			</div>
		</div>
	</div>
</main>
