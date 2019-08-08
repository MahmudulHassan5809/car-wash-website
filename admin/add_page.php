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

		$addPage = $page->addPage($_POST);
    }
   ?>
<!-- End of Passing input -->


<main class="pt mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto pt-5">
				<h2 class="text-center mt-5">Add Page</h2>
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
						name="title"
						placeholder="Page Title"
						class="form-control <?php echo(isset($err['title_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($data['title']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['title_error']); ?>
	                    </span>
					</div>

					<div class="form-group">
							<textarea
							name="description"
							id="summernote"
							placeholder="Description"
							class="form-control <?php echo(isset($err['description_error'])) ? 'is-invalid' : ''; ?>"><?php echo($data['description']); ?></textarea>

							<span class="invalid-feedback">
		                    	<?php echo($err['description_error']); ?>
		                    </span>
						</div>

					<div class="form-group">
						<input type="submit" class="btn btn-dark btn-block" name="add" value="Add Page">
					</div>

				</form>
			</div>
		</div>
	</div>
</main>




<!-- SideNav -->
	<?php include 'inc/footer.php'; ?>
<!-- SideNav -->
