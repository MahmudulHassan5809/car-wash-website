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

				<?php echo $fm->getMsg('msg'); ?>

				<?php echo $fm->getMsg('msg_notify'); ?>

				<table  id="dtBasicExample" class="table table-striped table-bordered table-sm mt-2" cellspacing="0" width="100%">
					<thead>
						<tr>
	                        <th class="th-sm">No</th>
	                        <th class="th-sm">Name</th>
	                        <th class="th-sm">Service Category</th>
	                        <th class="th-sm">Service Phone</th>
	                        <th class="th-sm">Provider Name</th>
	                        <th class="th-sm">Price</th>
	                        <th class="th-sm">Description</th>
	                        <th class="th-sm">Image</th>
	                        <th class="th-sm">Action</th>
	                        <th class="th-sm">Delete</th>
	                    </tr>
					</thead>

					<tbody>
						<tr>
						<?php
							$i = 0;
							$result=$service->getAllServiceForAdmin();
					        if($result){

					        	while($value=$result->fetch_assoc()) {
					        		$i++;

					    ?>
					    	<td><?php echo($i) ?></td>
					    	<td><?php echo($value['name']); ?></td>
					    	<td><?php echo($value['cat_name']); ?></td>
					    	<td><?php echo($value['service_phone']); ?></td>
					    	<td><?php echo($value['provider_name']); ?></td>
					    	<td><?php echo($value['price']); ?></td>
					    	<td><?php echo htmlspecialchars_decode($fm->textShorten($value['description'],50)); ?></td>
					    	<td>
					    		<img
					    		src="upload/<?php echo($value['image']); ?>"
					    		alt="<?php echo($value['name']); ?>"
					    		class="img-fluid" style="width: 150px;">
					    	</td>
					    	<td>
					    		<?php if ($value['is_active'] == 1): ?>
					    			<a href="edit_action.php?id=<?php echo $value['id'] ;?>" class="btn btn-xs btn-danger">
					    				Inactive
					    			</a>
					    		<?php else: ?>
					    			<a href="edit_action.php?id=<?php echo $value['id'] ;?>" class="btn btn-xs btn-success">
					    				Active
					    			</a>
					    		<?php endif ?>
					    	</td>
					    	<td>
					    		<a onclick="return confirm('Are You Sure');" href="delete_service.php?id=<?php echo $value['id'] ;?>&action=admin" class="btn btn-danger">
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
