
	<?php if($ps->best == 1): ?>
		<!-- Phone and Accessories Area Start -->
		<section class="phone-and-accessories categori-item">
			<div class="container">
				<div style="padding:20px;background:#fff;border-radius:20px;">
				<div class="row" style="padding:20px;">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								<?php echo e($langg->lang27); ?>

							</h2>
						</div>
					</div>
				</div>
				<div class="row" style="padding:20px;">
					<div class="col-lg-9">
						<div class="row">
							<?php $__currentLoopData = $best_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('includes.product.home-product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
					<div class="col-lg-3 remove-padding d-none d-lg-block">
						<div class="aside">
							<a class="banner-effect mb-10" href="<?php echo e($ps->best_seller_banner_link); ?>">
								<img src="<?php echo e(asset('assets/images/'.$ps->best_seller_banner)); ?>" alt="">
							</a>
							<a class="banner-effect" href="<?php echo e($ps->best_seller_banner_link1); ?>">
								<img src="<?php echo e(asset('assets/images/'.$ps->best_seller_banner1)); ?>" alt="">
							</a>
						</div>
					</div>
				</div>
				</div>
			</div>
		</section>
		<!-- Phone and Accessories Area start-->
	<?php endif; ?>

	<?php if($ps->flash_deal == 1): ?>
		<!-- Electronics Area Start -->
		<section class="categori-item electronics-section">
			<div class="container">
				<div style="padding:20px;background:#fff;border-radius:20px;">
				<div class="row" style="padding:20px;">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								<?php echo e($langg->lang244); ?>

							</h2>
						</div>
					</div>
				</div>
				<div class="row" style="padding:20px;">
					<div class="col-lg-12">
						<div class="flash-deals">
							<div class="flas-deal-slider">

								<?php $__currentLoopData = $discount_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php echo $__env->make('includes.product.flash-product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</section>
		<!-- Electronics Area start-->
	<?php endif; ?>

	<?php if($ps->large_banner == 1): ?>
		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container">
				<?php $__currentLoopData = $large_banners->chunk(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="row">
						<?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-lg-12 remove-padding">
								<div class="img">
									<a class="banner-effect" href="<?php echo e($img->link); ?>">
										<img src="<?php echo e(asset('assets/images/banners/'.$img->photo)); ?>" alt="">
									</a>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</section>
		<!-- Banner Area One Start -->
	<?php endif; ?>

	<?php if($ps->top_rated == 1): ?>
		<!-- Electronics Area Start -->
		<section class="categori-item electronics-section">
			<div class="container">
				<div style="padding:20px;background:#fff;border-radius:20px;">
				<div class="row" style="padding:20px;">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								<?php echo e($langg->lang28); ?>

							</h2>
						</div>
					</div>
				</div>
				<div class="row" style="padding:20px;">
					<div class="col-lg-12">
						<div class="row">

							<?php $__currentLoopData = $top_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('includes.product.top-product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</div>
					</div>
				</div>
				</div>
			</div>
		</section>
		<!-- Electronics Area start-->
	<?php endif; ?>

	<?php if($ps->bottom_small == 1): ?>
		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container">
				<?php $__currentLoopData = $bottom_small_banners->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="row">
						<?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-lg-4 remove-padding">
								<div class="left">
									<a class="banner-effect" href="<?php echo e($img->link); ?>" target="_blank">
										<img src="<?php echo e(asset('assets/images/banners/'.$img->photo)); ?>" alt="">
									</a>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</section>
		<!-- Banner Area One Start -->
	<?php endif; ?>

	<?php if($ps->big == 1): ?>
		<!-- Clothing and Apparel Area Start -->
		<section class="categori-item clothing-and-Apparel-Area">
			<div class="container">
				<div style="padding:20px;background:#fff;border-radius:20px;">
				<div class="row" style="padding:20px;">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								<?php echo e($langg->lang29); ?>

							</h2>

						</div>
					</div>
				</div>
				<div class="row" style="padding:20px;">
					<div class="col-lg-9">
						<div class="row">
							<?php $__currentLoopData = $big_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('includes.product.home-product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



						</div>
					</div>
					<div class="col-lg-3 remove-padding d-none d-lg-block">
						<div class="aside">
							<a class="banner-effect mb-10" href="<?php echo e($ps->big_save_banner_link); ?>">
								<img src="<?php echo e(asset('assets/images/'.$ps->big_save_banner)); ?>" alt="">
							</a>
							<a class="banner-effect" href="<?php echo e($ps->big_save_banner_link1); ?>">
								<img src="<?php echo e(asset('assets/images/'.$ps->big_save_banner1)); ?>" alt="">
							</a>
						</div>
					</div>
				</div>
				</div>
			</div>
			</div>
		</section>
		<!-- Clothing and Apparel Area start-->
	<?php endif; ?>

	<?php if($ps->hot_sale == 1): ?>
		<!-- hot-and-new-item Area Start -->
		<section class="hot-and-new-item">
			<div class="container">
				<div style="padding:20px;background:#fff;border-radius:20px;">
				<div class="row" style="padding:20px;">
					<div class="col-lg-12">
						<div class="accessories-slider">
							<div class="slide-item">
								<div class="row">
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													<?php echo e($langg->lang30); ?>

												</h2>
											</div>
											<div class="hot-and-new-item-slider">
												<?php $__currentLoopData = $hot_products->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<div class="item-slide">
														<ul class="item-list">
															<?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<?php echo $__env->make('includes.product.list-product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</ul>
													</div>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</div>

										</div>
									</div>
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													<?php echo e($langg->lang31); ?>

												</h2>
											</div>

											<div class="hot-and-new-item-slider">

												<?php $__currentLoopData = $latest_products->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<div class="item-slide">
														<ul class="item-list">
															<?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<?php echo $__env->make('includes.product.list-product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</ul>
													</div>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													<?php echo e($langg->lang32); ?>

												</h2>
											</div>


											<div class="hot-and-new-item-slider">

												<?php $__currentLoopData = $trending_products->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<div class="item-slide">
														<ul class="item-list">
															<?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<?php echo $__env->make('includes.product.list-product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</ul>
													</div>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											</div>

										</div>
									</div>
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													<?php echo e($langg->lang33); ?>

												</h2>
											</div>

											<div class="hot-and-new-item-slider">

												<?php $__currentLoopData = $sale_products->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<div class="item-slide">
														<ul class="item-list">
															<?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<?php echo $__env->make('includes.product.list-product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</ul>
													</div>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</section>
		<!-- Clothing and Apparel Area start-->
	<?php endif; ?>

	<?php if($ps->review_blog == 1): ?>
		<!-- Blog Area Start -->
		<section class="blog-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="aside">
							<div class="slider-wrapper">
								<div class="aside-review-slider">
									<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="slide-item">
											<div class="top-area">
												<div class="left">
													<img src="<?php echo e($review->photo ? asset('assets/images/reviews/'.$review->photo) : asset('assets/images/noimage.png')); ?>" alt="">
												</div>
												<div class="right">
													<div class="content">
														<h4 class="name"><?php echo e($review->title); ?></h4>
														<p class="dagenation"><?php echo e($review->subtitle); ?></p>
													</div>
												</div>
											</div>
											<blockquote class="review-text">
												<p>
													<?php echo $review->details; ?>

												</p>
											</blockquote>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<?php $__currentLoopData = DB::table('blogs')->orderby('views','desc')->take(2)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							<div class="blog-box">
								<div class="blog-images">
									<div class="img">
										<img src="<?php echo e($blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png')); ?>" class="img-fluid" alt="">
										<div class="date d-flex justify-content-center">
											<div class="box align-self-center">
												<p><?php echo e(date('d', strtotime($blogg->created_at))); ?></p>
												<p><?php echo e(date('M', strtotime($blogg->created_at))); ?></p>
											</div>
										</div>
									</div>

								</div>
								<div class="details">
									<a href='<?php echo e(route('front.blogshow',$blogg->id)); ?>'>
										<h4 class="blog-title">
											<?php echo e(mb_strlen($blogg->title,'utf-8') > 40 ? mb_substr($blogg->title,0,40,'utf-8')."...":$blogg->title); ?>

										</h4>
									</a>
									<p class="blog-text">
										<?php echo e(substr(strip_tags($blogg->details),0,170)); ?>

									</p>
									<a class="read-more-btn" href="<?php echo e(route('front.blogshow',$blogg->id)); ?>"><?php echo e($langg->lang34); ?></a>
								</div>
							</div>

						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</div>
				</div>
			</div>
		</section>
		<!-- Blog Area start-->
	<?php endif; ?>

	<?php if($ps->partners == 1): ?>
	
		<!-- <section class="partners">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-top">
							<h2 class="section-title">
								<?php echo e($langg->lang236); ?>

							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="partner-slider">
							<?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="item-slide">
									<a href="<?php echo e($data->link); ?>" target="_blank">
										<img src="<?php echo e(asset('assets/images/partner/'.$data->photo)); ?>" alt="">
									</a>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>
		</section> -->
		
	<?php endif; ?>

	<?php if($ps->service == 1): ?>

	
	<section class="info-area">
			<div class="container">

					<?php $__currentLoopData = $services->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	
						<div class="row">
	
							<div class="col-lg-12 p-0">
								<div class="info-big-box">
									<div class="row">
										<?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="col-6 col-xl-3 p-0">
												<div class="info-box">
													<div class="icon">
														<img src="<?php echo e(asset('assets/images/services/'.$service->photo)); ?>">
													</div>
													<div class="info">
														<div class="details">
															<h4 class="title"><?php echo e($service->title); ?></h4>
															<p class="text">
																<?php echo $service->details; ?>

															</p>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								</div>
							</div>
	
						</div>
	
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
			</div>
		</section>
		

		<?php endif; ?>		

	<!-- main -->
	<script src="<?php echo e(asset('assets/front/js/mainextra.js')); ?>"></script>