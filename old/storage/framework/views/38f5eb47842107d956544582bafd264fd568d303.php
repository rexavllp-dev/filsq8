<?php $__env->startSection('content'); ?>

<div class="category-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-white">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="sub-category-menu">
                            <h3 class="category-name"><a href="<?php echo e(route('front.category',$category->slug)); ?>"><?php echo e($category->name); ?></a></h3>
                            <?php if(count($category->subs) > 0): ?>
                                <ul class="parent-category">
                                <?php $__currentLoopData = $category->subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a class="p-c-title" href="<?php echo e(route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug])); ?>"><?php echo e($subcat->name); ?></a>

                                    <?php if(count($subcat->childs) > 0): ?>
                                        <ul>
                                        <?php $__currentLoopData = $subcat->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug])); ?>"><i class="fas fa-angle-double-right"></i><?php echo e($childcat->name); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>