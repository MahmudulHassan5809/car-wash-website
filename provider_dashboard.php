<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>

<?php $user->checkServieProvider(); ?>

<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">
			<div class="row">
				<div class="col-md-6">
					<h3 class="text-center">Your Services</h3>
					<?php
						$result = $service->getAllServiceByProvider();
						if($result){
							while ($value = $result->fetch_assoc()) {
					?>
						<a href="edit_service.php?id=<?php echo $value['id'] ;?>"><?php echo $value['name']; ?></a>

					<?php }  } ?>
				</div>
			</div>
		</div>
	</div>
</main>
