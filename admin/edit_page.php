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

		$editPage = $page->editPage($_POST,$id);
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
					$pageById=$page->pageById($id);
					if ($pageById) {
						while ($value=$pageById->fetch_assoc()) {
				?>
				<form method="POST" >

					<div class="form-group">
						<input
						type="text"
						name="title"
						placeholder="Page Title"
						class="form-control <?php echo(isset($err['title_error'])) ? 'is-invalid' : ''; ?>"
						value="<?php echo($value['title']); ?>">

						<span class="invalid-feedback">
	                    	<?php echo($err['title_error']); ?>
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
						<input type="submit" class="btn btn-dark btn-block" name="edit" value="Edit Page">
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
