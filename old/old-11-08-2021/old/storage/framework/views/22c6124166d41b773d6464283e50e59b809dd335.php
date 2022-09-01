 

<?php $__env->startSection('content'); ?>  
                    <div class="content-area">
                        <div class="mr-breadcrumb">
                            <div class="row">
                                <div class="col-lg-12">
                                        <h4 class="heading"><?php echo e($langg->lang443); ?></h4>
                                        <ul class="links">
                                            <li>
                                                <a href="<?php echo e(route('vendor-dashboard')); ?>"><?php echo e($langg->lang441); ?> </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;"><?php echo e($langg->lang442); ?></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(route('vendor-order-index')); ?>"><?php echo e($langg->lang443); ?></a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mr-table allproduct">
                                        <?php echo $__env->make('includes.form-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

                                        <div class="table-responsiv">
                                        <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                                <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo e($langg->lang534); ?></th>
                                                            <th><?php echo e($langg->lang535); ?></th>
                                                            <th><?php echo e($langg->lang536); ?></th>
                                                            <th><?php echo e($langg->lang537); ?></th>
                                                            <th><?php echo e($langg->lang538); ?></th>
                                                        </tr>
                                                    </thead>


                                              <tbody>
                                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <?php 
                                                $qty = $orderr->sum('qty');
                                                $price = $orderr->sum('price');                                       
                                                ?>
                    <?php $__currentLoopData = $orderr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<?php 

  if($user->shipping_cost != 0){
      $price +=  round($user->shipping_cost * $order->order->currency_value , 2);

    }

  if(isset(App\Models\Order::where('order_number','=',$order->order->order_number)->first()->tax)){
    if(App\Models\Order::where('order_number','=',$order->order->order_number)->first()->tax != 0){
      $price  += ($price / 100) * App\Models\Order::where('order_number','=',$order->order->order_number)->first()->tax;
    }  
  }
    

?>
                                                        <tr>
                                                    <td> <a href="<?php echo e(route('vendor-order-invoice',$order->order_number)); ?>"><?php echo e($order->order->order_number); ?></a></td>
                                          <td><?php echo e($qty); ?></td>
                                      <td><?php echo e($order->order->currency_sign); ?><?php echo e(round($price * $order->order->currency_value, 2)); ?></td>
                                      <td><?php echo e($order->order->method); ?></td>
                                      <td>

                                        <div class="action-list">

                                        <a href="<?php echo e(route('vendor-order-show',$order->order->order_number)); ?>" class="btn btn-primary product-btn"><i class="fa fa-eye"></i> <?php echo e($langg->lang539); ?></a>
                                            <select class="vendor-btn <?php echo e($order->status); ?>">
                                            <option value="<?php echo e(route('vendor-order-status',['slug' => $order->order->order_number, 'status' => 'pending'])); ?>" <?php echo e($order->status == "pending" ? 'selected' : ''); ?>><?php echo e($langg->lang540); ?></option>
                                            <option value="<?php echo e(route('vendor-order-status',['slug' => $order->order->order_number, 'status' => 'processing'])); ?>" <?php echo e($order->status == "processing" ? 'selected' : ''); ?>><?php echo e($langg->lang541); ?></option>
                                            <option value="<?php echo e(route('vendor-order-status',['slug' => $order->order->order_number, 'status' => 'completed'])); ?>" <?php echo e($order->status == "completed" ? 'selected' : ''); ?>><?php echo e($langg->lang542); ?></option>
                                            <option value="<?php echo e(route('vendor-order-status',['slug' => $order->order->order_number, 'status' => 'declined'])); ?>" <?php echo e($order->status == "declined" ? 'selected' : ''); ?>><?php echo e($langg->lang543); ?></option>
                                            </select>

                                        </div>

                                        </td>

                                                  </tr>

                                                  <?php break; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </tbody>
                                                    
                                                </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



<div class="modal fade" id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="submit-loader">
        <img  src="<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>" alt="">
    </div>
    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block"><?php echo e($langg->lang544); ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p class="text-center"><?php echo e($langg->lang545); ?></p>
        <p class="text-center"><?php echo e($langg->lang546); ?></p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e($langg->lang547); ?></button>
            <a class="btn btn-success btn-ok order-btn"><?php echo e($langg->lang548); ?></a>
      </div>

    </div>
  </div>
</div>




<?php $__env->stopSection(); ?>    

<?php $__env->startSection('scripts'); ?>



    <script type="text/javascript">


$('.vendor-btn').on('change',function(){
          $('#confirm-delete2').modal('show');
          $('#confirm-delete2').find('.btn-ok').attr('href', $(this).val());

});

        var table = $('#geniustable').DataTable({
               ordering: false
           });
                                                                
    </script>


    
<?php $__env->stopSection(); ?>   
<?php echo $__env->make('layouts.vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>