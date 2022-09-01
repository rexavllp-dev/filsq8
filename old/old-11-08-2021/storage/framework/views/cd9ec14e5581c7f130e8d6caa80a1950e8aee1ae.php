

<?php $__env->startSection('content'); ?>

<?php if($ps->slider == 1): ?>

<?php if(count($sliders)): ?>
<?php echo $__env->make('includes.slider-style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php endif; ?>

<?php if($ps->slider == 1): ?>
<!-- Hero Area Start -->
<section class="hero-area">

	<div class="container">

		<div class="row">
			<div class="col-md-3">

			</div>
			<div class="col-md-7">
				<?php if($ps->slider == 1): ?>

				<?php if(count($sliders)): ?>
				<div class="hero-area-slider" style="margin-top:15px;">

					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php $count = 0; ?>
							<?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo e($count); ?>" <?php if($loop->first): ?> class="active" <?php endif; ?>></li>
							<?php $count++; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</ol>
						<div class="carousel-inner" style="border-radius:20px;">

							<?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="carousel-item <?php if($loop->first): ?> active <?php endif; ?>">
								<img class="d-block w-100" src="<?php echo e(asset('assets/images/sliders/'.$data->photo)); ?>" alt="First slide">
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>

					</div>

				</div>
				<?php endif; ?>

				<?php endif; ?>

				<div style="margin-top:15px;">
					<img src="<?php echo e(asset('assets/images/banner2.jpg')); ?>" style="border-radius:20px;">
				</div>
			</div>
			<div class="col-md-2 d-none d-sm-block" style="padding-top:15px;padding-bottom:15px;">

				<div class="row">
					 <div style="background:#fff;min-height:100%;border-radius:20px;padding:10px;width:100%;">
				 		<center><img  src="<?php echo e(asset('assets/images/profpic.png')); ?>" alt="First slide" style="width:30%;"><br>

				 		<p class="text-center" style="font-size:12px;margin-bottom:20px;">Welcome to Showpeklowpek</p>

				 		<a href="<?php echo e(url('user/login')); ?>" class="btn btn-danger btn-block"> Join </a>
				 		<a href="<?php echo e(url('user/login')); ?>" class="btn btn-danger btn-block" style="background:#f9f9f9;border-color:#f9f9f9;color:#000;"> Login </a>
				 		</center>
						<img style="margin-top:15px;" src="<?php echo e(asset('assets/images/right_banner1.jpg')); ?>" alt="First slide">
				 </div>
				</div>
				
			</div>

		</div>


	</div>

</section>
<!-- Hero Area End -->
<?php endif; ?>


<!-- <?php if($ps->featured_category == 1): ?>


<section class="slider-buttom-category d-none d-md-block">
	<div class="container-fluid">
		<div class="row">
			<?php $__currentLoopData = $categories->where('is_featured','=',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-xl-2 col-lg-3 col-md-4 sc-common-padding">
				<a href="<?php echo e(route('front.category',$cat->slug)); ?>" class="single-category">
					<div class="left">
						<h5 class="title">
							<?php echo e($cat->name); ?>

						</h5>
						<p class="count">
							<?php echo e(count($cat->products)); ?> <?php echo e($langg->lang4); ?>

						</p>
					</div>
					<div class="right">
						<img src="<?php echo e(asset('assets/images/categories/'.$cat->image)); ?>" alt="">
					</div>
				</a>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>


<?php endif; ?>
 -->
<?php if($ps->featured == 1): ?>
<!-- Trending Item Area Start -->
<section  class="trending">
	<div class="container">

		<div style="padding:20px;background:#fff;border-radius:20px;">
		<div class="row" style="padding:20px;">
			<div class="col-lg-12 remove-padding">
				<div class="section-top">
					<h2 class="section-title">
						<?php echo e($langg->lang26); ?>

					</h2>
					
				</div>
			</div>
		</div>
		<div class="row" style="padding:20px;">
			<div class="col-lg-12 remove-padding">
				<div class="trending-item-slider">
					<?php $__currentLoopData = $feature_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php echo $__env->make('includes.product.slider-product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>

		</div>
		</div>


	</div>
</section>
<!-- Tranding Item Area End -->
<?php endif; ?>

<?php if($ps->small_banner == 1): ?>

<!-- Banner Area One Start -->
<section class="banner-section">
	<div class="container">


		<?php $__currentLoopData = $top_small_banners->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="row">
			<?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-lg-6 remove-padding">
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

<section id="extraData">
	<div class="text-center">
		<img src="<?php echo e(asset('assets/images/'.$gs->loader)); ?>">
	</div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
	$(window).on('load',function() {

		setTimeout(function(){

			$('#extraData').load('<?php echo e(route('front.extraIndex')); ?>');

		}, 500);
	});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>