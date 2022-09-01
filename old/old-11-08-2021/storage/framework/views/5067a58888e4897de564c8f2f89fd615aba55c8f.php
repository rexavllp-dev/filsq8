
<?php $__env->startSection('content'); ?>


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        <?php echo $__env->make('includes.user-dashboard-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-lg-8">
          <?php echo $__env->make('includes.form-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <div class="row mb-3">
            <div class="col-lg-6">
              <div class="user-profile-details">
                <div class="account-info">
                  <div class="header-area">
                    <h4 class="title">
                      <?php echo e($langg->lang208); ?>

                    </h4>
                  </div>
                  <div class="edit-info-area">
                  </div>
                  <div class="main-info">
                    <h5 class="title"><?php echo e($user->name); ?></h5>
                    <ul class="list">
                      <li>
                        <p><span class="user-title"><?php echo e($langg->lang209); ?>:</span> <?php echo e($user->email); ?></p>
                      </li>
                      <?php if($user->phone != null): ?>
                      <li>
                        <p><span class="user-title"><?php echo e($langg->lang210); ?>:</span> <?php echo e($user->phone); ?></p>
                      </li>
                      <?php endif; ?>
                      <?php if($user->fax != null): ?>
                      <li>
                        <p><span class="user-title"><?php echo e($langg->lang211); ?>:</span> <?php echo e($user->fax); ?></p>
                      </li>
                      <?php endif; ?>
                      <?php if($user->city != null): ?>
                      <li>
                        <p><span class="user-title"><?php echo e($langg->lang212); ?>:</span> <?php echo e($user->city); ?></p>
                      </li>
                      <?php endif; ?>
                      <?php if($user->zip != null): ?>
                      <li>
                        <p><span class="user-title"><?php echo e($langg->lang213); ?>:</span> <?php echo e($user->zip); ?></p>
                      </li>
                      <?php endif; ?>
                      <?php if($user->address != null): ?>
                      <li>
                        <p><span class="user-title"><?php echo e($langg->lang214); ?>:</span> <?php echo e($user->address); ?></p>
                      </li>
                      <?php endif; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        
            <div class="col-lg-6">
              <div class="user-profile-details h100">
                <div class="account-info wallet h100">
                  <div class="header-area">
                    <h4 class="title">
                      <?php echo e(isset($langg->lang812) ? $langg->lang812 : 'My Balance'); ?>

                    </h4>
                  </div>
                  <div class="edit-info-area">
                  </div>
                  <div class="main-info">
                    <h3 class="title w-title"><?php echo e($langg->lang215); ?>:</h3>
                    <h3 class="title w-price"><?php echo e(App\Models\Product::vendorConvertPrice($user->affilate_income)); ?></h3>
                  </div>
                </div>
              </div>
            </div>
        </div>


        <div class="row row-cards-one mb-3">
          <div class="col-md-6 col-xl-6">
            <div class="card c-info-box-area">
                <div class="c-info-box box2">
                  <p><?php echo e(Auth::user()->orders()->where('status','completed')->count()); ?></p>
                </div>
                <div class="c-info-box-content">
                    <h6 class="title"><?php echo e(isset($langg->lang809) ? $langg->lang809 : 'Total Orders'); ?></h6>
                    <p class="text"><?php echo e(isset($langg->lang811) ? $langg->lang811 : 'All Time'); ?></p>
                </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-6">
              <div class="card c-info-box-area">
                  <div class="c-info-box box1">
                      <p><?php echo e(Auth::user()->orders()->where('status','pending')->count()); ?></p>
                  </div>
                  <div class="c-info-box-content">
                      <h6 class="title"><?php echo e(isset($langg->lang810) ? $langg->lang810 : 'Pending Orders'); ?></h6>
                      <p class="text"><?php echo e(isset($langg->lang811) ? $langg->lang811 : 'All Time'); ?></p>
                  </div>
              </div>
          </div>
      </div>

        <div class="row">
        <div class="col-lg-12">
          <div class="user-profile-details">
            <div class="account-info wallet">
              <div class="header-area">
                <h4 class="title">
                  <?php echo e(isset($langg->lang808) ? $langg->lang808 : 'Recent Orders'); ?>

                </h4>
              </div>
              <div class="edit-info-area">
              </div>
              <div class="main-info">
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
													 <?php $__currentLoopData = Auth::user()->orders()->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
      </div>
      </div>
    </div>
  </section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>