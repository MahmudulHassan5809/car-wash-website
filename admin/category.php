<!-- Header -->
	<?php include 'inc/header.php'; ?>
<!-- End Header -->


<!-- TopNav -->
	<?php include 'inc/top_nav.php'; ?>
<!-- TopNav -->

<!-- SideNav -->
	<?php include 'inc/side_nav.php'; ?>
<!-- SideNav -->

<main class="pt-5 mx-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12 pt-5 mb-3">
				<h2 class="text-center">Service Category</h2>
				<a href="add_category.php" class="btn-floating deep-purple"><i class="fas fa-plus fa-3x" title="Add Service" aria-hidden="true"></i></a>

				<?php echo $fm->getMsg('msg'); ?>

				<?php echo $fm->getMsg('msg_notify'); ?>

				<table  id="dtBasicExample" class="table table-striped table-bordered table-sm mt-2" cellspacing="0" width="100%">
					<thead>
						<tr>
	                        <th class="th-sm">No</th>
	                        <th class="th-sm">Name</th>
	                        <th class="th-sm">Edit</th>
	                        <th class="th-sm">Delete</th>
	                    </tr>
					</thead>

					<tbody>
						<tr>
						<?php
							$i = 0;
							$result=$category->getAllCategory();
					        if($result){
					        	$i++;
					        	while($value=$result->fetch_assoc()) {

					    ?>
					    	<td><?php echo($i) ?></td>
					    	<td><?php echo($value['name']); ?></td>
					    	<td>
					    		<a href="edit_category.php?id=<?php echo $value['id'] ;?>" class="btn btn-success">
					    			<i class="fas fa-edit"></i>
					    		</a>
					    	</td>
					    	<td>
					    		<a onclick="return confirm('Are You Sure');" href="delete_category.php?id=<?php echo $value['id'] ;?>" class="btn btn-danger">
					    			<i class="fas fa-trash"></i>
					    		</a>
					    	</td>
						</tr>
						<?php } } ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</main>


<!-- SideNav -->
	<?php include 'inc/footer.php'; ?>
<!-- SideNav -->
