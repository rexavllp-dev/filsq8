
									<div class="col-lg-4 col-md-4 col-6 remove-padding">


										<a href="<?php echo e(route('front.product', $prod->slug)); ?>" class="item">
											<div class="item-img">
												<?php if(!empty($prod->features)): ?>
													<div class="sell-area">
													  <?php $__currentLoopData = $prod->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<span class="sale" style="background-color:<?php echo e($prod->colors[$key]); ?>"><?php echo e($prod->features[$key]); ?></span>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</div>
												<?php endif; ?>
													<div class="extra-list">
														<ul>
															<li>
																<?php if(Auth::guard('web')->check()): ?>

																<span class="add-to-wish" data-href="<?php echo e(route('user-wishlist-add',$prod->id)); ?>" data-toggle="tooltip" data-placement="right" title="<?php echo e($langg->lang54); ?>" data-placement="right"><i class="icofont-heart-alt" ></i>
																</span>

																<?php else: ?>

																<span rel-toggle="tooltip" title="<?php echo e($langg->lang54); ?>" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																	<i class="icofont-heart-alt"></i>
																</span>

																<?php endif; ?>
															</li>
															<li>
															<span class="quick-view" rel-toggle="tooltip" title="<?php echo e($langg->lang55); ?>" href="javascript:;" data-href="<?php echo e(route('product.quick',$prod->id)); ?>" data-toggle="modal" data-target="#quickview" data-placement="right"> <i class="icofont-eye"></i>
															</span>
															</li>
															<li>
																<span class="add-to-compare" data-href="<?php echo e(route('product.compare.add',$prod->id)); ?>"  data-toggle="tooltip" data-placement="right" title="<?php echo e($langg->lang57); ?>" data-placement="right">
																	<i class="icofont-exchange"></i>
																</span>
															</li>
														</ul>
													</div>
												<img class="img-fluid" src="<?php echo e($prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png')); ?>" alt="">
											</div>
											<div class="info">
												<div class="stars">
                            <div class="ratings">
                                <div class="empty-stars"></div>
                                <div class="full-stars" style="width:<?php echo e(App\Models\Rating::ratings($prod->id)); ?>%"></div>
                            </div>
												</div>
												<h4 class="price"><?php echo e($prod->setCurrency()); ?> <del><small><?php echo e($prod->showPreviousPrice()); ?></small></del></h4>
														<h5 class="name"><?php echo e($prod->showName()); ?></h5>
														<div class="item-cart-area">
															<span onclick="window.location = '<?php echo e(route('front.product', $prod->slug)); ?>" class="add-to-cart-btn">
																	<i class="icofont-eye"></i> View Product
																</span>
														</div>
											</div>
										</a>

									</div>
