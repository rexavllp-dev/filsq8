
<?php $__env->startSection('content'); ?>


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        <?php echo $__env->make('includes.user-dashboard-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area">
								<h4 class="title">
									<?php echo e($langg->lang277); ?>

								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th><?php echo e($langg->lang278); ?></th>
														<th><?php echo e($langg->lang279); ?></th>
														<th><?php echo e($langg->lang280); ?></th>
														<th><?php echo e($langg->lang281); ?></th>
														<th><?php echo e($langg->lang282); ?></th>
													</tr>
												</thead>
												<tbody>
													 <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<tr>
														<td>
																<?php echo e($order->order_number); ?>

														</td>
														<td>
																<?php echo e(date('d M Y',strtotime($order->created_at))); ?>

														</td>
														<td>
																<?php echo e($order->currency_sign); ?><?php echo e(round($order->pay_amount * $order->currency_value , 2)); ?>

														</td>
														<td>
															<div class="order-status <?php echo e($order->status); ?>">
																	<?php echo e(ucwords($order->status)); ?>

															</div>
														</td>
														<td>
															<a class="mybtn2 sm" href="<?php echo e(route('user-order',$order->id)); ?>">
																	<?php echo e($langg->lang283); ?>

															</a>
														</td>
													</tr>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</tbody>
											</table>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>