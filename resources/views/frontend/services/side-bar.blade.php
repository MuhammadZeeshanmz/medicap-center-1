<div class="col-lg-4 col-xl-3">
<<<<<<< HEAD
    <div class="widget-offcanvas offcanvas-lg offcanvas-start" tabindex="-1" id="widgetOffcanvas"
        aria-labelledby="widgetOffcanvas">
        <div class="offcanvas-header px-20">
            <h4 class="offcanvas-title">{{ __('Filter') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#widgetOffcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-lg-0">
            <aside class="widget-area" data-aos="fade-up">
                <div class="widget widget-categories mb-30 p-20 border radius-md">
                    <h5 class="title">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#categories">
                            {{ __('Categories') }}
                        </button>
                    </h5>
                    <div id="categories" class="collapse show">
                        <div class="accordion-body mt-20 scroll-y">
                            <ul class="list-group">
                                <!-- Add class .list-dropdown form dropdown-menu -->
                                <li class="list-item list-dropdown">
                                    <a class="category-toggle {{ request()->category ? '' : 'active' }}"
                                        href="javascript:void(0)">{{ __('All') }}<span
                                            class="qty category_total_service">({{ $total_services }})</span></a>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="list-item">
                                        <a href="javascript:void(0)"
                                            class="category-toggle {{ request()->category == $category->slug ? 'active' : '' }}"
                                            data-slug="{{ $category->slug }}">
                                            {{ $category->name }}
                                            <span class="qty">({{ $category->service_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="service_details">
                    <div class="widget widget-select mb-30 p-20 border radius-md">
                        <h5 class="title">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#select" aria-expanded="true" aria-controls="select">
                                {{ __('Service Details') }}
                            </button>
                        </h5>
                        <div id="select" class="collapse show">
                            <div class="accordion-body mt-20 scroll-y">
                                <div class="row gx-sm-2">
                                    <div class="col-md-12 col-xxl-12">
                                        <div class="form-group mb-20">
                                            <label class="mb-1 color-dark">{{ __('Service Title') }}</label>
                                            <input class="form-control" autocomplete="off" type="text"
                                                placeholder="{{ __('Enter Service Title') }}"
                                                value="{{ request('service_title') }}" id="search_service_title">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xxl-12">
                                        <div class="form-group">
                                            <label class="mb-1 color-dark">{{ __('Location') }}</label>
                                            <input class="form-control" value="{{ request('location') }}"
                                                type="text" autocomplete="off"
                                                placeholder="{{ __('Enter location') }}" name="location"
                                                id="location">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="service_type_div">
                    <div class="widget widget-ratings mb-30 p-20 border radius-md">
                        <h5 class="title">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#sort" aria-expanded="true" aria-controls="sort">
                                {{ __('Service Type') }}
                            </button>
                        </h5>
                        <div id="sort" class="collapse show">
                            <div class="accordion-body mt-20 scroll-y">
                                <ul class="list-group custom-radio">
                                    <li>
                                        <input class="input-radio service_type" type="radio" name="service_type"
                                            id="service_type_all" value="service_type_all" checked>
                                        <label class="form-radio-label"
                                            for="service_type_all"><span>{{ __('All') }}
                                    </li>
                                    <li>
                                        <input class="input-radio service_type" type="radio" name="service_type"
                                            id="offline" value="offline">
                                        <label class="form-radio-label" for="offline"><span>{{ __('Offline') }}
                                    </li>
                                    <li>
                                        <input class="input-radio service_type" type="radio" name="service_type"
                                            id="online" value="online">
                                        <label class="form-radio-label" for="online"><span>{{ __('Online') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget widget-price mb-30 p-20 border radius-md">
                    <h5 class="title">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#price" aria-expanded="true" aria-controls="price">
                            {{ __('Pricing') }}
                        </button>
                    </h5>
                    <div id="price" class="collapse show">
                        <div class="accordion-body pt-20 scroll-y">
                            <div class="row gx-sm-3 d-none">
                                <div class="col-md-6">
                                    <div class="form-group mb-20">
                                        <label class="mb-1 color-dark">{{ __('Minimum') }}</label>
                                        <input class="form-control" type="number" name="min" id="min"
                                            value="{{ $min }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-20">
                                        <label class="mb-1 color-dark">{{ __('Maximum') }}</label>
                                        <input class="form-control" type="number" name="max" id="max"
                                            value="{{ $max }}">
                                    </div>
                                </div>
                            </div>
                            <input class="form-control" type="hidden" value="{{ $min }}" id="o_min">
                            <input class="form-control" type="hidden" value="{{ $max }}" id="o_max">
                            <input type="hidden" id="currency_symbol"
                                value="{{ $basicInfo->base_currency_symbol }}">
                            <div class="price-item">
                                <div class="price-slider" data-range-slider='filterPriceSlider'></div>
                                <div class="price-value">
                                    <span class="color-dark">{{ __('Price') }}:
                                        <span class="filter-price-range"
                                            data-range-value='filterPriceSliderValue'></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="rating_div">
                    <div class="widget widget-ratings mb-30 p-20 border radius-md">
                        <h5 class="title">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#sort" aria-expanded="true" aria-controls="sort">
                                {{ __('Ratings') }}
                            </button>
                        </h5>
                        <div id="sort" class="collapse show">
                            <div class="accordion-body mt-20 scroll-y">
                                <ul class="list-group custom-radio">
                                    <li>
                                        <input class="input-radio rating" type="radio" name="rating"
                                            id="radio1" value=""
                                            {{ empty(request()->input('rating')) ? 'checked' : '' }}>
                                        <label class="form-radio-label" for="radio1"><span>{{ __('Show All') }}
                                    </li>
                                    <li>
                                        <input class="input-radio rating" type="radio" name="rating"
                                            id="radio6" value="5"
                                            {{ request()->input('rating') == 5 ? 'checked' : '' }}>
                                        <label class="form-radio-label" for="radio6"><span>{{ __('5 stars') }}
                                    </li>
                                    <li>
                                        <input class="input-radio rating" type="radio" name="rating"
                                            id="radio5" value="4"
                                            {{ request()->input('rating') == 4 ? 'checked' : '' }}>
                                        <label class="form-radio-label"
                                            for="radio5"><span>{{ __('4 stars and higher') }}
                                    </li>
                                    <li>
                                        <input class="input-radio rating" type="radio" name="rating"
                                            id="radio4" value="3"
                                            {{ request()->input('rating') == 3 ? 'checked' : '' }}>
                                        <label class="form-radio-label"
                                            for="radio4"><span>{{ __('3 stars and higher') }}
                                    </li>
                                    <li>
                                        <input class="input-radio rating" type="radio" name="rating"
                                            id="radio3" value="2"
                                            {{ request()->input('rating') == 2 ? 'checked' : '' }}>
                                        <label class="form-radio-label"
                                            for="radio3"><span>{{ __('2 stars and higher') }}
                                    </li>
                                    <li>
                                        <input class="input-radio rating" type="radio" name="rating"
                                            id="radio2" value="1"
                                            {{ request()->input('rating') == 1 ? 'checked' : '' }}>
                                        <label class="form-radio-label"
                                            for="radio2"><span>{{ __('1 star and higher') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cta pb-40">
                    <a href="{{ route('frontend.services') }}"
                        class="btn btn-lg btn-primary btn-gradient icon-end w-100">
                        <i class="fal fa-sync-alt"></i> {{ __('Reset All') }}
                    </a>
                </div>
                @if (!empty(showAd(1)))
                    <div class="text-center mt-4">
                        {!! showAd(1) !!}
                    </div>
                @endif
            </aside>
        </div>
    </div>
</div>
=======
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
        <div class="filter-widget mb-30 p-20 border radius-md">
          <h5 class="widget-title">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#filterCategories">
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
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#filterDetails"
                aria-expanded="true">
                {{ __('Service Details') }}
              </button>
            </h5>
            <div id="filterDetails" class="collapse show">
              <div class="accordion-body mt-20 scroll-y">
                <div class="row gx-sm-2">
                  <div class="col-12">
                    <div class="form-group mb-20">
                      <label class="form-label">{{ __('Service Title') }}</label>
                      <input class="form-control" type="text" placeholder="{{ __('Enter Service Title') }}" 
                        value="{{ request('service_title') }}" id="search_service_title">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label class="form-label">{{ __('Location') }}</label>
                      <input class="form-control" type="text" placeholder="{{ __('Enter location') }}" 
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
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#filterServiceType">
                {{ __('Service Type') }}
              </button>
            </h5>
            <div id="filterServiceType" class="collapse show">
              <div class="accordion-body mt-20 scroll-y">
                <ul class="filter-options">
                  <li class="filter-option">
                    <input class="form-radio" type="radio" name="service_type" id="service_type_all" 
                      value="all" checked>
                    <label for="service_type_all">{{ __('All') }}</label>
                  </li>
                  <li class="filter-option">
                    <input class="form-radio" type="radio" name="service_type" id="offline" value="offline">
                    <label for="offline">{{ __('Offline') }}</label>
                  </li>
                  <li class="filter-option">
                    <input class="form-radio" type="radio" name="service_type" id="online" value="online">
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
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#filterPrice">
              {{ __('Pricing') }}
            </button>
          </h5>
          <div id="filterPrice" class="collapse show">
            <div class="accordion-body pt-20 scroll-y">
              <div class="row gx-sm-3 d-none">
                <div class="col-md-6">
                  <div class="form-group mb-20">
                    <label class="form-label">{{ __('Minimum') }}</label>
                    <input class="form-control" type="number" id="min" value="{{ $min }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-20">
                    <label class="form-label">{{ __('Maximum') }}</label>
                    <input class="form-control" type="number" id="max" value="{{ $max }}">
                  </div>
                </div>
              </div>
              <input type="hidden" id="o_min" value="{{ $min }}">
              <input type="hidden" id="o_max" value="{{ $max }}">
              <input type="hidden" id="currency_symbol" value="{{ $basicInfo->base_currency_symbol }}">
              <div class="price-range">
                <div class="range-slider" data-range-slider></div>
                <div class="price-display">
                  <span>{{ __('Price') }}: <span class="price-values" data-range-value></span></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Ratings Filter -->
        <div id="ratingsFilter">
          <div class="filter-widget mb-30 p-20 border radius-md">
            <h5 class="widget-title">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#filterRatings">
                {{ __('Ratings') }}
              </button>
            </h5>
            <div id="filterRatings" class="collapse show">
              <div class="accordion-body mt-20 scroll-y">
                <ul class="filter-options">
                  <li class="filter-option">
                    <input class="form-radio" type="radio" name="rating" id="ratingAll" value=""
                      {{ empty(request()->input('rating')) ? 'checked' : '' }}>
                    <label for="ratingAll">{{ __('Show All') }}</label>
                  </li>
                  <li class="filter-option">
                    <input class="form-radio" type="radio" name="rating" id="rating5" value="5"
                      {{ request()->input('rating') == 5 ? 'checked' : '' }}>
                    <label for="rating5">{{ __('5 stars') }}</label>
                  </li>
                  <li class="filter-option">
                    <input class="form-radio" type="radio" name="rating" id="rating4" value="4"
                      {{ request()->input('rating') == 4 ? 'checked' : '' }}>
                    <label for="rating4">{{ __('4 stars and higher') }}</label>
                  </li>
                  <li class="filter-option">
                    <input class="form-radio" type="radio" name="rating" id="rating3" value="3"
                      {{ request()->input('rating') == 3 ? 'checked' : '' }}>
                    <label for="rating3">{{ __('3 stars and higher') }}</label>
                  </li>
                  <li class="filter-option">
                    <input class="form-radio" type="radio" name="rating" id="rating2" value="2"
                      {{ request()->input('rating') == 2 ? 'checked' : '' }}>
                    <label for="rating2">{{ __('2 stars and higher') }}</label>
                  </li>
                  <li class="filter-option">
                    <input class="form-radio" type="radio" name="rating" id="rating1" value="1"
                      {{ request()->input('rating') == 1 ? 'checked' : '' }}>
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
>>>>>>> 15d155151d7c343083218b5175d33a0389d30aac
