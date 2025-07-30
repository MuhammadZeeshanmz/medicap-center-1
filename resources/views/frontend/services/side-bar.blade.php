<div class="col-lg-4 col-xl-3">
    <div class="filter-sidebar offcanvas-lg offcanvas-start" tabindex="-1" id="filterSidebar"
        aria-labelledby="filterSidebarLabel">
        <div class="offcanvas-header px-20">
            <h4 class="offcanvas-title">{{ __('Filter') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#filterSidebar"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-lg-0">
            <aside class="filter-widgets" data-aos="fade-up">

                <!-- Categories Filter -->
                <div class="filter-widget mb-30 p-20 border radius-md mb-c" style="margin-bottom: 25px;">
                    <h5 class="widget-title">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterCategories">
                            {{ __('Categories') }}
                        </button>
                    </h5>
                    <div id="filterCategories" class="collapse show">
                        <div class="accordion-body mt-20 scroll-y">
                            <ul class="filter-list">
                                <li class="filter-item">
                                    <a class="filter-link {{ request()->category ? '' : 'active' }}"
                                        href="javascript:void(0)">{{ __('All') }}
                                        <span class="filter-count">({{ $total_services }})</span>
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="filter-item">
                                        <a href="javascript:void(0)"
                                            class="filter-link {{ request()->category == $category->slug ? 'active' : '' }}"
                                            data-slug="{{ $category->slug }}">
                                            {{ $category->name }}
                                            <span class="filter-count">({{ $category->service_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Service Details Filter -->
                <div id="serviceDetailsFilter">
                    <div class="filter-widget mb-30 p-20 border radius-md">
                        <h5 class="widget-title">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filterDetails" aria-expanded="true">
                                {{ __('Service Details') }}
                            </button>
                        </h5>
                        <div id="filterDetails" class="collapse show">
                            <div class="accordion-body mt-20 scroll-y">
                                <div class="row gx-sm-2">
                                    <div class="col-12">
                                        <div class="form-group mb-20">
                                            <label class="form-label">{{ __('Service Title') }}</label>
                                            <input class="form-control" type="text"
                                                placeholder="{{ __('Enter Service Title') }}"
                                                value="{{ request('service_title') }}" id="search_service_title">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Location') }}</label>
                                            <input class="form-control" type="text"
                                                placeholder="{{ __('Enter location') }}"
                                                value="{{ request('location') }}" id="location">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Type Filter -->
                <div id="serviceTypeFilter">
                    <div class="filter-widget mb-30 p-20 border radius-md">
                        <h5 class="widget-title">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filterServiceType">
                                {{ __('Service Type') }}
                            </button>
                        </h5>
                        <div id="filterServiceType" class="collapse show">
                            <div class="accordion-body mt-20 scroll-y">
                                <ul class="filter-options">
                                    <li class="filter-option">
                                        <input class="form-radio" type="radio" name="service_type"
                                            id="service_type_all" value="all" checked>
                                        <label for="service_type_all">{{ __('All') }}</label>
                                    </li>
                                    <li class="filter-option">
                                        <input class="form-radio" type="radio" name="service_type" id="offline"
                                            value="offline">
                                        <label for="offline">{{ __('Offline') }}</label>
                                    </li>
                                    <li class="filter-option">
                                        <input class="form-radio" type="radio" name="service_type" id="online"
                                            value="online">
                                        <label for="online">{{ __('Online') }}</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="filter-widget mb-30 p-20 border radius-md">
                    <h5 class="widget-title">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterPrice">
                            {{ __('Pricing') }}
                        </button>
                    </h5>
                    <div id="filterPrice" class="collapse show">
                        <div class="accordion-body pt-20 scroll-y">
                            <div class="row gx-sm-3 d-none">
                                <div class="col-md-6">
                                    <div class="form-group mb-20">
                                        <label class="form-label">{{ __('Minimum') }}</label>
                                        <input class="form-control" type="number" id="min"
                                            value="{{ $min }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-20">
                                        <label class="form-label">{{ __('Maximum') }}</label>
                                        <input class="form-control" type="number" id="max"
                                            value="{{ $max }}">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="o_min" value="{{ $min }}">
                            <input type="hidden" id="o_max" value="{{ $max }}">
                            <input type="hidden" id="currency_symbol"
                                value="{{ $basicInfo->base_currency_symbol }}">
                            <div class="price-range">
                                <div class="range-slider" data-range-slider></div>
                                <div class="price-display">
                                    <span>{{ __('Price') }}: <span class="price-values"
                                            data-range-value></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ratings Filter -->
                <div id="ratingsFilter">
                    <div class="filter-widget mb-30 p-20 border radius-md">
                        <h5 class="widget-title">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filterRatings">
                                {{ __('Ratings') }}
                            </button>
                        </h5>
                        <div id="filterRatings" class="collapse show">
                            <div class="accordion-body mt-20 scroll-y">
                                <ul class="filter-options">
                                    <li class="filter-option">
                                        <input class="form-radio" type="radio" name="rating" id="ratingAll"
                                            value="" {{ empty(request()->input('rating')) ? 'checked' : '' }}>
                                        <label for="ratingAll">{{ __('Show All') }}</label>
                                    </li>
                                    <li class="filter-option">
                                        <input class="form-radio" type="radio" name="rating" id="rating5"
                                            value="5" {{ request()->input('rating') == 5 ? 'checked' : '' }}>
                                        <label for="rating5">{{ __('5 stars') }}</label>
                                    </li>
                                    <li class="filter-option">
                                        <input class="form-radio" type="radio" name="rating" id="rating4"
                                            value="4" {{ request()->input('rating') == 4 ? 'checked' : '' }}>
                                        <label for="rating4">{{ __('4 stars and higher') }}</label>
                                    </li>
                                    <li class="filter-option">
                                        <input class="form-radio" type="radio" name="rating" id="rating3"
                                            value="3" {{ request()->input('rating') == 3 ? 'checked' : '' }}>
                                        <label for="rating3">{{ __('3 stars and higher') }}</label>
                                    </li>
                                    <li class="filter-option">
                                        <input class="form-radio" type="radio" name="rating" id="rating2"
                                            value="2" {{ request()->input('rating') == 2 ? 'checked' : '' }}>
                                        <label for="rating2">{{ __('2 stars and higher') }}</label>
                                    </li>
                                    <li class="filter-option">
                                        <input class="form-radio" type="radio" name="rating" id="rating1"
                                            value="1" {{ request()->input('rating') == 1 ? 'checked' : '' }}>
                                        <label for="rating1">{{ __('1 star and higher') }}</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reset Button -->
                <div class="filter-actions pb-40">
                    <a href="{{ route('frontend.services') }}" class="btn btn-lg btn-primary btn-gradient w-100">
                        <i class="fal fa-sync-alt me-2"></i>{{ __('Reset All') }}
                    </a>
                </div>

                <!-- Advertisement -->
                @if (!empty(showAd(1)))
                    <div class="advertisement mt-4 text-center">
                        {!! showAd(1) !!}
                    </div>
                @endif
            </aside>
        </div>
    </div>
</div>
