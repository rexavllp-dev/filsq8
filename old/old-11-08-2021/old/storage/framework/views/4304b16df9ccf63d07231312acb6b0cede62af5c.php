		<a class="clear"><?php echo e(__('New Notification(s).')); ?>

			<?php if(count($datas) > 0): ?>
			<span id="user-notf-clear" class="clear-notf" data-href="<?php echo e(route('user-notf-clear')); ?>">
				<?php echo e(__('Clear All')); ?>

			</span>
			<?php endif; ?>
		</a>
		<?php if(count($datas) > 0): ?>

		<ul>
		<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li>
				<a href="<?php echo e(route('admin-user-show',$data->user_id)); ?>">
					 <i class="fas fa-user"></i> <?php echo e(__('A New User Has Registered.')); ?>

					 <small class="d-block notf-time "><?php echo e($data->created_at->diffForHumans()); ?></small>
				</a>
			</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</ul>

		<?php else: ?> 

		<a class="clear" href="javascript:;">
			<?php echo e(__('No New Notifications.')); ?>

		</a>

		<?php endif; ?>