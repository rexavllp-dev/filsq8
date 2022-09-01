
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
                                    <?php echo e($langg->lang409); ?> <a class="mybtn1" href="<?php echo e(route('user-package')); ?>"> <i class="fas fa-arrow-left"></i> <?php echo e($langg->lang410); ?></a>
                                </h4>
                            </div>
                            <div class="pack-details">
                                <div class="row">

                                    <div class="col-lg-4">
                                        <h5 class="title">
                                            <?php echo e($langg->lang411); ?>

                                        </h5>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="value">
                                            <?php echo e($subs->title); ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h5 class="title">
                                            <?php echo e($langg->lang412); ?>

                                        </h5>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="value">
                                            <?php echo e($subs->price); ?><?php echo e($subs->currency); ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h5 class="title">
                                            <?php echo e($langg->lang413); ?>

                                        </h5>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="value">
                                            <?php echo e($subs->days); ?> <?php echo e($langg->lang403); ?>

                                    </p></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h5 class="title">
                                            <?php echo e($langg->lang414); ?>

                                        </h5>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="value">
                                            <?php echo e($subs->allowed_products == 0 ? 'Unlimited':  $subs->allowed_products); ?>

                                        </p>
                                    </div>
                                </div>

                                        <?php if(!empty($package)): ?>
                                            <?php if($package->subscription_id != $subs->id): ?>
                                <div class="row">
                                    <div class="col-lg-4">
                                    </div>
                                    <div class="col-lg-8">
                                        <span class="notic"><b><?php echo e($langg->lang415); ?></b> <?php echo e($langg->lang416); ?></span>
                                    </div>
                                </div>

                                <br>
                                            <?php else: ?>
                                <br>

                                            <?php endif; ?>
                                        <?php else: ?>
                                <br>
                                        <?php endif; ?>

                                        <form id="subscribe-form" class="pay-form" action="<?php echo e(route('user-vendor-request-submit')); ?>" method="POST">

                            <?php echo $__env->make('includes.form-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('includes.form-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('includes.admin.form-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                                            
                                            <?php echo e(csrf_field()); ?>



                                        <?php if($user->is_vendor == 0): ?>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    <?php echo e($langg->lang238); ?> *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text"  id="shop-name" class="option" name="shop_name" placeholder="<?php echo e($langg->lang238); ?>" required>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    <?php echo e($langg->lang239); ?> *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="owner_name" placeholder="<?php echo e($langg->lang239); ?>" required>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    <?php echo e($langg->lang240); ?> *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="shop_number" placeholder="<?php echo e($langg->lang240); ?>" required>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    <?php echo e($langg->lang241); ?> *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="shop_address" placeholder="<?php echo e($langg->lang241); ?>" required>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    <?php echo e($langg->lang242); ?> <small><?php echo e($langg->lang417); ?></small>
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="reg_number" placeholder="<?php echo e($langg->lang242); ?>">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    <?php echo e($langg->lang243); ?> <small><?php echo e($langg->lang417); ?></small>
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                <textarea class="option" name="shop_message" placeholder="<?php echo e($langg->lang243); ?>" rows="5"></textarea>
                                            </div>
                                        </div>

                                        <br>


                                        <?php endif; ?>
                                        <input type="hidden" name="subs_id" value="<?php echo e($subs->id); ?>">

                                 <?php if($subs->price != 0): ?>       

                                <div class="row">
                                    <div class="col-lg-4">
                                        <h5 class="title pt-1">
                                            <?php echo e($langg->lang418); ?> *
                                        </h5>
                                    </div>
                                    <div class="col-lg-8">
                                        

                                            <select name="method" id="option" onchange="meThods(this)" class="option" required="">
                                                <option value=""><?php echo e($langg->lang419); ?></option>
                                                <?php if($gs->paypal_check == 1): ?>
                                                    <option value="Paypal"><?php echo e($langg->lang420); ?></option>
                                                <?php endif; ?>
                                                <?php if($gs->stripe_check == 1): ?>
                                                    <option value="Stripe"><?php echo e($langg->lang421); ?></option>
                                                <?php endif; ?>
                                                <?php if($gs->is_instamojo == 1): ?>
                                                    <option value="Instamojo"><?php echo e($langg->lang763); ?></option>
                                                <?php endif; ?>
                                                <?php if($gs->is_paystack == 1): ?>
                                                    <option value="Paystack"><?php echo e($langg->lang764); ?></option>
                                                <?php endif; ?>
                                                <?php if($gs->is_molly == 1): ?>
                                                    <option value="Molly"><?php echo e($langg->lang802); ?></option>
                                                <?php endif; ?>
                                                <?php if($gs->is_paytm == 1): ?>
                                                    <option value="Paytm"><?php echo e($langg->paytm); ?></option>
                                                <?php endif; ?>
                                                <?php if($gs->is_razorpay == 1): ?>
                                                    <option value="Razorpay"><?php echo e($langg->razorpay); ?></option>
                                                <?php endif; ?>
                                                 <?php if($gs->payle_checkout == 1): ?>
                                                    <option value="Payle">Payle</option>
                                                <?php endif; ?>

                                            </select>

                                    </div>
                                </div>


                                            <div id="stripes" style="display: none;">

                                    <br>



                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    <?php echo e($langg->lang422); ?> *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="card" id="scard" placeholder="<?php echo e($langg->lang422); ?>">
                                            </div>
                                        </div>

                                    <br>


                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    <?php echo e($langg->lang423); ?> *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="cvv" id="scvv" placeholder="<?php echo e($langg->lang423); ?>">
                                            </div>
                                        </div>

                                    <br>


                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    <?php echo e($langg->lang424); ?> *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="month" id="smonth" placeholder="<?php echo e($langg->lang424); ?>">
                                            </div>
                                        </div>


                                    <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    <?php echo e($langg->lang425); ?> *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="year" id="syear" placeholder="<?php echo e($langg->lang425); ?>">
                                            </div>
                                        </div>

                                            </div>
                                            <div id="paypals">
                                                <input type="hidden" name="cmd" value="_xclick">
                                                <input type="hidden" name="no_note" value="1">
                                                <input type="hidden" name="lc" value="UK">
                                                <input type="hidden" name="currency_code" value="<?php echo e(strtoupper($subs->currency_code)); ?>">
                                                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">
                                                <input type="hidden" name="ref_id" id="ref_id" value="">
                                                <input type="hidden" name="sub" id="sub" value="0">
                                                <input type="hidden" name="ck" id="ck" value="0">
                                            </div>

                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-lg-4">
                                    </div>
                                    <div class="col-lg-8">
                                            <button type="submit" id="final-btn" class="mybtn1"><?php echo e($langg->lang426); ?></button>
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



<?php $__env->startSection('scripts'); ?>

<script src="https://js.paystack.co/v1/inline.js"></script>

<script type="text/javascript">
    
        $(document).on('submit','#paystack-form',function(e){
            var val = $('#sub').val();
                if(val == 0)
                {            
                    $.get('<?php echo e(route('user.paystack.check').'?shop_name='); ?>'+$('#shop-name').val(), function(data, status){


                          if ((data.errors)) {

                          $('.alert-danger').show();
                          $('.alert-danger ul').html('');
                            for(var error in data.errors)
                            {
                              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
                              $('#sub').val('0');
                              $('#ck').val('1');
                            }

                          }
                          else {
                            $('#ck').val('0');
                          }

              

                    });

setTimeout(function(){ 

if($('#ck').val() == '0') {

                            $('#preloader').hide();

                            var total = <?php echo e($subs->price); ?>;

                                var handler = PaystackPop.setup({
                                  key: '<?php echo e($gs->paystack_key); ?>',
                                  email: '<?php echo e($user->email); ?>',
                                  amount: total * 100,
                                  currency: "<?php echo e(strtoupper($subs->currency_code)); ?>",
                                  ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                                  callback: function(response){
                                    $('#ref_id').val(response.reference);
                                    $('#sub').val('1');
                                    $('#final-btn').click();
                                  },
                                  onClose: function(){
                                  }
                                });
                                handler.openIframe();
                                    return false;    



}



 }, 1000);
  



                                    return false;

                }


                            else {
                                $('#preloader').show();
                                return true;   
                            }


        });

</script>


<?php if($subs->price != 0): ?>
<script type="text/javascript">
        function meThods(val) {
            var action1 = "<?php echo e(route('user.paypal.submit')); ?>";
            var action2 = "<?php echo e(route('user.stripe.submit')); ?>";
            var action3 = "<?php echo e(route('user.instamojo.submit')); ?>";
            var action4 = "<?php echo e(route('user.paystack.submit')); ?>";
            var action5 = "<?php echo e(route('user.molly.submit')); ?>";
            var action6 = "<?php echo e(route('user.paytm.submit')); ?>";
            var action7 = "<?php echo e(route('user.razorpay.submit')); ?>";
            var action8 = "<?php echo e(route('user.payle.submit')); ?>";

             if (val.value == "Paypal") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action1);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#stripes").hide();

            }
            else if (val.value == "Payle") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action8);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#stripes").hide();
            }
            else if (val.value == "Instamojo") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action3);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#stripes").hide();
            }

            else if (val.value == "Molly") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action5);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#stripes").hide();
            }

            else if (val.value == "Paytm") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action6);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#stripes").hide();
            }

            else if (val.value == "Razorpay") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action7);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#stripes").hide();
            }

            else if (val.value == "Paystack") {
               $('.pay-form').attr('id','paystack-form');
                $(".pay-form").attr("action", action4);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#stripes").hide();
            }

            else if (val.value == "Stripe") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action2);
                $("#scard").prop("required", true);
                $("#scvv").prop("required", true);
                $("#smonth").prop("required", true);
                $("#syear").prop("required", true);
                $("#stripes").show();
            }
        }    
</script>
<?php endif; ?>

<script type="text/javascript">
    
$(document).on('submit','#subscribe-form',function(){
     $('#preloader').show();
});
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>