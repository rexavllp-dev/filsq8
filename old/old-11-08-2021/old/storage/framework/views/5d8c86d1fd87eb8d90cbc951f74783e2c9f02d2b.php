
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
              <a href="<?php echo e(route('front.blog')); ?>">
                <?php echo e($langg->lang18); ?>

              </a>
            </li>
            <li>
              <a href="<?php echo e(route('front.blogshow',$blog->id)); ?>">
                <?php echo e($langg->lang39); ?>

              </a>
            </li>
          </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->



  <!-- Blog Details Area Start -->
  <section class="blog-details" id="blog-details">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="blog-content">
            <div class="feature-image">
              <img class="img-fluid" src="<?php echo e(asset('assets/images/blogs/'.$blog->photo)); ?>" alt="">
            </div>
            <div class="content">
                <h3 class="title">
                    <?php echo e($blog->title); ?>

                  </h3>
                  <ul class="post-meta">
                    <li>
                      <a href="javascript:;">
                        <i class="icofont-calendar"></i>
                        <?php echo e(date('d M, Y',strtotime($blog->created_at))); ?>

                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                          <i class="icofont-eye"></i>
                        <?php echo e($blog->views); ?> <?php echo e($langg->lang40); ?>

                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <i class="icofont-speech-comments"></i>
                        <?php echo e($langg->lang41); ?> : <?php echo e($blog->source); ?>

                      </a>
                    </li>
                  </ul>

                  <?php echo $blog->details; ?>


                  <div class="tag-social-link">
                    <div class="tag">
                      <h6 class="title">Tag : </h6>
                      <?php $__currentLoopData = explode(',', $blog->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('front.blogtags',$tag)); ?>">
                        <?php echo e($tag); ?><?php echo e($key != count(explode(',', $blog->tags)) - 1  ? ',':''); ?>

                        </a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="social-sharing a2a_kit a2a_kit_size_32">
                    <ul class="social-links">
                      <li>
                        <a class="facebook a2a_button_facebook" href="">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>
                        <li>
                            <a class="twitter a2a_button_twitter" href="">
                              <i class="fab fa-twitter"></i>
                            </a>
                          
                        </li>
                        <li>
                            <a class="linkedin a2a_button_linkedin" href="">
                              <i class="fab fa-linkedin-in"></i>
                            </a>

                        </li>
                        <li>
                          
                        <a class="a2a_dd plus" href="https://www.addtoany.com/share">
                            <i class="fas fa-plus"></i>
                          </a>
                        </li>
                      
                    </ul>
                    </div>
                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                  </div>
            </div>
          </div>


       
    <?php if($gs->is_disqus == 1): ?>
      <div class="comments">
           <?php echo $gs->disqus; ?>

      </div>
    <?php endif; ?>
    

      </div>

        <div class="col-lg-4">
          <div class="blog-aside">
            <div class="serch-form">
              <form action="<?php echo e(route('front.blogsearch')); ?>">
                <input type="text" name="search" placeholder="<?php echo e($langg->lang46); ?>" required="">
                <button type="submit"><i class="icofont-search"></i></button>
              </form>
            </div>
            <div class="categori">
              <h4 class="title"><?php echo e($langg->lang42); ?></h4>
              <span class="separator"></span>
              <ul class="categori-list">
                <?php $__currentLoopData = $bcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <a href="<?php echo e(route('front.blogcategory',$cat->slug)); ?>"  <?php echo $cat->id == $blog->category_id ? 'class="active"':''; ?>>
                    <span><?php echo e($cat->name); ?></span>
                    <span>(<?php echo e($cat->blogs()->count()); ?>)</span>
                  </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </ul>
            </div>
            <div class="recent-post-widget">
              <h4 class="title"><?php echo e($langg->lang43); ?></h4>
              <span class="separator"></span>
              <ul class="post-list">

                <?php $__currentLoopData = App\Models\Blog::orderBy('created_at', 'desc')->limit(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <div class="post">
                    <div class="post-img">
                      <img style="width: 73px; height: 59px;" src="<?php echo e(asset('assets/images/blogs/'.$blog->photo)); ?>" alt="">
                    </div>
                    <div class="post-details">
                      <a href="<?php echo e(route('front.blogshow',$blog->id)); ?>">
                          <h4 class="post-title">
                              <?php echo e(mb_strlen($blog->title,'utf-8') > 45 ? mb_substr($blog->title,0,45,'utf-8')." .." : $blog->title); ?>

                          </h4>
                      </a>
                      <p class="date">
                          <?php echo e(date('M d - Y',(strtotime($blog->created_at)))); ?>

                      </p>
                    </div>
                  </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


              </ul>
            </div>
            <div class="archives">
              <h4 class="title"><?php echo e($langg->lang44); ?></h4>
              <span class="separator"></span>
              <ul class="archives-list">
                <?php $__currentLoopData = $archives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $archive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <a href="<?php echo e(route('front.blogarchive',$key)); ?>">
                    <span><?php echo e($key); ?></span>
                    <span>(<?php echo e(count($archive)); ?>)</span>
                  </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
            <div class="tags">
              <h4 class="title"><?php echo e($langg->lang45); ?></h4>
              <span class="separator"></span>
              <ul class="tags-list">
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(!empty($tag)): ?>
                  <li>
                    <a href="<?php echo e(route('front.blogtags',$tag)); ?>"><?php echo e($tag); ?> </a>
                  </li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Blog Details Area End-->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>