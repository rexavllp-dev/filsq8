<div class="main-nav d-lg-block mainmenu-area header-sticky">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center mainmenu-area-innner">
                <div class="col-lg-3 col-md-6 categorimenu-wrapper remove-padding">
                    <!--categorie menu start-->
        			@if(url()->current() != url('user/dashboard') && url()->current() != url('user/profile')  && url()->current() != url('user/affilate/code')  && url()->current() != url('user/affilate/withdraw')  && url()->current() != url('user/order/tracking')  && url()->current() != url('user/favorite/seller')  && url()->current() != url('user/messages')  && url()->current() != url('user/admin/tickets')  && url()->current() != url('user/profile') && url()->current() != url('user/admin/disputes') && url()->current() != url('user/reset') && url()->current() != url('user/orders') && url()->current() != url('user/package') && url()->current() != url('carts') && url()->current() != url('checkout') && url()->current() != url('faq') && url()->current() != url('contact') && url()->current() != url('user/subscription/6') && url()->current() != url('user/subscription/7') && url()->current() != url('user/subscription/8') && url()->current() != url('user/subscription/5') && url()->current() != url('user/subscription/9')&& url()->current() != url('user/subscription/10')&& url()->current() != url('user/subscription/11')&& url()->current() != url('user/subscription/12'))
                       <div class="categories_menu">
                            <div class="categories_title">
                                <h2 class="categori_toggle"><i class="fa fa-list"></i>  All Categories </h2>
                            </div>
                            <div class="categories_menu_inner">
                                <ul class="d-none d-lg-block">
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach(App\Models\Category::where('language_id',$langg->id)->where('status',1)->get() as $category)

                                    <li class="{{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 15 ? 'rx-child' : '' }}">
                                    @if(count($category->subs) > 0)
                                        <div class="img">
                                            <img src="{{ asset('assets/images/categories/'.$category->photo) }}" alt="">
                                        </div>
                                        <div class="link-area">
                                            <span><a href="{{ route('front.category',$category->slug) }}">{{ $category->name }}</a></span>
                                            @if(count($category->subs) > 0)
                                            <a href="javascript:;">
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </div>

                                    @else
                                        <a href="{{ route('front.category',$category->slug) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}"> {{ $category->name }}</a>

                                    @endif
                                        @if(count($category->subs) > 0)

                                        @php
                                        $ck = 0;
                                        foreach($category->subs as $subcat) {
                                            if(count($subcat->childs) > 0) {
                                                $ck = 1;
                                                break;
                                            }
                                        }
                                        @endphp
                                        <ul class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">
                                            @foreach($category->subs as $subcat)
                                                <li>
                                                    <a href="{{ route('front.category',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">{{$subcat->name}}</a>
                                                    @if(count($subcat->childs) > 0)
                                                        <div class="categorie_sub_menu">
                                                            <ul>
                                                                @foreach($subcat->childs as $childcat)
                                                                <li><a href="{{ route('front.category',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}">{{$childcat->name}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>

                                        @endif

                                        </li>

                                        @php
                                        $i++;
                                        @endphp

                                        @if($i == 15)
                                            <li>
                                            <a href="{{ route('front.categories') }}"><i class="fas fa-plus"></i>  See All Categories </a>
                                            </li>
                                            @break
                                        @endif


                                        @endforeach

                                </ul>
                                <div class="mobile-category d-lg-none">
                                <div id="woocommerce_product_categories-4" class="widget woocommerce widget_product_categories widget-toggle">
            <!-- <h2 class="widget-title">{{ __('Product categories') }}</h2> -->
            <ul class="product-categories">
                @foreach (App\Models\Category::where('language_id',$langg->id)->where('status',1)->get() as $category)

                <li class="cat-item cat-parent">
                    <a href="{{route('front.category', $category->slug)}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link" id="cat">{{ $category->name }} <span class="count"></span></a>

                    @if($category->subs->count() > 0)
                        <span class="has-child"></span>
                        <ul class="children">
                            @foreach (App\Models\Subcategory::where('category_id',$category->id)->get() as $subcategory)
                            <li class="cat-item cat-parent">
                                <a href="{{route('front.category', [$category->slug, $subcategory->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link {{ isset($subcat) ? ($subcat->id == $subcategory->id ? 'active' : '') : '' }}">{{$subcategory->name}} <span class="count"></span></a>


                                @if($subcategory->childs->count()!=0)
                                    <span class="has-child"></span>
                                    <ul class="children">
                                        @foreach (DB::table('childcategories')->where('subcategory_id',$subcategory->id)->get() as $key => $childelement)
                                        <li class="cat-item ">
                                            <a href="{{route('front.category', [$category->slug, $subcategory->slug, $childelement->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link {{ isset($childcat) ? ($childcat->id == $childelement->id ? 'active' : '') : '' }}"> {{$childelement->name}} <span class="count"></span></a>
                                        </li>
                                        @endforeach
                                    </ul>

                                @endif
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--categorie menu end-->
                </div>
                <div class="col-lg-9 col-md-6 mainmenu-wrapper remove-padding">
                  
                <nav class="menus" >
						<div class="nav-header right" hidden>
							<button class="toggle-bar"><span class="fa fa-bars"></span></button>
						</div>
						<ul class="menu core-nav-list right d-md-none">
							@if($gs->is_home == 1)
							<li><a href="{{ route('front.index') }}">Home</a></li>
							@endif
							<li><a href="{{ route('front.blog') }}">Blog</a></li>
							@if($gs->is_faq == 1)
							<li><a href="{{ route('front.faq') }}">Faqs</a></li>
							@endif
                            
                                    @foreach(DB::table('pages')->where('language_id',1)->where('header','=',1)->get() as $data)
                                    <li><a href="{{ route('front.vendor',$data->slug) }}">{{ $data->title }}</a></li>
                                    @endforeach
                            
							@if($gs->is_contact == 1)
							<li><a href="{{ route('front.contact') }}">Contact us</a></li>
							@endif
							
						</ul>

					</nav>
                </div>
        </div>
    </div>
</div>
