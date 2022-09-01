 

<?php $__env->startSection('content'); ?>

					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading"><?php echo e($langg->lang472); ?></h4>
										<ul class="links">
											<li>
												<a href="<?php echo e(route('vendor-dashboard')); ?>"><?php echo e($langg->lang441); ?> </a>
											</li>
											<li>
												<a href="<?php echo e(route('vendor-wt-index')); ?>"><?php echo e($langg->lang472); ?></a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">
										<?php echo $__env->make('includes.admin.form-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
						                                <th><?php echo e($langg->lang474); ?></th>
						                                <th><?php echo e($langg->lang475); ?></th>
						                                <th><?php echo e($langg->lang476); ?></th>
						                                <th><?php echo e($langg->lang477); ?></th>
						                                <th><?php echo e($langg->lang478); ?></th>
														</tr>
													</thead>

												<tbody>
                            <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(date('d-M-Y',strtotime($withdraw->created_at))); ?></td>
                                    <td><?php echo e($withdraw->method); ?></td>
                                    <?php if($withdraw->method != "Bank"): ?>
                                        <td><?php echo e($withdraw->acc_email); ?></td>
                                    <?php else: ?>
                                        <td><?php echo e($withdraw->iban); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($sign->sign); ?><?php echo e(round($withdraw->amount * $sign->value , 2)); ?></td>
                                    <td><?php echo e(ucfirst($withdraw->status)); ?></td>
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

<?php $__env->stopSection(); ?>    



<?php $__env->startSection('scripts'); ?>




    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			ordering:false
		});

      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 text-right">'+
        	'<a class="add-btn" href="<?php echo e(route('vendor-wt-create')); ?>">'+
          '<i class="fas fa-plus"></i> <?php echo e($langg->lang473); ?>'+
          '</a>'+
          '</div>');
      });												
									
    </script>


    
<?php $__env->stopSection(); ?>   
<?php echo $__env->make('layouts.vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>