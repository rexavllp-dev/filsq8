<!doctype html>
<html lang="en" dir="ltr">

<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="author" content="ShowpekOcean">
      	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<!-- Title -->
		<title><?php echo e($gs->title); ?></title>
		<!-- favicon -->
		<link rel="icon"  type="image/x-icon" href="<?php echo e(asset('assets/images/'.$gs->favicon)); ?>"/>
		<!-- Bootstrap -->
		<link href="<?php echo e(asset('assets/vendor/css/bootstrap.min.css')); ?>" rel="stylesheet" />
		<!-- Fontawesome -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/fontawesome.css')); ?>">
		<!-- icofont -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/icofont.min.css')); ?>">
		<!-- Sidemenu Css -->
		<link href="<?php echo e(asset('assets/admin/plugins/fullside-menu/css/dark-side-style.css')); ?>" rel="stylesheet" />
		<link href="<?php echo e(asset('assets/vendor/plugins/fullside-menu/waves.min.css')); ?>" rel="stylesheet" />

		<link href="<?php echo e(asset('assets/vendor/css/plugin.css')); ?>" rel="stylesheet" />

		<link href="<?php echo e(asset('assets/vendor/css/jquery.tagit.css')); ?>" rel="stylesheet" />
    	<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/bootstrap-coloroicker.css')); ?>">
		<!-- Main Css -->

	<?php if($langg->rtl == "1"): ?>

	<link href="<?php echo e(asset('assets/admin/css/rtl/style.css')); ?>" rel="stylesheet"/>
	<link href="<?php echo e(asset('assets/admin/css/rtl/custom.css')); ?>" rel="stylesheet"/>
	<link href="<?php echo e(asset('assets/admin/css/rtl/responsive.css')); ?>" rel="stylesheet" />
	<link href="<?php echo e(asset('assets/admin/css/common.css')); ?>" rel="stylesheet" />

	<?php else: ?>

	<link href="<?php echo e(asset('assets/admin/css/style.css')); ?>" rel="stylesheet"/>
	<link href="<?php echo e(asset('assets/admin/css/custom.css')); ?>" rel="stylesheet"/>
	<link href="<?php echo e(asset('assets/admin/css/responsive.css')); ?>" rel="stylesheet" />
	<link href="<?php echo e(asset('assets/admin/css/common.css')); ?>" rel="stylesheet" />

	<?php endif; ?>

		<?php echo $__env->yieldContent('styles'); ?>

	</head>
	<body>
		<div class="page">
			<div class="page-main">
				<!-- Header Menu Area Start -->
				<div class="header">
					<div class="container-fluid">
						<div class="d-flex justify-content-between">
						<a class="admin-logo" href="<?php echo e(route('front.index')); ?>" target="_blank">
								<img src="<?php echo e(asset('assets/images/'.$gs->logo)); ?>" alt="">
							</a>
							<div class="menu-toggle-button">
								<a class="nav-link" href="javascript:;" id="sidebarCollapse">
									<div class="my-toggl-icon">
											<span class="bar1"></span>
											<span class="bar2"></span>
											<span class="bar3"></span>
									</div>
								</a>
							</div>

							<div class="right-eliment">
								<ul class="list">

									<li class="bell-area">
										<a id="notf_order" class="dropdown-toggle-1" href="javascript:;">
											<i class="icofont-cart"></i>
											<span data-href="<?php echo e(route('vendor-order-notf-count',Auth::guard('web')->user()->id)); ?>" id="order-notf-count"><?php echo e(App\Models\UserNotification::countOrder(Auth::guard('web')->user()->id)); ?></span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="<?php echo e(route('vendor-order-notf-show',Auth::guard('web')->user()->id)); ?>" id="order-notf-show">
										</div>
										</div>
									</li>

									<li class="login-profile-area">
										<a class="dropdown-toggle-1" href="javascript:;">
											<div class="user-img">
              <?php if(Auth::user()->is_provider == 1): ?>
              <img src="<?php echo e(Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/noimage.png')); ?>" alt="">
              <?php else: ?>
              <img src="<?php echo e(Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo ):asset('assets/images/noimage.png')); ?>" alt="">
              <?php endif; ?>
											</div>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper">
													<ul>
														<h5><?php echo e($langg->lang431); ?></h5>

															<li>
																<a target="_blank" href="<?php echo e(route('front.vendor',str_replace(' ', '-', Auth::user()->shop_name))); ?>"><i class="fas fa-eye"></i> <?php echo e($langg->lang432); ?></a>
															</li>

															<li>
																<a href="<?php echo e(route('user-dashboard')); ?>"><i class="fas fa-sign-in-alt"></i> <?php echo e($langg->lang433); ?></a>
															</li>

															<li>
																<a href="<?php echo e(route('vendor-profile')); ?>"><i class="fas fa-user"></i> <?php echo e($langg->lang434); ?></a>
															</li>
															<li>
																<a href="<?php echo e(route('user-logout')); ?>"><i class="fas fa-power-off"></i> <?php echo e($langg->lang435); ?></a>
															</li>

														</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Header Menu Area End -->
				<div class="wrapper">
					<!-- Side Menu Area Start -->
					<nav id="sidebar" class="nav-sidebar">
						<ul class="list-unstyled components" id="accordion">

							<li>
								<a target="_blank" href="<?php echo e(route('front.vendor',str_replace(' ', '-', Auth::user()->shop_name))); ?>" class="wave-effect"><i class="fas fa-eye mr-2"></i> <?php echo e($langg->lang440); ?></a>
							</li>

							<li>
								<a href="<?php echo e(route('vendor-dashboard')); ?>" class="wave-effect "><i class="fa fa-home mr-2"></i><?php echo e($langg->lang441); ?></a>
							</li>
							<li>
								<a href="#order" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i><?php echo e($langg->lang442); ?></a>
								<ul class="collapse list-unstyled" id="order" data-parent="#accordion" >
                                   	<li>
                                    	<a href="<?php echo e(route('vendor-order-index')); ?>"> <?php echo e($langg->lang443); ?></a>
                                	</li>
								</ul>
							</li>

							<li>
								<a href="#menu2" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="icofont-cart"></i><?php echo e($langg->lang444); ?>

								</a>
								<ul class="collapse list-unstyled" id="menu2" data-parent="#accordion">
									<li>
										<a href="<?php echo e(route('vendor-prod-types')); ?>"><span><?php echo e($langg->lang445); ?></span></a>
									</li>
									<li>
										<a href="<?php echo e(route('vendor-prod-index')); ?>"><span><?php echo e($langg->lang446); ?></span></a>
									</li>
									<li>
										<a href="<?php echo e(route('admin-vendor-catalog-index')); ?>"><span><?php echo e($langg->lang785); ?></span></a>
									</li>
								</ul>
							</li>

							<li>
								<a href="#affiliateprod" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="icofont-cart"></i><?php echo e($langg->lang447); ?>

								</a>
								<ul class="collapse list-unstyled" id="affiliateprod" data-parent="#accordion">
									<li>
										<a href="<?php echo e(route('vendor-import-create')); ?>"><span><?php echo e($langg->lang448); ?></span></a>
									</li>
									<li>
										<a href="<?php echo e(route('vendor-import-index')); ?>"><span><?php echo e($langg->lang449); ?></span></a>
									</li>
								</ul>
							</li>


							<li>
								<a href="<?php echo e(route('vendor-prod-import')); ?>"><i class="fas fa-upload"></i><?php echo e($langg->lang450); ?></a>
							</li>
							<li>
								<a href="<?php echo e(route('vendor-wt-index')); ?>" class=" wave-effect"><i class="fas fa-list"></i><?php echo e($langg->lang451); ?></a>
							</li>

							<li>
								<a href="#general" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="fas fa-cogs"></i><?php echo e($langg->lang452); ?>

								</a>
								<ul class="collapse list-unstyled" id="general" data-parent="#accordion">
                                    <li>
                                    	<a href="<?php echo e(route('vendor-service-index')); ?>"><span><?php echo e($langg->lang453); ?></span></a>
                                    </li>
                                   <!-- <li>
                                    	<a href="<?php echo e(route('vendor-banner')); ?>"><span><?php echo e($langg->lang454); ?></span></a>
                                    </li>-->
                                     <li>
                                    	<a href="<?php echo e(route('vendor-banner-purchase')); ?>"><span>Banner</span></a>
                                    </li>
                                    <?php if($gs->vendor_ship_info == 1): ?>
	                                    <li>
	                                    	<a href="<?php echo e(route('vendor-shipping-index')); ?>"><span><?php echo e($langg->lang719); ?></span></a>
	                                    </li>
	                                <?php endif; ?>
	                                <?php if($gs->multiple_packaging == 1): ?>
	                                    <li>
	                                    	<a href="<?php echo e(route('vendor-package-index')); ?>"><span><?php echo e($langg->lang721); ?></span></a>
	                                    </li>
	                                <?php endif; ?>
                                    <li>
                                    	<a href="<?php echo e(route('vendor-social-index')); ?>"><span><?php echo e($langg->lang456); ?></span></a>
                                    </li>
								</ul>
							</li>

						</ul>
					</nav>
					<!-- Main Content Area Start -->
					<?php echo $__env->yieldContent('content'); ?>
					<!-- Main Content Area End -->
					</div>
				</div>
			</div>

		<?php
		  $curr = \App\Models\Currency::where('is_default','=',1)->first();
		?>

		<script type="text/javascript">

		  var mainurl = "<?php echo e(url('/')); ?>";
		  var admin_loader = <?php echo e($gs->is_admin_loader); ?>;
		  var whole_sell = <?php echo e($gs->wholesell); ?>;
		  var langg    = <?php echo json_encode($langg); ?>;
			var getattrUrl = '<?php echo e(route('vendor-prod-getattributes')); ?>';
			var curr = <?php echo json_encode($curr); ?>;

		</script>

		<!-- Dashboard Core -->
		<script src="<?php echo e(asset('assets/vendor/js/vendors/jquery-1.12.4.min.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/vendor/js/vendors/bootstrap.min.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/vendor/js/jqueryui.min.js')); ?>"></script>
		<!-- Fullside-menu Js-->
		<script src="<?php echo e(asset('assets/vendor/plugins/fullside-menu/jquery.slimscroll.min.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/vendor/plugins/fullside-menu/waves.min.js')); ?>"></script>

		<script src="<?php echo e(asset('assets/vendor/js/plugin.js')); ?>"></script>

		<script src="<?php echo e(asset('assets/vendor/js/Chart.min.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/vendor/js/tag-it.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/vendor/js/nicEdit.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendor/js/bootstrap-colorpicker.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendor/js/notify.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/vendor/js/load.js')); ?>"></script>
		<!-- Custom Js-->
		<script src="<?php echo e(asset('assets/vendor/js/custom.js')); ?>"></script>
		<!-- AJAX Js-->
		<script src="<?php echo e(asset('assets/vendor/js/myscript.js')); ?>"></script>
		<?php echo $__env->yieldContent('scripts'); ?>

<?php if($gs->is_admin_loader == 0): ?>
<style>
	div#geniustable_processing {
		display: none !important;
	}
</style>
<?php endif; ?>

	</body>

</html>
