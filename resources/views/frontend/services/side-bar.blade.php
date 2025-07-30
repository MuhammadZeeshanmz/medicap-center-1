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
<div class="filter-widget mb-4 p-3 border rounded">
    <h5 class="widget-title mb-3 d-flex justify-content-between align-items-center">
        <button class="accordion-button px-0 py-0 shadow-none bg-transparent d-flex align-items-center w-100" type="button" data-bs-toggle="collapse" data-bs-target="#filterCategories">
            <span class="fw-bold text-dark">Categories</span>
            <i class="fas fa-chevron-down ms-auto"></i>
        </button>
    </h5>

    <div id="filterCategories" class="collapse show">
        <div class="accordion-body p-0">
            <ul class="list-unstyled mb-0">
                <li class="form-check mb-2 d-flex justify-content-between align-items-center">
                    <label class="form-check-label d-flex align-items-center" for="catAll">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="category" id="catAll" value="" {{ request()->category ? '' : 'checked' }}>
                        <span class="text-dark">All</span>
                    </label>
                    <span class="text-muted">({{ $total_services }})</span>
                </li>
                @foreach ($categories as $category)
                <li class="form-check mb-2 d-flex justify-content-between align-items-center">
                    <label class="form-check-label d-flex align-items-center" for="cat{{ $category->id }}">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="category" id="cat{{ $category->id }}" value="{{ $category->slug }}" {{ request()->category == $category->slug ? 'checked' : '' }}>
                        <span class="text-dark">{{ $category->name }}</span>
                    </label>
                    <span class="text-muted">({{ $category->service_count }})</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>


                <!-- Service Details Filter -->
              
<div id="serviceDetailsFilter">
    <div class="filter-widget mb-4 p-3 border rounded">
        <h5 class="widget-title mb-3 d-flex justify-content-between align-items-center">
            <button class="accordion-button px-0 py-0 shadow-none bg-transparent d-flex align-items-center w-100" type="button" data-bs-toggle="collapse" data-bs-target="#filterDetails" aria-expanded="true">
                <span class="fw-bold text-dark">Service Details</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </button>
        </h5>

        <div id="filterDetails" class="collapse show">
            <div class="accordion-body p-0">
                <div class="mb-3">
                    <label class="form-label mb-1">{{ __('Service Title') }}</label>
                    <input class="form-control" type="text" placeholder="{{ __('Enter Service Title') }}" value="{{ request('service_title') }}" id="search_service_title">
                </div>
                <div>
                    <label class="form-label mb-1">{{ __('Location') }}</label>
                    <input class="form-control" type="text" placeholder="{{ __('Enter location') }}" value="{{ request('location') }}" id="location">
                </div>
            </div>
        </div>
    </div>
</div>


               <!-- Service Type Filter -->
<div id="serviceTypeFilter">
    <div class="filter-widget mb-4 p-3 border rounded">
        <h5 class="widget-title mb-3 d-flex justify-content-between align-items-center">
            <button class="accordion-button px-0 py-0 shadow-none bg-transparent d-flex align-items-center w-100" type="button" data-bs-toggle="collapse" data-bs-target="#filterServiceType">
                <span class="fw-bold text-dark">Service Type</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </button>
        </h5>

        <div id="filterServiceType" class="collapse show">
            <div class="accordion-body p-0">
                <ul class="list-unstyled mb-0">
                    <li class="form-check mb-2">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="service_type" id="service_type_all" value="all" checked>
                        <label class="form-check-label" for="service_type_all">All</label>
                    </li>
                    <li class="form-check mb-2">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="service_type" id="offline" value="offline">
                        <label class="form-check-label" for="offline">Offline</label>
                    </li>
                    <li class="form-check">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="service_type" id="online" value="online">
                        <label class="form-check-label" for="online">Online</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


              <!-- Price Range Filter -->
<div class="filter-widget mb-4 p-3 border rounded">
    <h5 class="widget-title mb-3 d-flex justify-content-between align-items-center">
        <button class="accordion-button px-0 py-0 shadow-none bg-transparent d-flex align-items-center w-100" type="button" data-bs-toggle="collapse" data-bs-target="#filterPrice">
            <span class="fw-bold text-dark">Pricing</span>
            <i class="fas fa-chevron-down ms-auto"></i>
        </button>
    </h5>

    <div id="filterPrice" class="collapse show">
        <div class="accordion-body p-0">
            <!-- Hidden min/max inputs -->
            <input type="hidden" id="o_min" value="{{ $min }}">
            <input type="hidden" id="o_max" value="{{ $max }}">
            <input type="hidden" id="currency_symbol" value="{{ $basicInfo->base_currency_symbol }}">

            <!-- Range Slider -->
            <div class="price-range">
                <div class="range-slider mb-2" data-range-slider></div>
                <div class="price-display">
                    <span class="text-muted small">
                        {{ __('Price') }}:
                        <span class="price-values fw-semibold" data-range-value></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


              <!-- Ratings Filter -->
<div id="ratingsFilter">
    <div class="filter-widget mb-4 p-3 border rounded">
        <h5 class="widget-title mb-3 d-flex justify-content-between align-items-center">
            <button class="accordion-button px-0 py-0 shadow-none bg-transparent d-flex align-items-center w-100"
                type="button" data-bs-toggle="collapse" data-bs-target="#filterRatings">
                <span class="fw-bold text-dark">Ratings</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </button>
        </h5>

        <div id="filterRatings" class="collapse show">
            <div class="accordion-body p-0">
                <ul class="list-unstyled mb-0">
                    <li class="form-check mb-2">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="rating" id="ratingAll"
                            value="" {{ empty(request()->input('rating')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="ratingAll">Show All</label>
                    </li>
                    <li class="form-check mb-2">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="rating" id="rating5"
                            value="5" {{ request()->input('rating') == 5 ? 'checked' : '' }}>
                        <label class="form-check-label" for="rating5">5 stars</label>
                    </li>
                    <li class="form-check mb-2">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="rating" id="rating4"
                            value="4" {{ request()->input('rating') == 4 ? 'checked' : '' }}>
                        <label class="form-check-label" for="rating4">4 stars and higher</label>
                    </li>
                    <li class="form-check mb-2">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="rating" id="rating3"
                            value="3" {{ request()->input('rating') == 3 ? 'checked' : '' }}>
                        <label class="form-check-label" for="rating3">3 stars and higher</label>
                    </li>
                    <li class="form-check mb-2">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="rating" id="rating2"
                            value="2" {{ request()->input('rating') == 2 ? 'checked' : '' }}>
                        <label class="form-check-label" for="rating2">2 stars and higher</label>
                    </li>
                    <li class="form-check">
                        <input class="form-check-input me-2 radio-custom" type="radio" name="rating" id="rating1"
                            value="1" {{ request()->input('rating') == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="rating1">1 star and higher</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


                <!-- Reset Button -->
                <div class="filter-actions pb-40">
                    <a href="{{ route('frontend.services') }}" class="btn btn-lg btn-primary btn-gradient w-100">
                        <i class="fas fa-sync-alt me-2"></i>{{ __('Reset All') }}
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
