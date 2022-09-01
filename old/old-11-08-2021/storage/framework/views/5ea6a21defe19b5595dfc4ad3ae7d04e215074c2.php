                                
                                <?php if($prod->user_id != 0): ?>

                                
                                <?php if($prod->user->is_vendor == 2): ?>

													<li>
														<div class="single-box">
															<div class="left-area">
																<img src="<?php echo e($prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png')); ?>" alt="">
															</div>
															<div class="right-area">
																	<div class="stars">
					                                                  <div class="ratings">
					                                                      <div class="empty-stars"></div>
					                                                      <div class="full-stars" style="width:<?php echo e(App\Models\Rating::ratings($prod->id)); ?>%"></div>
					                                                  </div>
																		</div>
																		<h4 class="price"><?php echo e($prod->showPrice()); ?> <del><?php echo e($prod->showPreviousPrice()); ?></del> </h4>
																		<p class="text"><a href="<?php echo e(route('front.product',$prod->slug)); ?>"><?php echo e(mb_strlen($prod->name,'utf-8') > 35 ? mb_substr($prod->name,0,35,'utf-8').'...' : $prod->name); ?></a></p>
															</div>
														</div>
													</li>


								<?php endif; ?>

                                

								<?php else: ?> 

													<li>
														<div class="single-box">
															<div class="left-area">
																<img src="<?php echo e($prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png')); ?>" alt="">
															</div>
															<div class="right-area">
																	<div class="stars">
					                                                  <div class="ratings">
					                                                      <div class="empty-stars"></div>
					                                                      <div class="full-stars" style="width:<?php echo e(App\Models\Rating::ratings($prod->id)); ?>%"></div>
					                                                  </div>
																		</div>
																		<h4 class="price"><?php echo e($prod->showPrice()); ?> <del><?php echo e($prod->showPreviousPrice()); ?></del> </h4>
																		<p class="text"><a href="<?php echo e(route('front.product',$prod->slug)); ?>"><?php echo e(mb_strlen($prod->name,'utf-8') > 35 ? mb_substr($prod->name,0,35,'utf-8').'...' : $prod->name); ?></a></p>
															</div>
														</div>
													</li>
								

								<?php endif; ?>

