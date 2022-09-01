

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
							<a href="<?php echo e(route('product.compare')); ?>">
								<?php echo e($langg->lang69); ?>

							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb Area End -->

	<!-- Compare Area Start -->
	<section class="compare-page">
		<div class="container">

			<?php if(Session::has('compare')): ?>

			<div class="row">
				<div class="col-lg-12">
					<div class="content">
						<div class="com-heading">
							<h2 class="title">
									<?php echo e($langg->lang70); ?>

							</h2>
						</div>
						<div class="compare-page-content-wrap">
							<div class="compare-table table-responsive">
								<table class="table table-bordered mb-0">
									<tbody>
										<tr>

											<td class="first-column top"><?php echo e($langg->lang71); ?></td>
											<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<td class="product-image-title c<?php echo e($product['item']['id']); ?>">

													<img class="img-fluid" src="<?php echo e($product['item']['thumbnail'] ? asset('assets/images/thumbnails/'.$product['item']['thumbnail']):asset('assets/images/noimage.png')); ?>" alt="Compare product['item']">

												<a href="<?php echo e(route('front.product', $product['item']['slug'])); ?>">
													<h4 class="title">
															<?php echo e($product['item']['name']); ?>

													</h4>
												</a>
											</td>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tr>
										<tr>
											<td class="first-column"><?php echo e($langg->lang72); ?></td>
											<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<td class="pro-price c<?php echo e($product['item']['id']); ?>"><?php echo e(App\Models\Product::find($product['item']['id'])->showPrice()); ?></td>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tr>
										<tr>
											<td class="first-column"><?php echo e($langg->lang73); ?></td>
											<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<td class="pro-ratting c<?php echo e($product['item']['id']); ?>">
                                                <div class="ratings">
                                                    <div class="empty-stars"></div>
                                                    <div class="full-stars" style="width:<?php echo e(App\Models\Rating::ratings($product['item']['id'])); ?>%"></div>
                                                </div>
											</td>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tr>

										
										
										
										<tr>
												<td class="first-column"><?php echo e($langg->lang74); ?></td>
												<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<td class="pro-desc c<?php echo e($product['item']['id']); ?>">
													<p><?php echo e(strip_tags($product['item']['details'])); ?></p>
												</td>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
											</tr>
										<!-- 	<tr>
													<td class="first-column"><?php echo e($langg->lang75); ?></td>
													<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<td class="c<?php echo e($product['item']['id']); ?>">
															<?php if($product['item']['product_type'] == "affiliate"): ?>
															<a href="<?php echo e(route('affiliate.product', $product['item']['slug'])); ?>" class="btn__bg"><?php echo e($langg->lang251); ?></a>
															<?php else: ?>														
														
														<a href="javascript:;" data-href="<?php echo e(route('product.cart.add',$product['item']['id'])); ?>" class="btn__bg add-to-cart"><?php echo e($langg->lang75); ?></a>
													<a href="<?php echo e(route('product.cart.quickadd',$product['item']['id'])); ?>" class="btn__bg"><?php echo e($langg->lang251); ?></a>
															<?php endif; ?>
													</td>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</tr> -->
										<tr>
											<td class="first-column"><?php echo e($langg->lang76); ?></td>
											<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<td class="pro-remove c<?php echo e($product['item']['id']); ?>">
												<i class="far fa-trash-alt compare-remove" data-href="<?php echo e(route('product.compare.remove',$product['item']['id'])); ?>" data-class="c<?php echo e($product['item']['id']); ?>"></i>
											</td>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
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
	<!-- Compare Area End -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>