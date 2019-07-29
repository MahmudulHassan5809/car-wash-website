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
		$fm->redirect('service.php');
	}else{
		$id=$_GET['id'];
	}
?>


<!-- Passed Form Input To Service Class -->
  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])){

		$editService = $service->editService($_POST,$_FILES,$id);
    }
   ?>
<!-- End of Passing input -->


<main class="pt-5 mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto pt-5">
				<h2 class="text-center">Add Service</h2>
				<?php

					echo $fm->getMsg('msg_notify');
					//getting errors on form
				    $err = $fm->getMsg('errors');

			    ?>
			    <?php
					$serviceById=$service->serviceById($id);
					if ($serviceById) {
						while ($value=$serviceById->fetch_assoc()) {
				?>
				<form method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<input
						type="text"
						name="name"
						placeholder="Service Name"
						class="form-control <?php echo(isset($err['name_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['name']); ?>">

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
						value="<?php echo($value['price']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['price_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<textarea
						name="description"
						id="summernote"
						placeholder="Description"
						class="form-control <?php echo(isset($err['description_error'])) ? 'is-invalid' : ''; ?>"><?php echo($value['description']); ?></textarea>

						<span class="invalid-feedback">
	                    	<?php echo($err['description_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<img src="<?php echo $value['image'] ?>" class="img-fluid" width="200px"><br><br>

						<input type="file" name="image" class="form-control-file  <?php echo(isset($err['file_error'])) ? 'is-invalid' : ''; ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['file_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-dark btn-block" name="edit" value="Edit Service">
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
