
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
     
    <div class="panel panel-primary">

      <div class="panel-body">
     
        <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo e($message); ?></strong>
        </div>
        <img src="images/<?php echo e(Session::get('image')); ?>">
        <?php endif; ?>
    
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    
       <div class="card-header text-center font-weight-bold">
      <h2>Upload Banner</h2>
    </div>
 
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" id="upload-image" action="<?php echo e(route('user-banner-create')); ?>" >

        	      <?php echo e(csrf_field()); ?>

                   
            <div class="row">
 
                <div class="col-md-12">
                    <div class="form-group">
                    	<input type="hidden" name="id" value="<?php echo e($sub->id); ?>">
                        <input type="file" name="image" placeholder="Choose image" id="image">

                    </div>
                </div>
                   
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>     
        </form>
 
    </div>
    
      </div>
    </div>

                </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>
<style type="text/css">
	.categories_menu{
		    display: none !important;
	}
</style>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>