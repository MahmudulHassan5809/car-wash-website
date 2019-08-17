<!-- Header -->
<?php include 'inc/header.php'; ?>
<!-- End Header -->


<!-- Header -->
<?php include 'inc/top_nav.php'; ?>
<!-- End Header -->

<!-- Header -->
<?php include 'inc/side_nav.php'; ?>
<!-- End Header -->

<main class="pt-5 mx-lg-5">
	<div class="container mt-5">
		<div class="row">

			<div class="col-md-10 mx-auto">

				<div class="row">
					<div class="col-md-5">
						<div class="card shadow h-100 py-2">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-info mb-1">Total Serevice Provider</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800">
											<?php echo $service->totalServiceProvider();  ?>
										</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-calendar fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-5">
						<div class="card shadow h-100 py-2">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-info mb-1">Total Serevices</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800">
											<?php echo $service->totalServices();  ?>
										</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-calendar fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-5">
					<div class="col-md-5">
						<div class="card shadow h-100 py-2">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-info mb-1">Total Users</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800">
											<?php echo $service->totalUsers();  ?>
										</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-calendar fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-5">
						<div class="card shadow h-100 py-2">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-info mb-1">Total Requests</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800">
											<?php echo $request->totalRequests();  ?>
										</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-calendar fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-5">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body bg-secondary">
								<div id="piechart" style="width: 700px; height: 300px;">

								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>
	</div>
</main>


<!-- Footer -->
<?php include 'inc/footer.php'; ?>
<!-- End Footer -->
