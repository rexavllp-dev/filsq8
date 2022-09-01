<?php $__env->startSection('content'); ?>


  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <ul class="pages">

          

          <?php if(isset($bcat)): ?>
                
              <li>
                <a href="<?php echo e(route('front.index')); ?>">
                  <?php echo e($langg->lang17); ?>

                </a>
              </li>
              <li>
                <a href="<?php echo e(route('front.blog')); ?>">
                  <?php echo e($langg->lang18); ?>

                </a>
              </li>
              <li>
                <a href="<?php echo e(route('front.blogcategory',$bcat->slug)); ?>">
                  <?php echo e($bcat->name); ?>

                </a>
              </li>

          <?php elseif(isset($slug)): ?>

              <li>
                <a href="<?php echo e(route('front.index')); ?>">
                  <?php echo e($langg->lang17); ?>

                </a>
              </li>
              <li>
                <a href="<?php echo e(route('front.blog')); ?>">
                  <?php echo e($langg->lang18); ?>

                </a>
              </li>
              <li>
                <a href="<?php echo e(route('front.blogtags',$slug)); ?>">
                  <?php echo e($langg->lang35); ?>: <?php echo e($slug); ?>

                </a>
              </li>

          <?php elseif(isset($search)): ?>
                
              <li>
                <a href="<?php echo e(route('front.index')); ?>">
                  <?php echo e($langg->lang17); ?>

                </a>
              </li>
              <li>
                <a href="<?php echo e(route('front.blog')); ?>">
                  <?php echo e($langg->lang18); ?>

                </a>
              </li>
              <li>
                <a href="Javascript:;">
                  <?php echo e($langg->lang36); ?>

                </a>
              </li>
              <li>
                <a href="Javascript:;">
                  <?php echo e($search); ?>

                </a>
              </li>

          <?php elseif(isset($date)): ?>
                
              <li>
                <a href="<?php echo e(route('front.index')); ?>">
                  <?php echo e($langg->lang17); ?>

                </a>
              </li>
              <li>
                <a href="<?php echo e(route('front.blog')); ?>">
                  <?php echo e($langg->lang18); ?>

                </a>
              </li>
              <li>
                <a href="Javascript:;">
                  <?php echo e($langg->lang37); ?>: <?php echo e(date('F Y',strtotime($date))); ?>

                </a>
              </li>

          <?php else: ?>
                
              <li>
                <a href="<?php echo e(route('front.index')); ?>">
                  <?php echo e($langg->lang17); ?>

                </a>
              </li>
              <li>
                <a href="<?php echo e(route('front.blog')); ?>">
                  <?php echo e($langg->lang18); ?>

                </a>
              </li>
          <?php endif; ?>

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb Area End -->

  <!-- Blog Page Area Start -->
  <section class="blogpagearea">
    <div class="container">
      <div id="ajaxContent">

      <div class="row">

        <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-lg-4">
              <div class="blog-box">
                <div class="blog-images">
                    <div class="img">
                    <img src="<?php echo e($blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png')); ?>" class="img-fluid" alt="">
                    <div class="date d-flex justify-content-center">
                      <div class="box align-self-center">
                        <p><?php echo e(date('d', strtotime($blogg->created_at))); ?></p>
                        <p><?php echo e(date('M', strtotime($blogg->created_at))); ?></p>
                      </div>
                    </div>
                    </div>
                </div>
                <div class="details">
                    <a href='<?php echo e(route('front.blogshow',$blogg->id)); ?>'>
                      <h4 class="blog-title">
                        <?php echo e(mb_strlen($blogg->title,'utf-8') > 50 ? mb_substr($blogg->title,0,50,'utf-8')."...":$blogg->title); ?>

                      </h4>
                    </a>
                  <p class="blog-text">
                    <?php echo e(substr(strip_tags($blogg->details),0,120)); ?>

                  </p>
                  <a class="read-more-btn" href="<?php echo e(route('front.blogshow',$blogg->id)); ?>"><?php echo e($langg->lang38); ?></a>
                </div>
            </div>
        </div>


        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>

        <div class="page-center">
          <?php echo $blogs->links(); ?>               
        </div>
</div>

    </div>
  </section>
  <!-- Blog Page Area Start -->




<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
  

    // Pagination Starts

    $(document).on('click', '.pagination li', function (event) {
      event.preventDefault();
      if ($(this).find('a').attr('href') != '#' && $(this).find('a').attr('href')) {
        $('#preloader').show();
        $('#ajaxContent').load($(this).find('a').attr('href'), function (response, status, xhr) {
          if (status == "success") {
            $("html,body").animate({
              scrollTop: 0
            }, 1);
            $('#preloader').fadeOut();


          }

        });
      }
    });

    // Pagination Ends

</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>