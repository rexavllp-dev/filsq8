
<?php $__env->startSection('content'); ?>      

<section class="user-dashbord">
    <div class="container">
      <div class="row">
        <?php echo $__env->make('includes.user-dashboard-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="col-lg-8">
                    <div class="user-profile-details">
                        <div class="account-info">
                            <div class="header-area">
                                <h4 class="title">
                                    <?php echo e($langg->lang262); ?>

                                </h4>
                            </div>
                            <div class="edit-info-area">

                                <div class="body">
                                    <div class="edit-info-area-form">
                                        <div class="gocover"
                                            style="background: url(<?php echo e(asset('assets/images/'.$gs->loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                        </div>
                                        <form id="userform" action="<?php echo e(route('user-profile-update')); ?>" method="POST"
                                            enctype="multipart/form-data">
    
                                            <?php echo e(csrf_field()); ?>

    
                                            <?php echo $__env->make('includes.admin.form-both', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            <div class="upload-img">
                                                <?php if($user->is_provider == 1): ?>
                                                <div class="img"><img
                                                        src="<?php echo e($user->photo ? asset($user->photo):asset('assets/images/'.$gs->user_image)); ?>">
                                                </div>
                                                <?php else: ?>
                                                <div class="img"><img
                                                        src="<?php echo e($user->photo ? asset('assets/images/users/'.$user->photo):asset('assets/images/'.$gs->user_image)); ?>">
                                                </div>
                                                <?php endif; ?>
                                                <?php if($user->is_provider != 1): ?>
                                                <div class="file-upload-area">
                                                    <div class="upload-file">
                                                        <input type="file" name="photo" class="upload">
                                                        <span><?php echo e($langg->lang263); ?></span>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input name="name" type="text" class="input-field"
                                                        placeholder="<?php echo e($langg->lang264); ?>" required=""
                                                        value="<?php echo e($user->name); ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input name="email" type="email" class="input-field"
                                                        placeholder="<?php echo e($langg->lang265); ?>" required=""
                                                        value="<?php echo e($user->email); ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input name="phone" type="text" class="input-field"
                                                        placeholder="<?php echo e($langg->lang266); ?>" required=""
                                                        value="<?php echo e($user->phone); ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input name="fax" type="text" class="input-field"
                                                        placeholder="<?php echo e($langg->lang267); ?>" value="<?php echo e($user->fax); ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input name="city" type="text" class="input-field"
                                                        placeholder="<?php echo e($langg->lang268); ?>" value="<?php echo e($user->city); ?>">
                                                </div>
    
                                                <div class="col-lg-6">
                                                    <select class="input-field" name="country">
                                                        <option value=""><?php echo e($langg->lang157); ?></option>
                                                        <?php $__currentLoopData = DB::table('countries')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($data->country_name); ?>" <?php echo e($user->country == $data->country_name ? 'selected' : ''); ?>>
                                                                <?php echo e($data->country_name); ?>

                                                            </option>		
                                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
    
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-6">
                                                            <input name="zip" type="text" class="input-field"
                                                                placeholder="<?php echo e($langg->lang269); ?>" value="<?php echo e($user->zip); ?>">
                                                        </div>
    
                                                <div class="col-lg-6">
                                                    <textarea class="input-field" name="address" required=""
                                                        placeholder="<?php echo e($langg->lang270); ?>"><?php echo e($user->address); ?></textarea>
                                                </div>
    
                                            </div>
    
                                            <div class="form-links">
                                                <button class="submit-btn" type="submit"><?php echo e($langg->lang271); ?></button>
                                            </div>
                                        </form>
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