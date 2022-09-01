<li>
        <a href="#order" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i><?php echo e(__('Orders')); ?></a>
        <ul class="collapse list-unstyled" id="order" data-parent="#accordion" >
               <li>
                <a href="<?php echo e(route('admin-order-index')); ?>"> <?php echo e(__('All Orders')); ?></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-order-pending')); ?>"> <?php echo e(__('Pending Orders')); ?></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-order-processing')); ?>"> <?php echo e(__('Processing Orders')); ?></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-order-completed')); ?>"> <?php echo e(__('Completed Orders')); ?></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-order-declined')); ?>"> <?php echo e(__('Declined Orders')); ?></a>
            </li>

        </ul>
    </li>
    <li>
        <a href="#menu2" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-cart"></i><?php echo e(__('Products')); ?>

        </a>
        <ul class="collapse list-unstyled" id="menu2" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-prod-types')); ?>"><span><?php echo e(__('Add New Product')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-prod-index')); ?>"><span><?php echo e(__('All Products')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-prod-deactive')); ?>"><span><?php echo e(__('Deactivated Product')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-prod-catalog-index')); ?>"><span><?php echo e(__('Product Catalogs')); ?></span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#affiliateprod" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-cart"></i><?php echo e(__('Affiliate Products')); ?>

        </a>
        <ul class="collapse list-unstyled" id="affiliateprod" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-import-create')); ?>"><span><?php echo e(__('Add Affiliate Product')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-import-index')); ?>"><span><?php echo e(__('All Affiliate Products')); ?></span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#menu3" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-user"></i><?php echo e(__('Customers')); ?>

        </a>
        <ul class="collapse list-unstyled" id="menu3" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-user-index')); ?>"><span><?php echo e(__('Customers List')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-withdraw-index')); ?>"><span><?php echo e(__('Withdraws')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-user-image')); ?>"><span><?php echo e(__('Customer Default Image')); ?></span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#vendor" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-ui-user-group"></i><?php echo e(__('Vendors')); ?>

        </a>
        <ul class="collapse list-unstyled" id="vendor" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-vendor-index')); ?>"><span><?php echo e(__('Vendors List')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-vendor-withdraw-index')); ?>"><span><?php echo e(__('Withdraws')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-vendor-subs')); ?>"><span><?php echo e(__('Vendor Subscriptions')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-vendor-color')); ?>"><span><?php echo e(__('Default Background')); ?></span></a>
            </li>

        </ul>
    </li>

    <li>
        <a href="#vendor1" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                <i class="icofont-verification-check"></i><?php echo e(__('Vendor Verifications')); ?>

        </a>
        <ul class="collapse list-unstyled" id="vendor1" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-vr-index')); ?>"><span><?php echo e(__('All Verifications')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-vr-pending')); ?>"><span><?php echo e(__('Pending Verifications')); ?></span></a>
            </li>
        </ul>
    </li>


    <li>
        <a href="<?php echo e(route('admin-subscription-index')); ?>" class=" wave-effect"><i class="fas fa-dollar-sign"></i><?php echo e(__('Vendor Subscription Plans')); ?></a>
    </li>

    <li>
        <a href="#menu5" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-sitemap"></i><?php echo e(__('Manage Categories')); ?></a>
        <ul class="collapse list-unstyled
        <?php if(request()->is('admin/attribute/*/manage') && request()->input('type')=='category'): ?>
          show
        <?php elseif(request()->is('admin/attribute/*/manage') && request()->input('type')=='subcategory'): ?>
          show
        <?php elseif(request()->is('admin/attribute/*/manage') && request()->input('type')=='childcategory'): ?>
          show
        <?php endif; ?>" id="menu5" data-parent="#accordion" >
                <li class="<?php if(request()->is('admin/attribute/*/manage') && request()->input('type')=='category'): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin-cat-index')); ?>"><span><?php echo e(__('Main Category')); ?></span></a>
                </li>
                <li class="<?php if(request()->is('admin/attribute/*/manage') && request()->input('type')=='subcategory'): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin-subcat-index')); ?>"><span><?php echo e(__('Sub Category')); ?></span></a>
                </li>
                <li class="<?php if(request()->is('admin/attribute/*/manage') && request()->input('type')=='childcategory'): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin-childcat-index')); ?>"><span><?php echo e(__('Child Category')); ?></span></a>
                </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo e(route('admin-prod-import')); ?>"><i class="fas fa-upload"></i><?php echo e(__('Bulk Product Upload')); ?></a>
    </li>

    <li>
        <a href="#menu4" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-speech-comments"></i><?php echo e(__('Product Discussion')); ?>

        </a>
        <ul class="collapse list-unstyled" id="menu4" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-rating-index')); ?>"><span><?php echo e(__('Product Reviews')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-comment-index')); ?>"><span><?php echo e(__('Comments')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-report-index')); ?>"><span><?php echo e(__('Reports')); ?></span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo e(route('admin-coupon-index')); ?>" class=" wave-effect"><i class="fas fa-percentage"></i><?php echo e(__('Set Coupons')); ?></a>
    </li>
    <li>
        <a href="#blog" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-fw fa-newspaper"></i><?php echo e(__('Blog')); ?>

        </a>
        <ul class="collapse list-unstyled" id="blog" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-cblog-index')); ?>"><span><?php echo e(__('Categories')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-blog-index')); ?>"><span><?php echo e(__('Posts')); ?></span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#msg" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-fw fa-newspaper"></i><?php echo e(__('Messages')); ?>

        </a>
        <ul class="collapse list-unstyled" id="msg" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-message-index')); ?>"><span><?php echo e(__('Tickets')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-message-dispute')); ?>"><span><?php echo e(__('Disputes')); ?></span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#general" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-cogs"></i><?php echo e(__('General Settings')); ?>

        </a>
        <ul class="collapse list-unstyled" id="general" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-gs-logo')); ?>"><span><?php echo e(__('Logo')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-gs-fav')); ?>"><span><?php echo e(__('Favicon')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-gs-load')); ?>"><span><?php echo e(__('Loader')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-shipping-index')); ?>"><span><?php echo e(__('Shipping Methods')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-package-index')); ?>"><span><?php echo e(__('Packagings')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-pick-index')); ?>"><span><?php echo e(__('Pickup Locations')); ?></span></a>
            </li>
            <li>
            <a href="<?php echo e(route('admin-gs-contents')); ?>"><span><?php echo e(__('Website Contents')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-gs-footer')); ?>"><span><?php echo e(__('Footer')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-gs-affilate')); ?>"><span><?php echo e(__('Affiliate Information')); ?></span></a>
            </li>

            <li>
                <a href="<?php echo e(route('admin-gs-popup')); ?>"><span><?php echo e(__('Popup Banner')); ?></span></a>
            </li>


            <li>
                <a href="<?php echo e(route('admin-gs-error-banner')); ?>"><span><?php echo e(__('Error Banner')); ?></span></a>
            </li>


            <li>
                <a href="<?php echo e(route('admin-gs-maintenance')); ?>"><span><?php echo e(__('Website Maintenance')); ?></span></a>
            </li>

        </ul>
    </li>

    <li>
        <a href="#homepage" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-edit"></i><?php echo e(__('Home Page Settings')); ?>

        </a>
        <ul class="collapse list-unstyled" id="homepage" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-sl-index')); ?>"><span><?php echo e(__('Sliders')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-service-index')); ?>"><span><?php echo e(__('Services')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-ps-best-seller')); ?>"><span><?php echo e(__('Right Side Banner1')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-ps-big-save')); ?>"><span><?php echo e(__('Right Side Banner2')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-sb-index')); ?>"><span><?php echo e(__('Top Small Banners')); ?></span></a>
            </li>

            <li>
                <a href="<?php echo e(route('admin-sb-large')); ?>"><span><?php echo e(__('Large Banners')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-sb-bottom')); ?>"><span><?php echo e(__('Bottom Small Banners')); ?></span></a>
            </li>

            <li>
                <a href="<?php echo e(route('admin-review-index')); ?>"><span><?php echo e(__('Reviews')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-partner-index')); ?>"><span><?php echo e(__('Partners')); ?></span></a>
            </li>


            <li>
                <a href="<?php echo e(route('admin-ps-customize')); ?>"><span><?php echo e(__('Home Page Customization')); ?></span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#menu" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-file-code"></i><?php echo e(__('Menu Page Settings')); ?>

        </a>
        <ul class="collapse list-unstyled" id="menu" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-faq-index')); ?>"><span><?php echo e(__('FAQ Page')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-ps-contact')); ?>"><span><?php echo e(__('Contact Us Page')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-page-index')); ?>"><span><?php echo e(__('Other Pages')); ?></span></a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#emails" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-at"></i><?php echo e(__('Email Settings')); ?>

        </a>
        <ul class="collapse list-unstyled" id="emails" data-parent="#accordion">
            <li><a href="<?php echo e(route('admin-mail-index')); ?>"><span><?php echo e(__('Email Template')); ?></span></a></li>
            <li><a href="<?php echo e(route('admin-mail-config')); ?>"><span><?php echo e(__('Email Configurations')); ?></span></a></li>
            <li><a href="<?php echo e(route('admin-group-show')); ?>"><span><?php echo e(__('Group Email')); ?></span></a></li>
        </ul>
    </li>
    <li>
        <a href="#payments" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-file-code"></i><?php echo e(__('Payment Settings')); ?>

        </a>
        <ul class="collapse list-unstyled" id="payments" data-parent="#accordion">
            <li><a href="<?php echo e(route('admin-gs-payments')); ?>"><span><?php echo e(__('Payment Information')); ?></span></a></li>
            <li><a href="<?php echo e(route('admin-payment-index')); ?>"><span><?php echo e(__('Payment Gateways')); ?></span></a></li>
            <li><a href="<?php echo e(route('admin-currency-index')); ?>"><span><?php echo e(__('Currencies')); ?></span></a></li>
        </ul>
    </li>
    <li>
        <a href="#socials" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-paper-plane"></i><?php echo e(__('Social Settings')); ?>

        </a>
        <ul class="collapse list-unstyled" id="socials" data-parent="#accordion">
                <li><a href="<?php echo e(route('admin-social-index')); ?>"><span><?php echo e(__('Social Links')); ?></span></a></li>
                <li><a href="<?php echo e(route('admin-social-facebook')); ?>"><span><?php echo e(__('Facebook Login')); ?></span></a></li>
                <li><a href="<?php echo e(route('admin-social-google')); ?>"><span><?php echo e(__('Google Login')); ?></span></a></li>
        </ul>
    </li>
    <li>
        <a href="#langs" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-language"></i><?php echo e(__('Language Settings')); ?>

        </a>
        <ul class="collapse list-unstyled" id="langs" data-parent="#accordion">
                <li><a href="<?php echo e(route('admin-lang-index')); ?>"><span><?php echo e(__('Website Language')); ?></span></a></li>
                <li><a href="<?php echo e(route('admin-tlang-index')); ?>"><span><?php echo e(__('Admin Panel Language')); ?></span></a></li>

        </ul>
    </li>
    <li>
        <a href="#seoTools" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-wrench"></i><?php echo e(__('SEO Tools')); ?>

        </a>
        <ul class="collapse list-unstyled" id="seoTools" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('admin-prod-popular',30)); ?>"><span><?php echo e(__('Popular Products')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-seotool-analytics')); ?>"><span><?php echo e(__('Google Analytics')); ?></span></a>
            </li
            >
            <li>
                <a href="<?php echo e(route('admin-seotool-keywords')); ?>"><span><?php echo e(__('Website Meta Keywords')); ?></span></a>
            </li>
        </ul>
    </li>
    <li>
        <a href="<?php echo e(route('admin-staff-index')); ?>" class=" wave-effect"><i class="fas fa-user-secret"></i><?php echo e(__('Manage Staffs')); ?></a>
    </li>

    <li>
        <a href="<?php echo e(route('admin-subs-index')); ?>" class=" wave-effect"><i class="fas fa-users-cog mr-2"></i><?php echo e(__('Subscribers')); ?></a>
    </li>

        <li>
            <a href="<?php echo e(route('admin-role-index')); ?>" class=" wave-effect"><i class="fas fa-user-tag"></i><?php echo e(__('Manage Roles')); ?></a>
        </li>
        <li>
            <a href="<?php echo e(route('admin-cache-clear')); ?>" class=" wave-effect"><i class="fas fa-sync"></i><?php echo e(__('Clear Cache')); ?></a>
        </li>
        <li>
            <a href="#sactive" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-cog"></i><?php echo e(__('Backup')); ?>

            </a>
            <ul class="collapse list-unstyled" id="sactive" data-parent="#accordion">
                <li><a href="<?php echo e(route('admin-generate-backup')); ?>"> <?php echo e(__('Generate Backup')); ?></a></li>
            </ul>
        </li>