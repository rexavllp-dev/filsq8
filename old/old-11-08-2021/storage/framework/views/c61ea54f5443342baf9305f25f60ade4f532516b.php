<div id="quick-details" class="row product-details-page py-0">
  <div class="col-lg-5">

<div class="xzoom-container">
    <img class="quick-zoom" id="xzoom-magnific1" src="<?php echo e(filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)); ?>" xoriginal="<?php echo e(filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)); ?>" />
    <div class="xzoom-thumbs">

      <div class="quick-all-slider">

          <a href="<?php echo e(filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)); ?>">
        <img class="quick-zoom-gallery" width="80" src="<?php echo e(filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)); ?>" title="The description goes here">
          </a>

      <?php $__currentLoopData = $product->galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


          <a href="<?php echo e(asset('assets/images/galleries/'.$gal->photo)); ?>">
        <img class="quick-zoom-gallery" width="80" src="<?php echo e(asset('assets/images/galleries/'.$gal->photo)); ?>" title="The description goes here">
          </a>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
        
    </div>
</div>

<?php if(!empty($product->whole_sell_qty)): ?>
<div class="table-area wholesell-details-page">
<h3><?php echo e($langg->lang770); ?></h3>
<table class="table">
<tr>
  <th><?php echo e($langg->lang768); ?></th>
  <th><?php echo e($langg->lang769); ?></th>
</tr>
<?php $__currentLoopData = $product->whole_sell_qty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td><?php echo e($product->whole_sell_qty[$key]); ?>+</td>
  <td><?php echo e($product->whole_sell_discount[$key]); ?>% <?php echo e($langg->lang771); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</div>
<?php endif; ?>


  </div>
<div class="col-lg-7">
<div class="right-area">
  <div class="product-info">
      <h4 class="product-name"><a target="_blank" href="<?php echo e(route('front.product',$product->slug)); ?>"><?php echo e($product->name); ?></a></h4>
        <div class="info-meta-1">
          <ul>

            <?php if($product->type == 'Physical'): ?>
            <?php if($product->emptyStock()): ?>
            <li class="product-outstook">
              <p>
                <i class="icofont-close-circled"></i>
                <?php echo e($langg->lang78); ?>

              </p>
            </li>
            <?php else: ?>
            <li class="product-isstook">
              <p>
                <i class="icofont-check-circled"></i>
                <?php echo e($gs->show_stock == 0 ? '' : $product->stock); ?> <?php echo e($langg->lang79); ?>

              </p>
            </li>
            <?php endif; ?>
            <?php endif; ?>
            <li>
              <div class="ratings">
                <div class="empty-stars"></div>
                <div class="full-stars" style="width:<?php echo e(App\Models\Rating::ratings($product->id)); ?>%"></div>
              </div>
            </li>
            <li class="review-count">
              <p><?php echo e(count($product->ratings)); ?> <?php echo e($langg->lang80); ?></p>
            </li>
            <?php if($product->product_condition != 0): ?>
            <li>
              <div class="<?php echo e($product->product_condition == 2 ? 'mybadge' : 'mybadge1'); ?>">
               <?php echo e($product->product_condition == 2 ? 'New' : 'Used'); ?>

              </div>
            </li>
         <?php endif; ?>
          </ul>
        </div>



        <div class="info-meta-2">
          <ul>

            <?php if($product->type == 'License'): ?>

            <?php if($product->platform != null): ?>
            <li>
              <p><?php echo e($langg->lang82); ?>: <b><?php echo e($product->platform); ?></b></p>
            </li>
            <?php endif; ?>

            <?php if($product->region != null): ?>
            <li>
              <p><?php echo e($langg->lang83); ?>: <b><?php echo e($product->region); ?></b></p>
            </li>
            <?php endif; ?>

            <?php if($product->licence_type != null): ?>
            <li>
              <p><?php echo e($langg->lang84); ?>: <b><?php echo e($product->licence_type); ?></b></p>
            </li>
            <?php endif; ?>

            <?php endif; ?>


          </ul>
        </div>


      <div class="product-price">
          <p class="title"><?php echo e($langg->lang87); ?> :</p>
          <p class="price"><span id="msizeprice"><?php echo e($product->showPrice()); ?></span>
            <small><del><?php echo e($product->showPreviousPrice()); ?></del></small></p>
            <?php if($product->youtube != null): ?>
            <a href="<?php echo e($product->youtube); ?>" class="video-play-btn mfp-iframe">
              <i class="fas fa-play"></i>
            </a> 
          <?php endif; ?>
      </div>
      <?php if(!empty($product->size)): ?>
          <div class="mproduct-size">
              <p class="title"><?php echo e($langg->lang88); ?> :</p>
              <ul class="siz-list">
                  <?php
                      $is_first = true;
                  ?>
                  <?php $__currentLoopData = $product->size; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="<?php echo e($is_first ? 'active' : ''); ?>">
              <span class="box"><?php echo e($data1); ?>

                  <input type="hidden" class="msize" value="<?php echo e($data1); ?>">
        <input type="hidden" class="msize_qty" value="<?php echo e($product->size_qty[$key]); ?>">
        <input type="hidden" class="msize_key" value="<?php echo e($key); ?>">
        <input type="hidden" class="msize_price" value="<?php echo e(round($product->size_price[$key] * $curr->value,2)); ?>">
              </span>
                      </li>
                      <?php
                          $is_first = false;
                      ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <li>
              </ul>
          </div>
      <?php endif; ?>

      <?php if(!empty($product->color)): ?>
          <div class="mproduct-color">
              <p class="title"><?php echo e($langg->lang89); ?> :</p>
              <ul class="color-list">
                  <?php
                      $is_first = true;
                  ?>
                  <?php $__currentLoopData = $product->color; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="<?php echo e($is_first ? 'active' : ''); ?>">
                          <span class="box"  data-color="<?php echo e($product->color[$key]); ?>" style="background-color: <?php echo e($product->color[$key]); ?>"></span>
                      </li>
                      <?php
                          $is_first = false;
                      ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </ul>
          </div>
      <?php endif; ?>

      <?php if(!empty($product->size)): ?>

          <input type="hidden" class="product-stock" id="stock" value="<?php echo e($product->size_qty[0]); ?>">
      <?php else: ?>
          <?php
              $stck = (string)$product->stock;
          ?>
          <?php if($stck != null): ?>
              <input type="hidden" class="product-stock"  value="<?php echo e($stck); ?>">
          <?php elseif($product->type != 'Physical'): ?>
              <input type="hidden" class="product-stock"  value="0">
          <?php else: ?>
              <input type="hidden" class="product-stock" value="">
          <?php endif; ?>

      <?php endif; ?>
      <input type="hidden" id="mproduct_price" value="<?php echo e(round($product->vendorPrice() * $curr->value,2)); ?>">
      <input type="hidden" id="mproduct_id" value="<?php echo e($product->id); ?>">
      <input type="hidden" id="mcurr_pos" value="<?php echo e($gs->currency_format); ?>">
      <input type="hidden" id="mcurr_sign" value="<?php echo e($curr->sign); ?>">
      <div class="info-meta-3">
          <ul class="meta-list">
            <?php if($product->product_type != "affiliate"): ?>
            <li class="count <?php echo e($product->type == 'Physical' ? '' : 'd-none'); ?>">
                <div class="qty">
                    <ul>
                        <li>
                <span class="modal-minus">
                  <i class="icofont-minus"></i>
                </span>
                        </li>
                        <li>
                            <span class="modal-total">1</span>
                        </li>
                        <li>
                <span class="modal-plus">
                  <i class="icofont-plus"></i>
                </span>
                        </li>
                    </ul>
                </div>
            </li>
            <?php endif; ?>


            <?php if(!empty($product->attributes)): ?>
              <?php
                $attrArr = json_decode($product->attributes, true);
                // dd($attrArr);
              ?>
            <?php endif; ?>
            <?php if(!empty($attrArr)): ?>
              <div class="product-attributes my-4">
                <div class="row">
                <?php $__currentLoopData = $attrArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attrKey => $attrVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1): ?>

                <div class="col-lg-6">
                    <div class="form-group mb-2">
                      <strong for="" class="text-capitalize"><?php echo e(str_replace("_", " ", $attrKey)); ?> :</strong>
                      <div class="">
                      <?php $__currentLoopData = $attrVal['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="custom-control custom-radio">
                          <input type="hidden" class="keys" value="">
                          <input type="hidden" class="values" value="">
                          <input type="radio" id="<?php echo e($attrKey); ?><?php echo e($optionKey); ?>" name="<?php echo e($attrKey); ?>" class="custom-control-input mproduct-attr"  data-key="<?php echo e($attrKey); ?>" data-price = "<?php echo e($attrVal['prices'][$optionKey] * $curr->value); ?>" value="<?php echo e($optionVal); ?>" <?php echo e($loop->first ? 'checked' : ''); ?>>
                          <label class="custom-control-label" for="<?php echo e($attrKey); ?><?php echo e($optionKey); ?>"><?php echo e($optionVal); ?>

                          <?php if(!empty($attrVal['prices'][$optionKey])): ?>
                            +
                            <?php echo e($curr->sign); ?> <?php echo e($attrVal['prices'][$optionKey] * $curr->value); ?>

                          <?php endif; ?>
                        </label>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    </div>
                </div>
                <?php endif; ?> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              </div>
            <?php endif; ?>


              <?php if($product->product_type == "affiliate"): ?>

              <li class="addtocart">
                <a href="<?php echo e(route('affiliate.product', $product->slug)); ?>" target="_blank"><i
                    class="icofont-cart"></i> <?php echo e($langg->lang251); ?></a>
              </li>
              <?php else: ?>
              <?php if($product->stock === 0): ?>
              <li class="addtocart">
                <a href="javascript:;" class="cart-out-of-stock">
                  <i class="icofont-close-circled"></i> 
                  <?php echo e($langg->lang78); ?></a>
              </li>                    
              <?php else: ?> 
              <li class="addtocart">
                <a href="javascript:;" id="maddcrt"><i class="icofont-cart"></i><?php echo e($langg->lang90); ?></a>
              </li>

              <li class="addtocart">
                <a id="mqaddcrt" href="javascript:;">
                  <i class="icofont-cart"></i><?php echo e($langg->lang251); ?>

                </a>
              </li>
              <?php endif; ?>

              <?php endif; ?>
              <?php if(Auth::guard('web')->check()): ?>
                  <li class="favorite">
                      <a href="javascript:;" class="add-to-wish" data-href="<?php echo e(route('user-wishlist-add',$product->id)); ?>"><i class="icofont-heart-alt"></i></a>
                  </li>
              <?php else: ?>
                  <li class="favorite">
                      <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i class="icofont-heart-alt"></i></a>
                  </li>
              <?php endif; ?>
              <li class="compare">
                  <a href="javascript:;" class="add-to-compare" data-href="<?php echo e(route('product.compare.add',$product->id)); ?>"><i class="icofont-exchange"></i></a>
              </li>
          </ul>
        <?php if($product->ship != null): ?>
          <p class="estimate-time"><?php echo e($langg->lang86); ?>: <b> <?php echo e($product->ship); ?></b></p>
        <?php endif; ?>
        <?php if( $product->sku != null ): ?>
        <p class="p-sku">
          <?php echo e($langg->lang77); ?>: <span class="idno"><?php echo e($product->sku); ?></span>
        </p>
        <?php endif; ?>



      </div>
  </div>
</div>
</div>
</div>

<style type="text/css">

@media (min-width: 1200px) { 

.xzoom-preview {
width: 450px !important;
height: 390px !important;
background: white;
position: inherit;
z-index: 99999;
<?php if($langg->rtl == "1"): ?>
right: 900px;
<?php endif; ?>
}

}




</style>

<script src="<?php echo e(asset('assets/front/js/quicksetup.js')); ?>"></script>

<script type="text/javascript">

//   magnific popup activation
$('.video-play-btn').magnificPopup({
type: 'video'
});


var sizes = "";
var size_qty = "";
var size_price = "";
var size_key = "";
var colors = "";
var mtotal = "";
var mstock = $('.product-stock').val();
var keys = "";
var values = "";
var prices = "";

$('.mproduct-attr').on('change',function(){

var total;
total = mgetAmount()+mgetSizePrice();
total = total.toFixed(2);
var pos = $('#mcurr_pos').val();
var sign = $('#mcurr_sign').val();
if(pos == '0')
{
$('#msizeprice').html(sign+total);
}
else {
$('#msizeprice').html(total+sign);
}
});



function mgetSizePrice()
{

var total = 0;
if($('.mproduct-size .siz-list li').length > 0)
{
total = parseFloat($('.mproduct-size .siz-list li.active').find('.msize_price').val());
}
return total;
}


function mgetAmount()
{
var total = 0;
var value = parseFloat($('#mproduct_price').val());
var datas = $(".mproduct-attr:checked").map(function() {
return $(this).data('price');
}).get();

var data;
for (data in datas) {
total += parseFloat(datas[data]);
}
total += value;
return total;
}


// Product Details Product Size Active Js Code
$('.mproduct-size .siz-list .box').on('click', function () {

$('.modal-total').html('1');
var parent = $(this).parent();
size_qty = $(this).find('.msize_qty').val();
size_price = $(this).find('.msize_price').val();
size_key = $(this).find('.msize_key').val();
sizes = $(this).find('.msize').val();
      $('.mproduct-size .siz-list li').removeClass('active');
      parent.addClass('active');
total = mgetAmount()+parseFloat(size_price);
stock = size_qty;
total = total.toFixed(2);
var pos = $('#mcurr_pos').val();
var sign = $('#mcurr_sign').val();
if(pos == '0')
{
$('#msizeprice').html(sign+total);
}
else {
$('#msizeprice').html(total+sign);
}

});

// Product Details Product Color Active Js Code
$('.mproduct-color .color-list .box').on('click', function () {
colors = $(this).data('color');
var parent = $(this).parent();
$('.mproduct-color .color-list li').removeClass('active');
parent.addClass('active');

});

$('.modal-minus').on('click', function () {
var el = $(this);
var $tselector = el.parent().parent().find('.modal-total');
total = $($tselector).text();
if (total > 1) {
  total--;
}
$($tselector).text(total);
});

$('.modal-plus').on('click', function () {
var el = $(this);
var $tselector = el.parent().parent().find('.modal-total');
total = $($tselector).text();
if(mstock != "")
{
  var stk = parseInt(mstock);
  if(total < stk)
  {
      total++;
      $($tselector).text(total);
  }
}
else {
  total++;
}
$($tselector).text(total);
});

$("#maddcrt").on("click", function(){
var qty = $('.modal-total').html();
var pid = $(this).parent().parent().parent().parent().find("#mproduct_id").val();

if($('.mproduct-attr').length > 0)
{
values = $(".mproduct-attr:checked").map(function() {
return $(this).val();
}).get();

keys = $(".mproduct-attr:checked").map(function() {
return $(this).data('key');
}).get();


prices = $(".mproduct-attr:checked").map(function() {
return $(this).data('price');
}).get();

}



$.ajax({
  type: "GET",
  url:mainurl+"/addnumcart",
  data:{id:pid,qty:qty,size:sizes,color:colors,size_qty:size_qty,size_price:size_price,size_key:size_key,keys:keys,values:values,prices:prices},
  success:function(data){
      if(data == 'digital') {
          toastr.error(langg.already_cart);
      }
      else if(data == 0) {
          toastr.error(langg.out_stock);
      }
      else {
          $("#cart-count").html(data[0]);
          $("#cart-items").load(mainurl+'/carts/view');
          toastr.success(langg.add_cart);
      }
  }
});
});


$(document).on("click", "#mqaddcrt" , function(){
      var qty = $('.modal-total').html();
      var pid = $(this).parent().parent().parent().parent().find("#mproduct_id").val();
 
if($('.mproduct-attr').length > 0)
{
values = $(".mproduct-attr:checked").map(function() {
return $(this).val();
}).get();

keys = $(".mproduct-attr:checked").map(function() {
return $(this).data('key');
}).get();


prices = $(".mproduct-attr:checked").map(function() {
return $(this).data('price');
}).get();

}

 
  window.location = mainurl+"/addtonumcart?id="+pid+"&qty="+qty+"&size="+sizes+"&color="+colors.substring(1, colors.length)+"&size_qty="+size_qty+"&size_price="+size_price+"&size_key="+size_key+"&keys="+keys+"&values="+values+"&prices="+prices;
 

 

     });


</script>