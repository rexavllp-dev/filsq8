<?php $__env->startSection('content'); ?>


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        <?php echo $__env->make('includes.user-dashboard-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area d-flex align-items-center">
								<h4 class="title"><?php echo e($langg->lang252); ?></h4>          
							</div>
							<div class="mr-table allproduct message-area  mt-4">
								<?php echo $__env->make('includes.form-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th><?php echo e($langg->lang253); ?></th>
														<th><?php echo e($langg->lang254); ?></th>
														<th><?php echo e($langg->lang255); ?></th>
														<th><?php echo e($langg->lang256); ?></th>
													</tr>
												</thead>
												<tbody>
                        <?php $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                            $seller = App\Models\User::findOrFail($vendor->vendor_id);
                          ?>

                          <tr class="conv">
                            
                              <td><?php echo e($seller->shop_name); ?></td>
                              <td><?php echo e($seller->owner_name); ?></td>
                              <td><?php echo e($seller->shop_address); ?></td>

                            <td>
                              <a target="_blank" href="<?php echo e(route('front.vendor',str_replace(' ', '-',($seller->shop_name)))); ?>" class="link view"><i class="fa fa-eye"></i></a>
                              <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" data-href="<?php echo e(route('user-favorite-delete',$vendor->id)); ?>" class="link remove"><i class="fa fa-trash"></i></a>
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

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block"><?php echo e($langg->lang257); ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>

                <div class="modal-body">
            <p class="text-center"><?php echo e($langg->lang258); ?></p>
            <p class="text-center"><?php echo e($langg->lang259); ?></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e($langg->lang260); ?></button>
                    <a class="btn btn-danger btn-ok"><?php echo e($langg->lang261); ?></a>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>