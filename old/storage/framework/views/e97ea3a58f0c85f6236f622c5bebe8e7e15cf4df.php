

<?php $__env->startSection('styles'); ?>

<link href="<?php echo e(asset('assets/admin/css/jquery-ui.css')); ?>" rel="stylesheet" type="text/css">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

						<div class="content-area">
							
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">
											<?php echo $__env->make('includes.admin.form-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
											<form id="geniusformdata" action="<?php echo e(route('admin-prod-feature',$data->id)); ?>" method="POST" enctype="multipart/form-data">
												<?php echo e(csrf_field()); ?>


												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading"><?php echo e(__("Highlight in")); ?> <?php echo e($langg->lang26); ?> *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="featured" value="1" <?php echo e($data->featured == 1 ?"checked":""); ?>>
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading"><?php echo e(__("Highlight in")); ?>  <?php echo e($langg->lang27); ?> *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="best" value="1" <?php echo e($data->best == 1 ? "checked":""); ?>>
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading"><?php echo e(__("Highlight in")); ?>  <?php echo e($langg->lang28); ?> *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="top" value="1" <?php echo e($data->top == 1 ? "checked":""); ?>>
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading"><?php echo e(__("Highlight in")); ?>  <?php echo e($langg->lang29); ?> *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="big" value="1" <?php echo e($data->big == 1 ? "checked":""); ?>>
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading"><?php echo e(__("Highlight in")); ?>  <?php echo e($langg->lang30); ?> *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="hot" value="1" <?php echo e($data->hot == 1 ? "checked":""); ?>>
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>


												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading"><?php echo e(__("Highlight in")); ?> <?php echo e($langg->lang31); ?> *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="latest" value="1" <?php echo e($data->latest == 1 ? "checked":""); ?>>
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading"><?php echo e(__("Highlight in")); ?> <?php echo e($langg->lang32); ?> *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="trending" value="1" <?php echo e($data->trending == 1 ?"checked":""); ?>>
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading"><?php echo e(__("Highlight in")); ?> <?php echo e($langg->lang33); ?> *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="sale" value="1" <?php echo e($data->sale == 1 ? "checked":""); ?>>
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading"><?php echo e(__("Highlight in")); ?> <?php echo e($langg->lang244); ?> *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="is_discount" id="is_discount" value="1" <?php echo e($data->is_discount == 1 ? "checked":""); ?>>
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="<?php echo e($data->is_discount == 0 ? "showbox":""); ?>">

												<div class="row">
													<div class="col-lg-6">
														<div class="left-area">
																<h4 class="heading"><?php echo e(__("Discount Date")); ?> *</h4>
														</div>
													</div>
									                  <div class="col-sm-6">
									                      <input type="text" class="input-field" name="discount_date"  placeholder="<?php echo e(__("Enter Date")); ?>" id="discount_date" value="<?php echo e($data->discount_date); ?>">

									                  </div>
												</div>
												</div>
												<div class="row">
													<div class="col-lg-5">
														<div class="left-area">
															
														</div>
													</div>
													<div class="col-lg-7">
														<button class="addProductSubmit-btn" type="submit"><?php echo e(__("Submit")); ?></button>
													</div>
												</div>


											</form>


											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">

$('#is_discount').on('change',function(){

if(this.checked)
{
	$(this).parent().parent().parent().next().removeClass('showbox');
	$('#discount').prop('required',true);
	$('#discount_date').prop('required',true);
}

else {
	$(this).parent().parent().parent().next().addClass('showbox');
	$('#discount').prop('required',false);
	$('#discount_date').prop('required',false);
}

});



</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.load', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>