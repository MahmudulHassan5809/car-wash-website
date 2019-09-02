<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>


<?php include 'inc/search.php'; ?>

<?php
	require 'vendor/autoload.php';
	use Carbon\Carbon;
?>


<!-- Passed Form Input To Service Class -->
  <?php
    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['search'])){
    	$searchService = $service->searchService($_POST);
    }
   ?>
<!-- End of Passing input -->


<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">
			<div class="row">
				<div class="col-md-12">


					<h2 class="text-danger text-center mb-4">Serv<i class="fas fa-tools"></i>ices</h2>
					<p class="lead text-justify text-center mb-5">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero officia ut nemo minus aspernatur a fugit commodi, velit dolore incidunt repudiandae amet saepe quo non quos modi, ab voluptatem quasi.
					</p>

					<div class="row">
						<?php

						if (isset($searchService)) {
							if($searchService == true){
							while($value = $searchService->fetch_assoc()) { ?>

							<div class="col-md-6">
								<!-- Card Light -->
								<div class="card" style="height: 600px;">

									<!-- Card image -->
									<div class="view overlay">
									    <img class="card-img-top img-thumbnail" src="admin/upload/<?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>">
									    <a>
									      <div class="mask rgba-white-slight"></div>
									    </a>
									</div>

									<!-- Card content -->
									<div class="card-body">

									    <!-- Social shares button -->
									    <a class="activator waves-effect waves-light mr-4"><i class="fas fa-share-alt"></i></a>
									    <!-- Title -->
									    <h4 class="card-title"><?php echo($value['name']); ?></h4>
									    <hr>
									    <!-- Text -->
									    <p class="card-text"><?php echo htmlspecialchars_decode($fm->textShorten($value['description'],100)); ?></p>
									    <p>
									    	Service Added At : <?php echo Carbon::parse($value['date'])->diffForHumans(); ?>

									    </p>
									    <!-- Link -->
									    <a href="request.php?id=<?php echo $value['id'] ;?>" class="text-info d-flex justify-content-start">
									    	<h5>
										    	Request For Service
										    </h5>
										</a>

									    <a href="service.php?id=<?php echo $value['id'] ;?>" class="black-text d-flex justify-content-end"><h5>Read more <i class="fas fa-angle-double-right"></i></h5></a>

									</div>

								</div>
								<br>
								<!-- Card Light -->
							</div>

						<?php } } } ?>
					</div>





	              </div>
			</div>
		</div>

	</div>
</main>






<?php include 'inc/footer.php'; ?>


