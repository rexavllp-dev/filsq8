        <div class="col-lg-4">
                    <?php if($gs->reg_vendor == 1): ?>
            <div class="row mt-4">
              <div class="col-lg-12 text-center">
                <a href="<?php echo e(route('user-package')); ?>" class="mybtn1 lg">
                  <i class="fas fa-dollar-sign"></i> <?php echo e(Auth::user()->is_vendor == 1 ? $langg->lang233 : (Auth::user()->is_vendor == 0 ? $langg->lang233 : $langg->lang237)); ?>

                </a>
              </div>
            </div>
          <?php endif; ?>
          <br>
          <br>
          <div class="user-profile-info-area">
            <ul class="links">
                <?php

                  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                  {
                    $link = "https";
                  }
                  else
                  {
                    $link = "http";

                    // Here append the common URL characters.
                    $link .= "://";

                    // Append the host(domain name, ip) to the URL.
                    $link .= $_SERVER['HTTP_HOST'];

                    // Append the requested resource location to the URL
                    $link .= $_SERVER['REQUEST_URI'];
                  }

                ?>
              <li class="<?php echo e($link == route('user-dashboard') ? 'active':''); ?>">
                <a href="<?php echo e(route('user-dashboard')); ?>">
                  <?php echo e($langg->lang200); ?>

                </a>
              </li>

              <?php if(Auth::user()->IsVendor()): ?>
                <li>
                  <a href="<?php echo e(route('vendor-dashboard')); ?>">
                    <?php echo e($langg->lang230); ?>

                  </a>
                </li>
              <?php endif; ?>

              <li class="<?php echo e($link == route('user-orders') ? 'active':''); ?>">
                <a href="<?php echo e(route('user-orders')); ?>">
                  <?php echo e($langg->lang201); ?>

                </a>
              </li>

              <?php if($gs->is_affilate == 1): ?>

                <li class="<?php echo e($link == route('user-affilate-code') ? 'active':''); ?>">
                    <a href="<?php echo e(route('user-affilate-code')); ?>"><?php echo e($langg->lang202); ?></a>
                </li>

                <li class="<?php echo e($link == route('user-wwt-index') ? 'active':''); ?>">
                    <a href="<?php echo e(route('user-wwt-index')); ?>"><?php echo e($langg->lang203); ?></a>
                </li>

              <?php endif; ?>


              <li class="<?php echo e($link == route('user-order-track') ? 'active':''); ?>">
                  <a href="<?php echo e(route('user-order-track')); ?>"><?php echo e($langg->lang772); ?></a>
              </li>

              <li class="<?php echo e($link == route('user-favorites') ? 'active':''); ?>">
                  <a href="<?php echo e(route('user-favorites')); ?>"><?php echo e($langg->lang231); ?></a>
              </li>

              <li class="<?php echo e($link == route('user-messages') ? 'active':''); ?>">
                  <a href="<?php echo e(route('user-messages')); ?>"><?php echo e($langg->lang232); ?></a>
              </li>

              <li class="<?php echo e($link == route('user-message-index') ? 'active':''); ?>">
                  <a href="<?php echo e(route('user-message-index')); ?>"><?php echo e($langg->lang204); ?></a>
              </li>

              <li class="<?php echo e($link == route('user-dmessage-index') ? 'active':''); ?>">
                  <a href="<?php echo e(route('user-dmessage-index')); ?>"><?php echo e($langg->lang250); ?></a>
              </li>

              <li class="<?php echo e($link == route('user-profile') ? 'active':''); ?>">
                <a href="<?php echo e(route('user-profile')); ?>">
                  <?php echo e($langg->lang205); ?>

                </a>
              </li>

              <li class="<?php echo e($link == route('user-reset') ? 'active':''); ?>">
                <a href="<?php echo e(route('user-reset')); ?>">
                 <?php echo e($langg->lang206); ?>

                </a>
              </li>

              <li>
                <a href="<?php echo e(route('user-logout')); ?>">
                  <?php echo e($langg->lang207); ?>

                </a>
              </li>

            </ul>
          </div>

        </div>