<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>

<!-- Check Session -->
<?php Session::checkUserSession(); ?>
<!-- End Of Check Session -->

<?php $user->checkServieProvider(); ?>

<?php
	if(!isset($_GET['id']) or $_GET['id']==NULL){
		$fm->redirect('index.php');
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

<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center">Add Your Service</h3>
					<?php

						echo $fm->getMsg('msg_notify');

						echo $fm->getMsg('msg');
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
						name="area"
						placeholder="Service Area"
						class="form-control <?php echo(isset($err['area_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['area']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['area_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="location"
						placeholder="Service Location"
						class="form-control <?php echo(isset($err['location_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['location']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['location_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<input
						type="text"
						name="phone"
						placeholder="Service Phone Number"
						class="form-control <?php echo(isset($err['phone_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['phone']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['phone_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
						<select class="form-control <?php echo(isset($err['category_error'])) ? 'is-invalid' : ''; ?>" name="category_id">
							<option value="" selected>Choose Category</option>
							<?php
							$result = $category->getAllCategory();
							if($result){
								while ($allCategory = $result->fetch_assoc()) {

							?>
							<option
							<?php

							if ($value['category_id'] == $allCategory['id']): ?>
								selected
							<?php endif ?>
							value="<?php echo $allCategory['id']; ?> "><?php echo $allCategory['name']; ?> </option>
							<?php } } ?>
						</select>

						<span class="invalid-feedback">
	                    	<?php echo($err['category_error']); ?>
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
						<img src="admin/upload/<?php echo $value['image'] ?>" class="img-fluid" width="200px"><br><br>

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
	</div>
</main>


<?php include 'inc/footer.php'; ?>
