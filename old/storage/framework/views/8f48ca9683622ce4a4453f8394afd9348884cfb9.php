<?php $__env->startSection('content'); ?>
<style type="text/css">
    .price-digit{
        font-size: 35px !important;
    }
</style>

<section class="user-dashbord">
    <div class="container">
      <div class="row">
        <?php echo $__env->make('includes.user-dashboard-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="col-lg-8">
<div class="user-profile-details">
                        


                        <div class="row">
                            <?php $__currentLoopData = $subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-6">
                                    <div class="elegant-pricing-tables style-2 text-center">
                                        <div class="pricing-head">
                                            <h3><?php echo e($sub->title); ?></h3>
                                            <?php if($sub->price  == 0): ?>
                                            <span class="price">
                                            <span class="price-digit"><?php echo e($langg->lang402); ?></span>
                                            </span>
                                            <?php else: ?>
                                            <span class="price">
                                                <sup><?php echo e($sub->currency); ?></sup>
                                                <span class="price-digit"><?php echo e($sub->price); ?></span><br>
                                                <span class="price-month"><?php echo e($sub->days); ?> <?php echo e($langg->lang403); ?></span>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="pricing-detail">
                                            <?php echo $sub->details; ?>

                                        </div>
                                    <?php if(!empty($package)): ?>
                                        <?php if($package->subscription_id == $sub->id): ?>
                                            <a href="javascript:;" class="btn btn-default"><?php echo e($langg->lang404); ?></a>
                                            <br>
                                            <?php if(Carbon\Carbon::now()->format('Y-m-d') > $user->date): ?>
                                            <small class="hover-white"><?php echo e($langg->lang405); ?> <?php echo e(date('d/m/Y',strtotime($user->date))); ?></small>
                                            <?php else: ?>
                                            <small class="hover-white"><?php echo e($langg->lang406); ?> <?php echo e(date('d/m/Y',strtotime($user->date))); ?></small>
                                            <?php endif; ?>
                                             <a href="<?php echo e(route('user-vendor-request',$sub->id)); ?>" class="hover-white"><u><?php echo e($langg->lang407); ?></u></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('user-vendor-request',$sub->id)); ?>" class="btn btn-default"><?php echo e($langg->lang408); ?></a>
                                            <br><small>&nbsp;</small>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('user-vendor-request',$sub->id)); ?>" class="btn btn-default"><?php echo e($langg->lang408); ?></a>
                                        <br><small>&nbsp;</small>
                                    <?php endif; ?>


                
                                    </div>
                                </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                        </div>
                    </div>
                </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>