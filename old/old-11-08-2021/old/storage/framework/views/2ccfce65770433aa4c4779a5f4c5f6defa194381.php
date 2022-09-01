<option value=""><?php echo e($langg->lang157); ?></option>
<?php if(Auth::check()): ?>
	<?php $__currentLoopData = DB::table('countries')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<option value="<?php echo e($data->country_name); ?>" <?php echo e(Auth::user()->country == $data->country_name ? 'selected' : ''); ?>><?php echo e($data->country_name); ?></option>		
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
	<?php $__currentLoopData = DB::table('countries')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<option value="<?php echo e($data->country_name); ?>"><?php echo e($data->country_name); ?></option>		
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>