
<?php $__env->startSection('content'); ?>


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        <?php echo $__env->make('includes.user-dashboard-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-lg-8">
            <div class="user-profile-details">
                <div class="order-history">
                    <div class="header-area d-flex align-items-center">
                        <h4 class="title"><?php echo e($langg->lang772); ?></h4>          
                    </div>
                        <div class="order-tracking-content">
                            <?php echo $__env->make('includes.form-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <form id="t-form" class="tracking-form">
                                <?php echo e(csrf_field()); ?>

                                <input type="text" id="code" placeholder="<?php echo e($langg->lang773); ?>" required="">
                                <button type="submit" class="mybtn1"><?php echo e($langg->lang774); ?></button>
                                <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                            </form>
                        </div>
                      
                    </div>
                </div>
		    </div>
	    </div>
	</div>
</section>


<!-- Order Tracking modal Start-->
    <div class="modal fade" id="order-tracking-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> <b><?php echo e($langg->lang772); ?></b> </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="order-track">

            </div>
            </div>
        </div>
    </div>
<!-- Order Tracking modal End -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
    $('#t-form').on('submit',function(e){
        e.preventDefault();
        var code = $('#code').val();
        $('#order-track').load('<?php echo e(url("user/order/trackings/")); ?>/'+code);
        $('#order-tracking-modal').modal('show');
    });


</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>