 

<?php $__env->startSection('content'); ?>
                    <div class="content-area">

                            <?php if($user->checkWarning()): ?>

                                <div class="alert alert-danger validation text-center">
                                        <h3><?php echo e($user->displayWarning()); ?> </h3> <a href="<?php echo e(route('vendor-warning',$user->verifies()->where('admin_warning','=','1')->orderBy('id','desc')->first()->id)); ?>"> <?php echo e($langg->lang803); ?> </a>
                                </div>

                            <?php endif; ?>

                        
                        <?php echo $__env->make('includes.form-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <div class="row row-cards-one">

                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg1">
                                        <div class="left">
                                            <h5 class="title"><?php echo e($langg->lang465); ?> </h5>
                                            <span class="number"><?php echo e(count($pending)); ?></span>
                                            <a href="<?php echo e(route('vendor-order-index')); ?>" class="link"><?php echo e($langg->lang471); ?></a>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg2">
                                        <div class="left">
                                            <h5 class="title"><?php echo e($langg->lang466); ?></h5>
                                            <span class="number"><?php echo e(count($processing)); ?></span>
                                            <a href="<?php echo e(route('vendor-order-index')); ?>" class="link"><?php echo e($langg->lang471); ?></a>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-truck-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg3">
                                        <div class="left">
                                            <h5 class="title"><?php echo e($langg->lang467); ?></h5>
                                            <span class="number"><?php echo e(count($completed)); ?></span>
                                            <a href="<?php echo e(route('vendor-order-index')); ?>" class="link"><?php echo e($langg->lang471); ?></a>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-check-circled"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg4">
                                        <div class="left">
                                            <h5 class="title"><?php echo e($langg->lang468); ?></h5>
                                            <span class="number"><?php echo e(count($user->products)); ?></span>
                                            <a href="<?php echo e(route('vendor-prod-index')); ?>" class="link"><?php echo e($langg->lang471); ?></a>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-cart-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>  


                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg5">
                                        <div class="left">
                                            <h5 class="title"><?php echo e($langg->lang469); ?></h5>
                                            <span class="number"><?php echo e(App\Models\VendorOrder::where('user_id','=',$user->id)->where('status','=','completed')->sum('qty')); ?></span>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-shopify"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg6">
                                        <div class="left">
                                            <h5 class="title"><?php echo e($langg->lang470); ?></h5>
                                            <span class="number"><?php echo e(App\Models\Product::vendorConvertPrice( App\Models\VendorOrder::where('user_id','=',$user->id)->where('status','=','completed')->sum('price') )); ?></span>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                               <i class="icofont-dollar-true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>