

<?php $__env->startSection('content'); ?>

<div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading"><?php echo e($langg->lang445); ?></h4>
                    <ul class="links">
                      <li>
                        <a href="<?php echo e(route('vendor-dashboard')); ?>"><?php echo e($langg->lang441); ?></a>
                      </li>
                      <li>
                        <a href="javascript:;"><?php echo e($langg->lang444); ?> </a>
                      </li>
                      <li>
                        <a href="<?php echo e(route('vendor-prod-index')); ?>"><?php echo e($langg->lang446); ?></a>
                      </li>
                      <li>
                        <a href="<?php echo e(route('vendor-prod-types')); ?>"><?php echo e($langg->lang445); ?></a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
            <div class="add-product-content">
              <div class="row">
                <div class="col-lg-12">
                  <div class="product-description">
                    <div class="heading-area">
                      <h2 class="title">
                          <?php echo e($langg->lang625); ?>

                      </h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ap-product-categories">
                <div class="row">
                  <div class="col-lg-4">
                    <a href="<?php echo e(route('vendor-prod-physical-create')); ?>">
                    <div class="cat-box box1">
                      <div class="icon">
                        <i class="fas fa-tshirt"></i>
                      </div>
                      <h5 class="title"><?php echo e($langg->lang626); ?> </h5>
                    </div>
                    </a>
                  </div>
                  <div class="col-lg-4">
                    <a href="<?php echo e(route('vendor-prod-digital-create')); ?>">
                    <div class="cat-box box2">
                      <div class="icon">
                        <i class="fas fa-camera-retro"></i>
                      </div>
                      <h5 class="title"><?php echo e($langg->lang627); ?> </h5>
                    </div>
                    </a>
                  </div>
                  <div class="col-lg-4">
                    <a href="<?php echo e(route('vendor-prod-license-create')); ?>">
                    <div class="cat-box box3">
                      <div class="icon">
                        <i class="fas fa-award"></i>
                      </div>
                      <h5 class="title"><?php echo e($langg->lang628); ?> </h5>
                    </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>