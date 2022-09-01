
<?php $__env->startSection('content'); ?>

                        <div class="content-area no-padding">
                            <div class="add-product-content1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-description">
                                            <div class="body-area">

                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th width="50%"><?php echo e(__("Customer ID#")); ?></th>
                                                <td><?php echo e($subs->user->id); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo e(__("Name")); ?></th>
                                                <td><?php echo e($subs->user->name); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo e(__("Email")); ?></th>
                                                <td><?php echo e($subs->user->email); ?></td>
                                            </tr>
                                            <?php if($subs->user->phone != ""): ?>
                                            <tr>
                                                <th><?php echo e(__("Phone")); ?></th>
                                                <td><?php echo e($subs->user->phone); ?></td>
                                            </tr>
                                            <?php endif; ?>

                                            <?php if($subs->user->fax != ""): ?>
                                            <tr>
                                                <th><?php echo e(__("Fax")); ?></th>
                                                <td><?php echo e($subs->user->fax); ?></td>
                                            </tr>
                                            <?php endif; ?>

                                            <?php if($subs->user->address != ""): ?>
                                            <tr>
                                                <th><?php echo e(__("Address")); ?></th>
                                                <td><?php echo e($subs->user->address); ?></td>
                                            </tr>
                                            <?php endif; ?>

                                            <?php if($subs->user->city != ""): ?>
                                            <tr>
                                                <th><?php echo e(__("City")); ?></th>
                                                <td><?php echo e($subs->user->city); ?></td>
                                            </tr>
                                            <?php endif; ?>

                                            <?php if($subs->user->zip != ""): ?>
                                            <tr>
                                                <th><?php echo e(__("Zip")); ?></th>
                                                <td><?php echo e($subs->user->zip); ?></td>
                                            </tr>
                                            <?php endif; ?>

                                            <tr>
                                                <th><?php echo e(__("Vendor Name")); ?></th>
                                                <td><?php echo e($subs->user->owner_name); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Vendor Phone Number")); ?></th>
                                                <td><?php echo e($subs->user->shop_number); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Vendor Shop Address")); ?></th>
                                                <td><?php echo e($subs->user->shop_address); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Vendor Registration Number")); ?></th>
                                                <td><?php echo e($subs->user->reg_number); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Vendor Message")); ?></th>
                                                <td><?php echo e($subs->user->shop_message); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Subscription Plan")); ?></th>
                                                <td><?php echo e($subs->title); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Currency Symbol")); ?></th>
                                                <td><?php echo e($subs->currency); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Cost")); ?></th>
                                                <td><?php echo e($subs->price); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Duration")); ?></th>
                                                <td><?php echo e($subs->days); ?> <?php echo e(__("Days")); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Details")); ?></th>
                                                <td><?php echo $subs->details; ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Duration")); ?></th>
                                                <td><?php echo e($subs->days); ?> <?php echo e(__("Days")); ?></td>
                                            </tr>

                                            <tr>
                                                <th><?php echo e(__("Method")); ?></th>
                                                <td><?php echo e($subs->method); ?></td>
                                            </tr>


                                          <?php if($subs->method == "Stripe"): ?>
                                            <tr>
                                                <th><?php echo e(__("Transaction ID")); ?></th>
                                                <td><?php echo e($subs->txnid); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo e(__("Charge ID")); ?></th>
                                                <td><?php echo e($subs->charge_id); ?></td>
                                            </tr>
                                            <?php elseif($subs->method == "Paypal"): ?>
                                            <tr>
                                                <th><?php echo e(__("Transaction ID")); ?></th>
                                                <td><?php echo e($subs->txnid); ?></td>
                                            </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <th><?php echo e(__("Purchase Time")); ?></th>
                                                <td><?php echo e($subs->created_at->diffForHumans()); ?></td>
                                            </tr>

                                        </table>
                                    </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.load', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>