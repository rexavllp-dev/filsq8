
<?php $__env->startSection('styles'); ?>

<link href="<?php echo e(asset('assets/vendor/css/product.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/admin/css/jquery.Jcrop.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/admin/css/Jcrop-style.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading"><?php echo e($langg->lang629); ?> <a class="add-btn" href="<?php echo e(route('vendor-prod-types')); ?>"><i
							class="fas fa-arrow-left"></i> <?php echo e($langg->lang550); ?></a></h4>
				<ul class="links">
					<li>
						<a href="<?php echo e(route('vendor-dashboard')); ?>"><?php echo e($langg->lang441); ?></a>
					</li>
					<li>
						<a href="javascript:;"><?php echo e($langg->lang444); ?> </a>
					</li>
					<li>
						<a href="<?php echo e(route('vendor-prod-index')); ?>"><?php echo e($langg->lang446); ?></a>
					</li>
					<li>
						<a href="<?php echo e(route('vendor-prod-types')); ?>"><?php echo e($langg->lang445); ?></a>
					</li>
					<li>
						<a href="<?php echo e(route('vendor-prod-physical-create')); ?>"><?php echo e($langg->lang629); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<form id="geniusform" action="<?php echo e(route('vendor-prod-store')); ?>" method="POST"
	enctype="multipart/form-data">
	<?php echo e(csrf_field()); ?>

	<div class="row">
		<div class="col-lg-8">
			<div class="add-product-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-description">
							<div class="body-area">
		
								<div class="gocover"
									style="background: url(<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
								</div>
							
		
									<?php echo $__env->make('includes.vendor.form-both', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading"><?php echo e($langg->lang632); ?>* </h4>
												<p class="sub-heading"><?php echo e($langg->lang517); ?></p>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="<?php echo e($langg->lang632); ?>"
												name="name" required="">
										</div>
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading"><?php echo e($langg->lang793); ?>* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="<?php echo e($langg->lang794); ?>"
												name="sku" required=""
												value="<?php echo e(str_random(3).substr(time(), 6,8).str_random(3)); ?>">
		
											<div class="checkbox-wrapper">
												<input type="checkbox" name="product_condition_check" class="checkclick"
													id="conditionCheck" value="1">
												<label for="conditionCheck"><?php echo e($langg->lang633); ?></label>
											</div>
		
										</div>
									</div>
		
									<div class="showbox">
		
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading"><?php echo e($langg->lang634); ?>*</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<select name="product_condition">
													<option value="2"><?php echo e($langg->lang635); ?></option>
													<option value="1"><?php echo e($langg->lang636); ?></option>
												</select>
											</div>
		
										</div>
		
		
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading"><?php echo e($langg->lang637); ?>*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="cat" name="category_id" required="">
												<option value=""><?php echo e($langg->lang691); ?></option>
												<?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option data-href="<?php echo e(route('vendor-subcat-load',$cat->id)); ?>"
													value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading"><?php echo e($langg->lang638); ?>*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="subcat" name="subcategory_id" disabled="">
												<option value=""><?php echo e($langg->lang639); ?></option>
											</select>
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading"><?php echo e($langg->lang640); ?>*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="childcat" name="childcategory_id" disabled="">
												<option value=""><?php echo e($langg->lang641); ?></option>
											</select>
										</div>
									</div>
		
		
									<div id="catAttributes"></div>
									<div id="subcatAttributes"></div>
									<div id="childcatAttributes"></div>
		
					
		
					
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
		
											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="shipping_time_check" type="checkbox"
														id="check1" value="1">
													<label for="check1"><?php echo e($langg->lang646); ?></label>
												</li>
											</ul>
										</div>
									</div>
		
		
		
									<div class="showbox">
		
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading"><?php echo e($langg->lang647); ?>* </h4>
												</div>
											</div>
											<div class="col-lg-12">
												<input type="text" class="input-field" placeholder="<?php echo e($langg->lang647); ?>"
													name="ship">
											</div>
										</div>
		
		
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
		
											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input name="size_check" type="checkbox" id="size-check" value="1">
													<label for="size-check"><?php echo e($langg->lang648); ?></label>
												</li>
											</ul>
										</div>
									</div>
									<div class="showbox" id="size-display">
										<div class="row">
											<div class="col-lg-12">
											</div>
											<div class="col-lg-12">
												<div class="product-size-details" id="size-section">
													<div class="size-area">
														<span class="remove size-remove"><i class="fas fa-times"></i></span>
														<div class="row">
															<div class="col-md-4 col-sm-6">
																<label>
																	<?php echo e($langg->lang649); ?> :
																	<span>
																		<?php echo e($langg->lang650); ?>

																	</span>
																</label>
																<input type="text" name="size[]" class="input-field"
																	placeholder="<?php echo e($langg->lang649); ?>">
															</div>
															<div class="col-md-4 col-sm-6">
																<label>
																	<?php echo e($langg->lang651); ?> :
																	<span>
																		<?php echo e($langg->lang652); ?>

																	</span>
																</label>
																<input type="number" name="size_qty[]" class="input-field"
																	placeholder="Size Qty" value="1" min="1">
															</div>
															<div class="col-md-4 col-sm-6">
																<label>
																	<?php echo e($langg->lang653); ?> :
																	<span>
																		<?php echo e($langg->lang654); ?>

																	</span>
																</label>
																<input type="number" name="size_price[]" class="input-field"
																	placeholder="Size Price" value="0" min="0">
															</div>
														</div>
													</div>
												</div>
		
												<a href="javascript:;" id="size-btn" class="add-more"><i
														class="fas fa-plus"></i><?php echo e($langg->lang655); ?> </a>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
		
											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="color_check" type="checkbox" id="check3"
														value="1">
													<label for="check3"><?php echo e($langg->lang656); ?></label>
												</li>
											</ul>
										</div>
									</div>
		
		
		
									<div class="showbox">
		
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">
														<?php echo e($langg->lang657); ?>*
													</h4>
													<p class="sub-heading">
														<?php echo e($langg->lang658); ?>

													</p>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="select-input-color" id="color-section">
													<div class="color-area">
														<span class="remove color-remove"><i class="fas fa-times"></i></span>
														<div class="input-group colorpicker-component cp">
															<input type="text" name="color[]" value="#000000"
																class="input-field cp" />
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
												</div>
												<a href="javascript:;" id="color-btn" class="add-more mt-4 mb-3"><i
														class="fas fa-plus"></i><?php echo e($langg->lang659); ?> </a>
											</div>
										</div>
		
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
		
											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="whole_check" type="checkbox"
														id="whole_check" value="1">
													<label for="whole_check"><?php echo e($langg->lang660); ?></label>
												</li>
											</ul>
										</div>
									</div>
		
									<div class="showbox">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
		
												</div>
											</div>
											<div class="col-lg-12">
												<div class="featured-keyword-area">
													<div class="feature-tag-top-filds" id="whole-section">
														<div class="feature-area">
															<span class="remove whole-remove"><i
																	class="fas fa-times"></i></span>
															<div class="row">
																<div class="col-lg-6">
																	<input type="number" name="whole_sell_qty[]"
																		class="input-field" placeholder="<?php echo e($langg->lang661); ?>"
																		min="0">
																</div>
		
																<div class="col-lg-6">
																	<input type="number" name="whole_sell_discount[]"
																		class="input-field" placeholder="<?php echo e($langg->lang662); ?>"
																		min="0" />
																</div>
															</div>
														</div>
													</div>
		
													<a href="javascript:;" id="whole-btn" class="add-fild-btn"><i
															class="icofont-plus"></i> <?php echo e($langg->lang663); ?></a>
												</div>
											</div>
										</div>
									</div>
		
						
		
									<div class="row" id="stckprod">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading"><?php echo e($langg->lang669); ?>*</h4>
												<p class="sub-heading"><?php echo e($langg->lang670); ?></p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="stock" type="text" class="input-field"
												placeholder="<?php echo e($langg->lang666); ?>">
											<div class="checkbox-wrapper">
												<input type="checkbox" name="measure_check" class="checkclick"
													id="allowProductMeasurement" value="1">
												<label for="allowProductMeasurement"><?php echo e($langg->lang671); ?></label>
											</div>
										</div>
									</div>
		
		
		
									<div class="showbox">
		
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading"><?php echo e($langg->lang672); ?>*</h4>
												</div>
											</div>
											<div class="col-lg-6">
												<select id="product_measure">
													<option value=""><?php echo e($langg->lang673); ?></option>
													<option value="Gram"><?php echo e($langg->lang674); ?></option>
													<option value="Kilogram"><?php echo e($langg->lang675); ?></option>
													<option value="Litre"><?php echo e($langg->lang676); ?></option>
													<option value="Pound"><?php echo e($langg->lang677); ?></option>
													<option value="Custom"><?php echo e($langg->lang678); ?></option>
												</select>
											</div>
											<div class="col-lg-6 hidden" id="measure">
												<input name="measure" type="text" id="measurement" class="input-field"
													placeholder="<?php echo e($langg->lang679); ?>">
											</div>
										</div>
		
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													<?php echo e($langg->lang680); ?>*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea class="nic-edit-p" name="details"></textarea>
											</div>
										</div>
									</div>
		
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													<?php echo e($langg->lang681); ?>*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea class="nic-edit-p" name="policy"></textarea>
											</div>
										</div>
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="checkbox-wrapper">
												<input type="checkbox" name="seo_check" value="1" class="checkclick"
													id="allowProductSEO" value="1">
												<label for="allowProductSEO"><?php echo e($langg->lang683); ?></label>
											</div>
										</div>
									</div>
		
		
		
									<div class="showbox">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading"><?php echo e($langg->lang684); ?> *</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<ul id="metatags" class="myTags">
												</ul>
											</div>
										</div>
		
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">
														<?php echo e($langg->lang685); ?> *
													</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="text-editor">
													<textarea name="meta_description" class="input-field"
														placeholder="<?php echo e($langg->lang685); ?>"></textarea>
												</div>
											</div>
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12 text-center">
											<button class="addProductSubmit-btn" type="submit"><?php echo e($langg->lang690); ?></button>
										</div>
									</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="add-product-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-description">
							<div class="body-area">
		
								
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading"><?php echo e($langg->lang511); ?> *</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="img-upload custom-image-upload">
												<div id="image-preview" class="img-preview"
													style="background: url(<?php echo e(asset('assets/vendor/images/upload.png')); ?>);">
													<label for="image-upload" class="img-label" id="image-label"><i
															class="icofont-upload-alt"></i><?php echo e($langg->lang512); ?></label>
													<input type="file" name="photo" class="img-upload-p" id="image-upload"
														required>
												</div>
												<p class="img-alert mt-2 text-danger d-none"></p>
												<p class="text">
													<?php echo e(isset($langg->lang805) ? $langg->lang805 : 'Prefered Size: (800x800) or Square Size.'); ?>

												</p>
											</div>
		
										</div>
									</div>
		
		
									<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*"
										multiple>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													<?php echo e($langg->lang644); ?> *
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<a href="#" class="set-gallery" data-toggle="modal" data-target="#setgallery">
												<i class="icofont-plus"></i> <?php echo e($langg->lang645); ?>

											</a>
										</div>
									</div>
		
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													<?php echo e($langg->lang664); ?>*
												</h4>
												<p class="sub-heading">
													(<?php echo e($langg->lang665); ?> <?php echo e($sign->name); ?>)
												</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="price" step="0.1" type="number" class="input-field"
												placeholder="<?php echo e($langg->lang666); ?>" required="" min="0">
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading"><?php echo e($langg->lang667); ?>*</h4>
												<p class="sub-heading"><?php echo e($langg->lang668); ?></p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="previous_price" step="0.1" type="number" class="input-field"
												placeholder="<?php echo e($langg->lang666); ?>" min="0">
										</div>
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="featured-keyword-area">
												<div class="left-area">
													<h4 class="heading"><?php echo e($langg->lang686); ?></h4>
												</div>
		
												<div class="feature-tag-top-filds" id="feature-section">
													<div class="feature-area">
														<span class="remove feature-remove"><i class="fas fa-times"></i></span>
														<div class="row">
															<div class="col-lg-6">
																<input type="text" name="features[]" class="input-field"
																	placeholder="<?php echo e($langg->lang687); ?>">
															</div>
		
															<div class="col-lg-6">
																<div class="input-group colorpicker-component cp">
																	<input type="text" name="colors[]" value="#000000"
																		class="input-field cp" />
																	<span class="input-group-addon"><i></i></span>
																</div>
															</div>
														</div>
													</div>
												</div>
		
												<a href="javascript:;" id="feature-btn" class="add-fild-btn"><i
														class="icofont-plus"></i> <?php echo e($langg->lang688); ?></a>
											</div>
										</div>
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading"><?php echo e($langg->lang689); ?> *</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<ul id="tags" class="myTags">
											</ul>
										</div>
									</div>
									<input type="hidden" name="type" value="Physical">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>

<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo e($langg->lang619); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="top-area">
					<div class="row">
						<div class="col-sm-6 text-right">
							<div class="upload-img-btn">
								<label id="prod_gallery"><i class="icofont-upload-alt"></i><?php echo e($langg->lang620); ?></label>
							</div>
						</div>
						<div class="col-sm-6">
							<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i
									class="fas fa-check"></i> <?php echo e($langg->lang621); ?></a>
						</div>
						<div class="col-sm-12 text-center">( <small><?php echo e($langg->lang622); ?></small> )</div>
					</div>
				</div>
				<div class="gallery-images">
					<div class="selected-image">
						<div class="row">


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('assets/admin/js/jquery.Jcrop.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/jquery.SimpleCropper.js')); ?>"></script>

<script type="text/javascript">
	// Gallery Section Insert

	$(document).on('click', '.remove-img', function () {
		var id = $(this).find('input[type=hidden]').val();
		$('#galval' + id).remove();
		$(this).parent().parent().remove();
	});

	$(document).on('click', '#prod_gallery', function () {
		$('#uploadgallery').click();
		$('.selected-image .row').html('');
		$('#geniusform').find('.removegal').val(0);
	});


	$("#uploadgallery").change(function () {
		var total_file = document.getElementById("uploadgallery").files.length;
		for (var i = 0; i < total_file; i++) {
			$('.selected-image .row').append('<div class="col-sm-6">' +
				'<div class="img gallery-img">' +
				'<span class="remove-img"><i class="fas fa-times"></i>' +
				'<input type="hidden" value="' + i + '">' +
				'</span>' +
				'<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
				'<img src="' + URL.createObjectURL(event.target.files[i]) + '" alt="gallery image">' +
				'</a>' +
				'</div>' +
				'</div> '
			);
			$('#geniusform').append('<input type="hidden" name="galval[]" id="galval' + i +
				'" class="removegal" value="' + i + '">')
		}

	});

	// Gallery Section Insert Ends
</script>

<script type="text/javascript">
	$('.cropme').simpleCropper();
</script>


<script src="<?php echo e(asset('assets/admin/js/product.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>