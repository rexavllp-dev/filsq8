

<?php $__env->startSection('content'); ?>

<!-- Breadcrumb Area Start -->
	<div class="breadcrumb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="pages">
						<li>
							<a href="<?php echo e(route('front.index')); ?>">
								<?php echo e($langg->lang17); ?>

							</a>
						</li>
						<li>
							<a href="<?php echo e(route('user-wishlists')); ?>">
								<?php echo e($langg->lang168); ?>

							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<!-- Breadcrumb Area End -->

<!-- Wish List Area Start -->
	<section class="sub-categori wish-list">
		<div class="container">

			<?php if(count($wishlists)): ?>
			<div class="right-area">
				<?php echo $__env->make('includes.filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<div id="ajaxContent">
			<div class="row wish-list-area">

				<?php $__currentLoopData = $wishlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<?php if(!empty($sort)): ?>


				<div class="col-lg-6">
					<div class="single-wish">
						<span class="remove wishlist-remove" data-href="<?php echo e(route('user-wishlist-remove', App\Models\Wishlist::where('user_id','=',$user->id)->where('product_id','=',$wishlist->id)->first()->id )); ?>"><i class="fas fa-times"></i></span>
						<div class="left">
							<img src="<?php echo e($wishlist->photo ? asset('assets/images/products/'.$wishlist->photo):asset('assets/images/noimage.png')); ?>" alt="">
						</div>
						<div class="right">
							<h4 class="title">
								<a href="<?php echo e(route('front.product', $wishlist->slug)); ?>">
								<?php echo e($wishlist->name); ?>

								</a>
							</h4>
							<ul class="stars">
                                <div class="ratings">
                                    <div class="empty-stars"></div>
                                   	<div class="full-stars" style="width:<?php echo e(App\Models\Rating::ratings($wishlist->id)); ?>%"></div>
                                </div>
							</ul>
							<div class="price">
								<?php echo e($wishlist->showPrice()); ?><small><del><?php echo e($wishlist->showPreviousPrice()); ?></del></small>
							</div>
						</div>
					</div>
				</div>

				<?php else: ?>

				<div class="col-lg-6">
					<div class="single-wish">
						<span class="remove wishlist-remove" data-href="<?php echo e(route('user-wishlist-remove',$wishlist->id)); ?>"><i class="fas fa-times"></i></span>
						<div class="left">
							<img src="<?php echo e($wishlist->product->photo ? asset('assets/images/products/'.$wishlist->product->photo):asset('assets/images/noimage.png')); ?>" alt="">
						</div>
						<div class="right">
							<h4 class="title">
						<a href="<?php echo e(route('front.product', $wishlist->product->slug)); ?>">
							<?php echo e($wishlist->product->name); ?>

						</a>
							</h4>
							<ul class="stars">
                                <div class="ratings">
                                    <div class="empty-stars"></div>
                                   	<div class="full-stars" style="width:<?php echo e(App\Models\Rating::ratings($wishlist->product->id)); ?>%"></div>
                                </div>
							</ul>
							<div class="price">
								<?php echo e($wishlist->product->showPrice()); ?><small><del><?php echo e($wishlist->product->showPreviousPrice()); ?></del></small>
							</div>
						</div>
					</div>
				</div>

				<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			</div>

			<div class="page-center category">
				<?php echo e($wishlists->appends(['sort' => $sort])->links()); ?>

			</div>


			</div>
		</div>
			<?php else: ?>

			<div class="page-center">
				<h4 class="text-center"><?php echo e($langg->lang60); ?></h4>
			</div>

			<?php endif; ?>

		</div>
	</section>
<!-- Wish List Area End -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
        $("#sortby").on('change',function () {
        var sort = $("#sortby").val();
        window.location = "<?php echo e(url('/user/wishlists')); ?>?sort="+sort;
    	});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>