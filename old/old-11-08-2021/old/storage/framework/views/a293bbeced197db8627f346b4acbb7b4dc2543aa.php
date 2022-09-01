						<div class="item-filter">

							<ul class="filter-list">
								<li class="item-short-area">
										<p><?php echo e($langg->lang64); ?> :</p>
										<form id="sortForm" class="d-inline-block" action="<?php echo e(route('front.vendor', Request::route('category'))); ?>" method="get">
											<?php if(!empty(request()->input('min'))): ?>
												<input type="hidden" name="min" value="<?php echo e(request()->input('min')); ?>">
											<?php endif; ?>
											<?php if(!empty(request()->input('max'))): ?>
												<input type="hidden" name="max" value="<?php echo e(request()->input('max')); ?>">
											<?php endif; ?>
											<select id name="sort" class="short-item" onchange="document.getElementById('sortForm').submit()">
		                    <option value="date_desc" <?php echo e(request()->input('sort') == 'date_desc' ? 'selected' : ''); ?>><?php echo e($langg->lang65); ?></option>
		                    <option value="date_asc" <?php echo e(request()->input('sort') == 'date_asc' ? 'selected' : ''); ?>><?php echo e($langg->lang66); ?></option>
		                    <option value="price_asc" <?php echo e(request()->input('sort') == 'price_asc' ? 'selected' : ''); ?>><?php echo e($langg->lang67); ?></option>
		                    <option value="price_desc" <?php echo e(request()->input('sort') == 'price_desc' ? 'selected' : ''); ?>><?php echo e($langg->lang68); ?></option>
											</select>
										</form>
								</li>
							</ul>
						</div>
