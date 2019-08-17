<?php include 'inc/header.php'; ?>

<?php include 'inc/top_nav.php'; ?>

<?php include 'inc/carousel.php'; ?>


<main>
	<div class="container">
		<div class="mt-5 wow fadeIn">

			<!-- Section: Contact v.3 -->
			<section class="contact-section my-5">
				<p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        		a matter of hours to help you.</p>
				<!-- Form with header -->
				<div class="card">

					<!-- Grid row -->
					<div class="row">

						<!-- Grid column -->
						<div class="col-lg-8">

							<div class="card-body form">

								<!-- Header -->
								<h3 class="mt-4"><i class="fas fa-envelope pr-2"></i>Write to us:</h3>
								<div id="status"></div>
								<form id="contact-form" name="contact-form">
									<!-- Grid row -->
									<div class="row">

										<!-- Grid column -->
										<div class="col-md-6">
											<div class="md-form mb-0">
												<input type="text" name="name" id="name" class="form-control">
												<label for="name" class="">Your name</label>
											</div>
										</div>
										<!-- Grid column -->

										<!-- Grid column -->
										<div class="col-md-6">
											<div class="md-form mb-0">
												<input type="text" name="email" id="email" class="form-control">
												<label for="email" class="">Your email</label>
											</div>
										</div>
										<!-- Grid column -->

									</div>
									<!-- Grid row -->

									<!-- Grid row -->
									<div class="row">

										<!-- Grid column -->
										<div class="col-md-6">
											<div class="md-form mb-0">
												<input type="text" name="phone"  id="phone" class="form-control">
												<label for="phone" class="">Your phone</label>
											</div>
										</div>
										<!-- Grid column -->


										<!-- Grid column -->
										<div class="col-md-6">
											<div class="md-form mb-0">
												<input type="text" name="subject"  id="subject" class="form-control">
												<label for="subject" class="">Subject</label>
											</div>
										</div>
										<!-- Grid column -->

									</div>
									<!-- Grid row -->

									<!-- Grid row -->
									<div class="row">

										<!-- Grid column -->
										<div class="col-md-12">
											<div class="md-form mb-0">
												<textarea name="message" id="message" class="form-control  md-textarea" rows="3"></textarea>
												<label for="message">Your message</label>
												<a onclick="validateForm()" class="btn-floating btn-lg blue">
													<i class="far fa-paper-plane"></i>
												</a>
											</div>
										</div>
										<!-- Grid column -->

									</div>
									<!-- Grid row -->
								</form>

							</div>

						</div>
						<!-- Grid column -->

						<!-- Grid column -->
						<div class="col-lg-4">

							<div class="card-body contact text-center h-100 dark-text info-color-dark">

								<h3 class="my-4 pb-2">Contact information</h3>
								<?php
									$result = $settings->getAllSettings();
									if($result){
										while($value = $result->fetch_assoc()){

								?>
								<ul class="text-lg-left list-unstyled ml-4">
									<li>
										<p><i class="fas fa-map-marker-alt pr-2"></i><?php echo $value['address']; ?></p>
									</li>
									<li>
										<p><i class="fas fa-phone pr-2"></i><?php echo $value['phone']; ?></p>
									</li>
									<li>
										<p><i class="fas fa-envelope pr-2"></i><?php echo $value['email']; ?></p>
									</li>
								</ul>

								<hr class="hr-light my-4">

								<ul class="list-inline text-center list-unstyled">
									<?php if (strlen($value['facebook']) > 0): ?>
										<li class="list-inline-item">
											<a class="text-dark" href="<?php echo $value['facebook'] ?>" class="p-2 fa-lg tw-ic">
												<i class="fab fa-facebook"></i>
											</a>
										</li>
									<?php endif ?>

									<?php if (strlen($value['linkedin']) > 0): ?>
										<li class="list-inline-item">
											<a class="text-dark" href="<?php echo $value['linkedin'] ?>" class="p-2 fa-lg tw-ic">
												<i class="fab fa-linkedin-in"></i>
											</a>
										</li>
									<?php endif ?>

									<?php if (strlen($value['instagram']) > 0): ?>
										<li class="list-inline-item">
											<a class="text-dark" href="<?php echo $value['instagram'] ?>" class="p-2 fa-lg tw-ic">
												<i class="fab fa-instagram"></i>
											</a>
										</li>
									<?php endif ?>
								</ul>

								<?php } } ?>
							</div>

						</div>
						<!-- Grid column -->

					</div>
					<!-- Grid row -->

				</div>
				<!-- Form with header -->

			</section>
			<!-- Section: Contact v.3 -->

		</div>
	</div>
</main>






<?php include 'inc/footer.php'; ?>
