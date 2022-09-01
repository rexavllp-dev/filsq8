<?php $__currentLoopData = $prods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="docname">
		<a href="<?php echo e(route('front.product', $prod->slug)); ?>">
			<img src="<?php echo e(asset('assets/images/thumbnails/'.$prod->thumbnail)); ?>" alt="">
			<div class="search-content">
				<p><?php echo mb_strlen($prod->name,'utf-8') > 66 ? str_replace($slug,'<b>'.$slug.'</b>',mb_substr($prod->name,0,66,'utf-8')).'...' : str_replace($slug,'<b>'.$slug.'</b>',$prod->name); ?> </p>
				<span style="font-size: 14px; font-weight:600; display:block;"><?php echo e($prod->showPrice()); ?></span>
			</div>
		</a>
	</div> 
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>