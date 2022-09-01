
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
            <a href="<?php echo e(route('front.cart')); ?>">
              <?php echo e($langg->lang121); ?>

            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Cart Area Start -->
<section class="cartpage">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="left-area">
          <div class="cart-table">
            <table class="table">
              <?php echo $__env->make('includes.form-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <thead>
                    <tr>
                      <th><?php echo e($langg->lang122); ?></th>
                      <th width="30%"><?php echo e($langg->lang539); ?></th>
                      <th><?php echo e($langg->lang125); ?></th>
                      <th><?php echo e($langg->lang126); ?></th>
                      <th><i class="icofont-close-squared-alt"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(Session::has('cart')): ?>

                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="cremove<?php echo e($product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])); ?>">
                      <td class="product-img">
                        <div class="item">
                          <img src="<?php echo e($product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png')); ?>" alt="">
                          <p class="name"><a href="<?php echo e(route('front.product', $product['item']['slug'])); ?>"><?php echo e(mb_strlen($product['item']['name'],'utf-8') > 35 ? mb_substr($product['item']['name'],0,35,'utf-8').'...' : $product['item']['name']); ?></a></p>
                        </div>
                      </td>
                                            <td>
                                                <?php if(!empty($product['size'])): ?>
                                                <b><?php echo e($langg->lang312); ?></b>: <?php echo e($product['item']['measure']); ?><?php echo e(str_replace('-',' ',$product['size'])); ?> <br>
                                                <?php endif; ?>
                                                <?php if(!empty($product['color'])): ?>
                                                <div class="d-flex mt-2">
                                                <b><?php echo e($langg->lang313); ?></b>:  <span id="color-bar" style="border: 10px solid #<?php echo e($product['color'] == "" ? "white" : $product['color']); ?>;"></span>
                                                </div>
                                                <?php endif; ?>

                                                    <?php if(!empty($product['keys'])): ?>

                                                    <?php $__currentLoopData = array_combine(explode(',', $product['keys']), explode(',', $product['values'])); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <b><?php echo e(ucwords(str_replace('_', ' ', $key))); ?> : </b> <?php echo e($value); ?> <br>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php endif; ?>

                                                  </td>




                      <td class="unit-price quantity">
                        <p class="product-unit-price">
                          <?php echo e(App\Models\Product::convertPrice($product['item']['price'])); ?>                        
                        </p>
          <?php if($product['item']['type'] == 'Physical'): ?>

                          <div class="qty">
                              <ul>
              <input type="hidden" class="prodid" value="<?php echo e($product['item']['id']); ?>">  
              <input type="hidden" class="itemid" value="<?php echo e($product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])); ?>">     
              <input type="hidden" class="size_qty" value="<?php echo e($product['size_qty']); ?>">     
              <input type="hidden" class="size_price" value="<?php echo e($product['item']['price']); ?>">   
                                <li>
                                  <span class="qtminus1 reducing">
                                    <i class="icofont-minus"></i>
                                  </span>
                                </li>
                                <li>
                                  <span class="qttotal1" id="qty<?php echo e($product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])); ?>"><?php echo e($product['qty']); ?></span>
                                </li>
                                <li>
                                  <span class="qtplus1 adding">
                                    <i class="icofont-plus"></i>
                                  </span>
                                </li>
                              </ul>
                          </div>
        <?php endif; ?>


                      </td>

                            <?php if($product['size_qty']): ?>
                            <input type="hidden" id="stock<?php echo e($product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])); ?>" value="<?php echo e($product['size_qty']); ?>">
                            <?php elseif($product['item']['type'] != 'Physical'): ?> 
                            <input type="hidden" id="stock<?php echo e($product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])); ?>" value="1">
                            <?php else: ?>
                            <input type="hidden" id="stock<?php echo e($product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])); ?>" value="<?php echo e($product['stock']); ?>">
                            <?php endif; ?>

                      <td class="total-price">
                        <p id="prc<?php echo e($product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])); ?>">
                          <?php echo e(App\Models\Product::convertPrice($product['price'])); ?>                 
                        </p>
                      </td>
                      <td>
                        <span class="removecart cart-remove" data-class="cremove<?php echo e($product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])); ?>" data-href="<?php echo e(route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']))); ?>"><i class="icofont-ui-delete"></i> </span>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php if(Session::has('cart')): ?>
      <div class="col-lg-4">
        <div class="right-area">
          <div class="order-box">
            <h4 class="title"><?php echo e($langg->lang127); ?></h4>
            <ul class="order-list">
              <li>
                <p>
                  <?php echo e($langg->lang128); ?>

                </p>
                <P>
                  <b class="cart-total"><?php echo e(Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00'); ?></b>
                </P>
              </li>
              <li>
                <p>
                  <?php echo e($langg->lang129); ?>

                </p>
                <P>
                  <b class="discount"><?php echo e(App\Models\Product::convertPrice(0)); ?></b>
                  <input type="hidden" id="d-val" value="<?php echo e(App\Models\Product::convertPrice(0)); ?>">
                </P>
              </li>
              <li>
                <p>
                  <?php echo e($langg->lang130); ?>

                </p>
                <P>
                  <b><?php echo e($tx); ?>%</b>
                </P>
              </li>
            </ul>
            <div class="total-price">
              <p>
                  <?php echo e($langg->lang131); ?>

              </p>
              <p>
                  <span class="main-total"><?php echo e(Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00'); ?></span>
              </p>
            </div>
            <div class="cupon-box">
              <div id="coupon-link">
                  <?php echo e($langg->lang132); ?>

              </div>
              <form id="coupon-form" class="coupon">
                <input type="text" placeholder="<?php echo e($langg->lang133); ?>" id="code" required="" autocomplete="off">
                <input type="hidden" class="coupon-total" id="grandtotal" value="<?php echo e(Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00'); ?>">
                <button type="submit"><?php echo e($langg->lang134); ?></button>
              </form>
            </div>
            <a href="<?php echo e(route('front.checkout')); ?>" class="order-btn">
              <?php echo e($langg->lang135); ?>

            </a>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- Cart Area End -->
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>