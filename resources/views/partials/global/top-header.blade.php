<div class="top-header font-400 d-none d-lg-block py-1 text-general">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 sm-mx-none">
                <div class="d-flex align-items-center text-general">
                    <i class="flaticon-phone-call flat-mini me-2 text-general"></i>
                    <span class="text-dark"> {{ $ps->phone }}</span>
                </div>
            </div>
            <div class="col-lg-8 ">
                <ul class="top-links text-general ms-auto  d-flex justify-content-end">
                    <li class="my-account-dropdown">
                        <div class="language-selector nice-select">
                            <i class="fas fa-globe-americas text-dark"></i>
                            <select name="language" class="language selectors nice">
                                @foreach (DB::table('languages')->get() as $language)
                                    <option value="{{ route('front.language', $language->id) }}"
                                        {{ Session::has('language')? (Session::get('language') == $language->id? 'selected': ''): (DB::table('languages')->where('is_default', '=', 1)->first()->id == $language->id? 'selected': '') }}>
                                        {{ $language->language }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li class="my-account-dropdown">
                        <div class="currency-selector nice-select">
                            <span
                                class="text-dark">{{ Session::has('currency')? DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->sign: DB::table('currencies')->where('is_default', '=', 1)->first()->sign }}</span>
                            <select name="currency" class="currency selectors nice">
                                @foreach (DB::table('currencies')->get() as $currency)
                                    <option value="{{ route('front.currency', $currency->id) }}"
                                        {{ Session::has('currency')? (Session::get('currency') == $currency->id? 'selected': ''): (DB::table('currencies')->where('is_default', '=', 1)->first()->id == $currency->id? 'selected': '') }}>
                                        {{ $currency->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    @if ($gs->reg_vendor == 1)
                        <div class=" align-items-center text-general sell">
                            @if (Auth::check())
                                @if (Auth::guard('web')->user()->is_vendor == 2)
                                    <a href="{{ route('vendor.dashboard') }}" class="sell-btn "> {{ __('Sell') }}</a>
                                @else
                                    <a href="{{ route('user-package') }}" class="sell-btn "> {{ __('Sell') }}</a>
                                @endif
                        </div>
                    @else
                    @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Logo Header Area Start -->
<section class="logo-header">
    <div class="container">
        <div class="row ">
            <div class="col-lg-2 col-sm-6 col-5">
                <div class="logo">
                    <a href="{{ route('front.index') }}">
                        <img src="{{ asset('assets/images/' . $gs->logo) }}" alt="">
                    </a>
                </div>
            </div>
                <div class="col-lg-8 col-sm-12 remove-padding order-last order-sm-2 order-md-2">
                    <div class="search-box-wrapper">
                        <div class="search-box">

                            <form id="searchForm" class="search-form"
                                action="{{ route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')]) }}"
                                method="GET">
                                @if (!empty(request()->input('sort')))
                                    <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                                @endif
                                @if (!empty(request()->input('minprice')))
                                    <input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
                                @endif
                                @if (!empty(request()->input('maxprice')))
                                    <input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
                                @endif
                                <input type="text" id="prod_name" required name="search"
                                    placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}"
                                    autocomplete="off">
                                <div class="autocomplete">
                                    <div id="myInputautocomplete-list" class="autocomplete-items">
                                    </div>
                                </div>
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-7 order-lg-last">
                    <div class="helpful-links">
                        <ul class="helpful-links-inner">
                            <li class="wishlist" data-toggle="tooltip" data-placement="top"
                                title="{{ $langg->lang9 }}">
                                @if (Auth::guard('web')->check())
                                    <a href="{{ route('user-wishlists') }}" class="wish">
                                        <i class="far fa-heart"></i>
                                        <span id="wishlist-count">{{ Auth::user()->wishlistCount() }}</span>
                                    </a>
                                @else
                                    <a href="javascript:;" data-toggle="modal" id="wish-btn"
                                        data-target="#comment-log-reg" class="wish">
                                        <i class="far fa-heart"></i>
                                        <span id="wishlist-count">0</span>
                                    </a>
                                @endif
                            </li>
                            <li class="compare" data-toggle="tooltip" data-placement="top"
                                title="{{ $langg->lang10 }}">
                                <a href="{{ route('product.compare') }}" class="wish compare-product">
                                    <div class="icon">
                                        <i class="fas fa-exchange-alt"></i>
                                        <span
                                            id="compare-count">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Logo Header Area End -->
