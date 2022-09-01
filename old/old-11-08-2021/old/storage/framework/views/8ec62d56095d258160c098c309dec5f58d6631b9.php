
<?php $__env->startSection('content'); ?>

<!-- Vendor Area Start -->
  <div class="vendor-banner" style="background: url(<?php echo e($vendor->shop_image != null ? asset('assets/images/vendorbanner/'.$vendor->shop_image) : ''); ?>); background-repeat: no-repeat; background-size: cover;background-position: center;<?php echo $vendor->shop_image != null ? '' : 'background-color:'.$gs->vendor_color; ?> ">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="content">
            <p class="sub-title">
                <?php echo e($langg->lang226); ?>

            </p>
            <h2 class="title">
              <?php echo e($vendor->shop_name); ?>

            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>



<section class="info-area">
  <div class="container">


        <?php $__currentLoopData = $services->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="row">

        <div class="col-lg-12 p-0">
          <div class="info-big-box">
              <div class="row">
                <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-6 col-xl-3 p-0">
                <div class="info-box">
                  <div class="icon">
                    <img src="<?php echo e(asset('assets/images/services/'.$service->photo)); ?>">
                  </div>
                  <div class="info">
                      <div class="details">
                        <h4 class="title"><?php echo e($service->title); ?></h4>
                      <p class="text">
                        <?php echo $service->details; ?>

                      </p>
                      </div>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
          </div>
        </div>

        </div>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
</section>





<!-- SubCategori Area Start -->
  <section class="sub-categori">
    <div class="container">
      <div class="row">

        <?php echo $__env->make('includes.vendor-catalog', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="col-lg-9 order-first order-lg-last">
          <div class="right-area">

            <?php if(count($vprods) > 0): ?>

              <?php echo $__env->make('includes.vendor-filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="categori-item-area">
              
                <div class="row">

                  <?php $__currentLoopData = $vprods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('includes.product.product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                  <div class="page-center category">
                    <?php echo $vprods->appends(['sort' => request()->input('sort'), 'min' => request()->input('min'), 'max' => request()->input('max')])->links(); ?>

                  </div>
              
            </div>

            <?php else: ?>
              <div class="page-center">
                <h4 class="text-center"><?php echo e($langg->lang60); ?></h4>
              </div>
            <?php endif; ?>


          </div>
        </div>
      </div>
    </div>
  </section>
<!-- SubCategori Area End -->


<?php if(Auth::guard('web')->check()): ?>



<div class="message-modal">
  <div class="modal" id="vendorform1" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vendorformLabel1"><?php echo e($langg->lang118); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div class="modal-body">
        <div class="container-fluid p-0">
          <div class="row">
            <div class="col-md-12">
              <div class="contact-form">

                <form id="emailreply">
                  <?php echo e(csrf_field()); ?>

                  <ul>

                    <li>
                      <input type="text" class="input-field" readonly="" placeholder="Send To <?php echo e($vendor->shop_name); ?>" readonly="">
                    </li>

                    <li>
                      <input type="text" class="input-field" id="subj" name="subject" placeholder="<?php echo e($langg->lang119); ?>" required="">
                    </li>

                    <li>
                      <textarea class="input-field textarea" name="message" id="msg" placeholder="<?php echo e($langg->lang120); ?>" required=""></textarea>
                    </li>

                    <input type="hidden" name="email" value="<?php echo e(Auth::guard('web')->user()->email); ?>">
                    <input type="hidden" name="name" value="<?php echo e(Auth::guard('web')->user()->name); ?>">
                    <input type="hidden" name="user_id" value="<?php echo e(Auth::guard('web')->user()->id); ?>">
                    <input type="hidden" name="vendor_id" value="<?php echo e($vendor->id); ?>">

                  </ul>
                  <button class="submit-btn" id="emlsub1" type="submit"><?php echo e($langg->lang118); ?></button>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>




<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">

  $(function () {
    $("#slider-range").slider({
    range: true,
    orientation: "horizontal",
    min: 0,
    max: 10000000,
    values: [<?php echo e(isset($_GET['min']) ? $_GET['min'] : '0'); ?>, <?php echo e(isset($_GET['max']) ? $_GET['max'] : '10000000'); ?>],
    step: 5,

    slide: function (event, ui) {
      if (ui.values[0] == ui.values[1]) {
        return false;
      }

      $("#min_price").val(ui.values[0]);
      $("#max_price").val(ui.values[1]);
    }
    });

    $("#min_price").val($("#slider-range").slider("values", 0));
    $("#max_price").val($("#slider-range").slider("values", 1));

  });
</script>

<script type="text/javascript">
          $(document).on("submit", "#emailreply" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          var email = $(this).find('input[name=email]').val();
          var name = $(this).find('input[name=name]').val();
          var user_id = $(this).find('input[name=user_id]').val();
          var vendor_id = $(this).find('input[name=vendor_id]').val();
          $('#subj').prop('disabled', true);
          $('#msg').prop('disabled', true);
          $('#emlsub').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "<?php echo e(URL::to('/vendor/contact')); ?>",
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                'email'   : email,
                'name'  : name,
                'user_id'   : user_id,
                'vendor_id'  : vendor_id
                  },
            success: function() {
          $('#subj').prop('disabled', false);
          $('#msg').prop('disabled', false);
          $('#subj').val('');
          $('#msg').val('');
        $('#emlsub').prop('disabled', false);
        toastr.success("<?php echo e($langg->message_sent); ?>");
        $('.ti-close').click();
            }
        });
          return false;
        });
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>