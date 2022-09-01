<?php $__env->startSection('content'); ?>

<!-- Breadcrumb Area Start -->
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
                        <a href="<?php echo e(route('front.contact')); ?>">
                            <?php echo e($langg->lang20); ?>

                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->


    <!-- Contact Us Area Start -->
    <section class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-section-title">
                            <?php echo $ps->contact_title; ?>

                            <?php echo $ps->contact_text; ?>

                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="left-area">
                        <div class="contact-form">
                            <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                            <form id="contactform" action="<?php echo e(route('front.contact.submit')); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>

                                    <?php echo $__env->make('includes.admin.form-both', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  

                                    <div class="form-input">
                                        <input type="text" name="name" placeholder="<?php echo e($langg->lang47); ?> *" required="">
                                        <i class="icofont-user-alt-5"></i>
                                    </div>
                                    <div class="form-input">
                                            <input type="text" name="phone"  placeholder="<?php echo e($langg->lang48); ?> *">
																						<i class="icofont-ui-call"></i>
                                    </div>
                                    <div class="form-input">
                                            <input type="email" name="email"  placeholder="<?php echo e($langg->lang49); ?> *" required="">
																						<i class="icofont-envelope"></i>
                                    </div>
                                    <div class="form-input">
                                            <textarea name="text" placeholder="<?php echo e($langg->lang50); ?> *" required=""></textarea>
                                    </div>
   
                                    <?php if($gs->is_capcha == 1): ?>

                                    <ul class="captcha-area">
                                        <li>
                                            <p><img class="codeimg1" src="<?php echo e(asset("assets/images/capcha_code.png")); ?>" alt=""> <i class="fas fa-sync-alt pointer refresh_code"></i></p>
                                        
                                        </li>
                                        <li>
                                                <input name="codes" type="text" class="input-field" placeholder="<?php echo e($langg->lang51); ?>" required="">
                                                
                                            </li>
                                    </ul>

                                    <?php endif; ?>


                                    <input type="hidden" name="to" value="<?php echo e($ps->contact_email); ?>">
                                    <button class="submit-btn" type="submit"><?php echo e($langg->lang52); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="right-area">

                        <?php if($ps->site != null || $ps->email != null ): ?>
                        <div class="contact-info ">
                            <div class="left ">
                                    <div class="icon">
                                            <i class="icofont-email"></i>
                                    </div>
                            </div>
                            <div class="content d-flex align-self-center">
                                <div class="content">
                                        <?php if($ps->site != null && $ps->email != null): ?> 
                                        <a href="<?php echo e($ps->site); ?>" target="_blank"><?php echo e($ps->site); ?></a>
                                        <a href="mailto:<?php echo e($ps->email); ?>"><?php echo e($ps->email); ?></a>
                                        <?php elseif($ps->site != null): ?>
                                        <a href="<?php echo e($ps->site); ?>" target="_blank"><?php echo e($ps->site); ?></a>
                                        <?php else: ?>
                                        <a href="mailto:<?php echo e($ps->email); ?>"><?php echo e($ps->email); ?></a>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($ps->street != null): ?> 
                        <div class="contact-info">
                                <div class="left">
                                        <div class="icon">
                                                <i class="icofont-google-map"></i>
                                        </div>
                                </div>
                                <div class="content d-flex align-self-center">
                                    <div class="content">
                                            <p>
                                                <?php if($ps->street != null): ?> 
                                                    <?php echo $ps->street; ?>

                                                <?php endif; ?>
                                            </p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($ps->phone != null || $ps->fax != null ): ?> 
                            <div class="contact-info">
                                    <div class="left">
                                            <div class="icon">
                                                    <i class="icofont-smart-phone"></i>
                                            </div>
                                    </div>
                                    <div class="content d-flex align-self-center">
                                        <div class="content">
                                            <?php if($ps->phone != null && $ps->fax != null): ?>
                                            <a href="tel:<?php echo e($ps->phone); ?>"><?php echo e($ps->phone); ?></a>
                                            <a href="tel:<?php echo e($ps->fax); ?>"><?php echo e($ps->fax); ?></a>
                                            <?php elseif($ps->phone != null): ?>
                                            <a href="tel:<?php echo e($ps->phone); ?>"><?php echo e($ps->phone); ?></a>
                                            <?php else: ?>
                                            <a href="tel:<?php echo e($ps->fax); ?>"><?php echo e($ps->fax); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                        <?php endif; ?>


                                <div class="social-links">
                                    <h4 class="title"><?php echo e($langg->lang53); ?> :</h4>
                                    <ul>

                                     <?php if(App\Models\Socialsetting::find(1)->f_status == 1): ?>
                                      <li>
                                        <a href="<?php echo e(App\Models\Socialsetting::find(1)->facebook); ?>" class="facebook" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                      </li>
                                      <?php endif; ?>

                                      <?php if(App\Models\Socialsetting::find(1)->g_status == 1): ?>
                                      <li>
                                        <a href="<?php echo e(App\Models\Socialsetting::find(1)->gplus); ?>" class="google-plus" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                      </li>
                                      <?php endif; ?>

                                      <?php if(App\Models\Socialsetting::find(1)->t_status == 1): ?>
                                      <li>
                                        <a href="<?php echo e(App\Models\Socialsetting::find(1)->twitter); ?>" class="twitter" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                      </li>
                                      <?php endif; ?>

                                      <?php if(App\Models\Socialsetting::find(1)->l_status == 1): ?>
                                      <li>
                                        <a href="<?php echo e(App\Models\Socialsetting::find(1)->linkedin); ?>" class="linkedin" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                      </li>
                                      <?php endif; ?>

                                      <?php if(App\Models\Socialsetting::find(1)->d_status == 1): ?>
                                      <li>
                                        <a href="<?php echo e(App\Models\Socialsetting::find(1)->dribble); ?>" class="dribbble" target="_blank">
                                            <i class="fab fa-dribbble"></i>
                                        </a>
                                      </li>
                                      <?php endif; ?>

                                        </ul>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us Area End-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>