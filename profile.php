<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>


<!-- Passed Form Input To User Class -->
  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])){

		$editUser = $user->editUser($_POST);
    }
   ?>
<!-- End of Passing input -->



<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">
			<div class="row">
				<div class="col-md-12">
                  <?php

                        echo $fm->getMsg('msg_notify');
                        echo $fm->getMsg('msg');
                        //getting errors on form
                        $err = $fm->getMsg('errors');

                    ?>
                   <?php
                        $getCurrentUserData = $user->getCurrentUserData();
                        if($getCurrentUserData){
                            while($value = $getCurrentUserData->fetch_assoc()){
                     ?>
                     
                     <form method="POST" >

					<div class="form-group">
						<input
						type="text"
						name="full_name"
						placeholder="User Name"
						class="form-control <?php echo(isset($err['full_name_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['full_name']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['full_name_error']); ?>
	                    </span>
					</div>


					<div class="form-group">
						<input
						type="text"
						name="email"
						placeholder="User Email"
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
						placeholder="User Phone"
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
                </div>
            </div>
        </div>
    </div>
    





<?php include 'inc/footer.php'; ?>