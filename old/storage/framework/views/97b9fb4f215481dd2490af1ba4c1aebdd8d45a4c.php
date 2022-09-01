
<?php $__env->startSection('content'); ?>

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading"><?php echo e($langg->lang454); ?></h4>

										<ul class="links">
											<li>
												<a href="<?php echo e(route('vendor-dashboard')); ?>"><?php echo e($langg->lang441); ?> </a>
											</li>
											<li>
												<a href="javascript:;"><?php echo e($langg->lang452); ?> </a>
											</li>
											<li>
												<a href="<?php echo e(route('vendor-banner')); ?>"><?php echo e($langg->lang454); ?></a>
											</li>
										</ul>



									</div>
								</div>
							</div>
							<div class="add-product-content1">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">

				                        <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
											<form id="geniusform" action="<?php echo e(route('vendor-banner-update')); ?>" method="POST" enctype="multipart/form-data">
												<?php echo e(csrf_field()); ?>



                      						 <?php echo $__env->make('includes.vendor.form-both', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  

						                        <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                                <h4 class="heading"><?php echo e($langg->lang520); ?> *</h4>
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <div class="img-upload full-width-img">
						                                <div id="image-preview" class="img-preview" style="background: url(<?php echo e($data->shop_image ? asset('assets/images/vendorbanner/'.$data->shop_image):asset('assets/images/noimage.png')); ?>);">
						                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i><?php echo e($langg->lang522); ?></label>
						                                    <input type="hidden" name="id" value="<?php echo e($sub->id); ?>">
						                                    <input type="file" name="shop_image" class="img-upload" id="image-upload">
						                                  </div>
						                                  <p class="text"><?php echo e($langg->lang521); ?></p>
						                            </div>

						                          </div>
						                        </div>



						                        <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                              
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <button class="addProductSubmit-btn" type="submit"><?php echo e($langg->lang523); ?></button>
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
<?php echo $__env->make('layouts.vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>