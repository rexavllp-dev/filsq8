<?php if(Auth::guard('web')->check()): ?>

<div class="review-area">
  <h4 class="title"><?php echo e($langg->lang104); ?></h4>
</div>
<div class="write-comment-area">
  <form id="comment-form" action="<?php echo e(route('product.comment')); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="product_id" id="product_id" value="<?php echo e($productt->id); ?>">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::guard('web')->user()->id); ?>">
    <div class="row">
      <div class="col-lg-12">
      <textarea placeholder="<?php echo e($langg->lang105); ?>" name="text"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <button class="submit-btn" type="submit"><?php echo e($langg->lang106); ?></button>
      </div>
    </div>
  </form>
</div>
<br>


<ul class="all-comment">
<?php if($productt->comments): ?>  
<?php $__currentLoopData = $productt->comments()->orderBy('created_at','desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <li>
    <div class="single-comment comment-section">
      <div class="left-area">
        <img src="<?php echo e($comment->user->photo != null ? asset('assets/images/users/'.$comment->user->photo) : asset('assets/images/noimage.png')); ?>" alt="">
        <h5 class="name"><?php echo e($comment->user->name); ?></h5>
        <p class="date"><?php echo e($comment->created_at->diffForHumans()); ?></p>
      </div>
      <div class="right-area">
        <div class="comment-body">
          <p>
            <?php echo e($comment->text); ?>

          </p>
        </div>
        <div class="comment-footer">
          <div class="links">
            <a href="javascript:;" class="comment-link reply mr-2"><i class="fas fa-reply "></i><?php echo e($langg->lang107); ?></a>
            <?php if(count($comment->replies) > 0): ?>
            <a href="javascript:;" class="comment-link view-reply mr-2"><i class="fas fa-eye "></i><?php echo e($langg->lang108); ?> <?php echo e(count($comment->replies) == 1 ? $langg->lang109 : $langg->lang110); ?></a>
            <?php endif; ?>
          <?php if(Auth::guard('web')->user()->id == $comment->user->id): ?>
            <a href="javascript:;" class="comment-link edit mr-2"><i class="fas fa-edit "></i><?php echo e($langg->lang111); ?></a>
            <a href="javascript:;" data-href="<?php echo e(route('product.comment.delete',$comment->id)); ?>" class="comment-link comment-delete mr-2"><i class="fas fa-trash"></i><?php echo e($langg->lang112); ?></a>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="replay-area edit-area">
      <form class="update" action="<?php echo e(route('product.comment.edit',$comment->id)); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

        <textarea placeholder="<?php echo e($langg->lang113); ?>" name="text" required=""></textarea>
        <button type="submit"><?php echo e($langg->lang114); ?></button>
        <a href="javascript:;" class="remove"><?php echo e($langg->lang115); ?></a>
      </form>
    </div>
<?php if($comment->replies): ?>
  <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="single-comment replay-review hidden">
      <div class="left-area">
        <img src="<?php echo e($reply->user->photo != null ? asset('assets/images/users/'.$reply->user->photo) : asset('assets/images/noimage.png')); ?>" alt="">
        <h5 class="name"><?php echo e($reply->user->name); ?></h5>
        <p class="date"><?php echo e($reply->created_at->diffForHumans()); ?></p>
      </div>
      <div class="right-area">
        <div class="comment-body">
          <p>
            <?php echo e($reply->text); ?>

          </p>
        </div>
        <div class="comment-footer">
          <div class="links">

            <a href="javascript:;" class="comment-link reply mr-2"><i class="fas fa-reply "></i><?php echo e($langg->lang107); ?></a>
          <?php if(Auth::guard('web')->user()->id == $reply->user->id): ?>
            <a href="javascript:;" class="comment-link edit mr-2"><i class="fas fa-edit "></i><?php echo e($langg->lang111); ?></a>
            <a href="javascript:;" data-href="<?php echo e(route('product.reply.delete',$reply->id)); ?>" class="comment-link reply-delete mr-2"><i class="fas fa-trash"></i><?php echo e($langg->lang112); ?></a>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="replay-area edit-area">
      <form class="update" action="<?php echo e(route('product.reply.edit',$reply->id)); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

        <textarea placeholder="<?php echo e($langg->lang116); ?>" name="text" required=""></textarea>
        <button type="submit"><?php echo e($langg->lang114); ?></button>
        <a href="javascript:;" class="remove"><?php echo e($langg->lang115); ?></a>
      </form>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
    
    <div class="replay-area reply-reply-area">
      <form class="reply-form" action="<?php echo e(route('product.reply',$comment->id)); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="user_id" value="<?php echo e(Auth::guard('web')->user()->id); ?>">
        <textarea placeholder="<?php echo e($langg->lang117); ?>" name="text" required=""></textarea>
        <button type="submit"><?php echo e($langg->lang114); ?></button>
        <a href="javascript:;" class="remove"><?php echo e($langg->lang115); ?></a>
      </form>
    </div>

  </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</ul>


<?php else: ?>
<div class="row">
<div class="col-lg-12">
<br>
  <h3 class="text-center"><a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg" class="btn login-btn"><?php echo e($langg->lang101); ?></a> <?php echo e($langg->lang103); ?> </h3>
<br>
</div>
</div>

<?php if($productt->comments): ?>  
<ul class="all-comment">

  <?php $__currentLoopData = $productt->comments()->orderBy('created_at','desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

  <li>
    <div class="single-comment">
      <div class="left-area">
        <img src="<?php echo e($comment->user->photo != null ? asset('assets/images/users/'.$comment->user->photo) : asset('assets/images/noimage.png')); ?>" alt="">
        <h5 class="name"><?php echo e($comment->user->name); ?></h5>
        <p class="date"><?php echo e($comment->created_at->diffForHumans()); ?></p>
      </div>
      <div class="right-area">
        <div class="comment-body">
          <p>
            <?php echo e($comment->text); ?>

          </p>
        </div>
        <div class="comment-footer">
          <div class="links">

            <?php if(count($comment->replies) > 0): ?>
            <a href="javascript:;" class="comment-link view-reply mr-2"><i class="fas fa-eye "></i><?php echo e($langg->lang108); ?> <?php echo e(count($comment->replies) == 1 ? $langg->lang109 : $langg->lang110); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

<?php if($comment->replies): ?>
  <?php $__currentLoopData = $comment->replies()->orderBy('created_at','desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="single-comment replay-review hidden">
      <div class="left-area">
        <img src="<?php echo e($reply->user->photo != null ? asset('assets/images/users/'.$reply->user->photo) : asset('assets/images/noimage.png')); ?>" alt="">
        <h5 class="name"><?php echo e($reply->user->name); ?></h5>
        <p class="date"><?php echo e($reply->created_at->diffForHumans()); ?></p>
      </div>
      <div class="right-area">
        <div class="comment-body">
          <p>
            <?php echo e($reply->text); ?>

          </p>
        </div>

      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
    
  </li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php endif; ?>

<?php endif; ?>