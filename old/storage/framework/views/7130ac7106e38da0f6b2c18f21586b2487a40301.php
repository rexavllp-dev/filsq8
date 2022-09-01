

<?php $__env->startSection('content'); ?>

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
                        <a href="<?php echo e(route('user-forgot')); ?>">
                            <?php echo e($langg->lang190); ?>

                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<section class="login-signup forgot-password">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="login-area">
                    <div class="header-area forgot-passwor-area">
                        <h4 class="title"><?php echo e($langg->lang191); ?> </h4>
                        <p class="text"><?php echo e($langg->lang192); ?> </p>
                    </div>
                    <div class="login-form">
                        <?php echo $__env->make('includes.admin.form-login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <form id="forgotform" action="<?php echo e(route('user-forgot-submit')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-input">
                                <input type="email" name="email" class="User Name" placeholder="<?php echo e($langg->lang193); ?>"
                                    required="">
                                <i class="icofont-user-alt-5"></i>
                            </div>
                            <div class="to-login-page">
                                <a href="<?php echo e(route('user.login')); ?>">
                                    <?php echo e($langg->lang194); ?>

                                </a>
                            </div>
                            <input class="authdata" type="hidden" value="<?php echo e($langg->lang195); ?>">
                            <button type="submit" class="submit-btn"><?php echo e($langg->lang196); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>