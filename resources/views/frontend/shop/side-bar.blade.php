<div class="col-lg-4 col-xl-3">
    <div class="widget-offcanvas offcanvas-lg offcanvas-start" tabindex="-1" id="widgetOffcanvas"
        aria-labelledby="widgetOffcanvas">
        <div class="offcanvas-header px-20">
            <h4 class="offcanvas-title">{{ __('Filter') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#widgetOffcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-3 p-lg-0">
            <aside class="widget-area" data-aos="fade-up">
                <form action="{{ route('shop.products') }}" method="get" id="searchForm">
                    <!-- Product Name Filter -->
                    <div class="widget mb-30 p-20 border radius-md">
                        <h5 class="title">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#input" aria-expanded="true" aria-controls="input">
                                {{ __('Product Name') }}
                            </button>
                        </h5>
                        <div id="input" class="collapse show">
                            <div class="accordion-body scroll-y mt-20">
                                <input type="text" name="product_name" value="{{ request()->input('product_name') }}"
                                    placeholder="{{ __('Search by Title') }}" id="searchByProductName"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Categories Filter -->
                    <div class="widget mb-30 p-20 border radius-md">
                        <h5 class="title">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#brands" aria-expanded="true" aria-controls="brands">
                                {{ __('Categories') }}
                            </button>
                        </h5>
                        <div id="brands" class="collapse show">
                            <div class="accordion-body scroll-y mt-20">
                                <ul class="list-group custom-radio">
                                    <li>
                                        <input class="input-radio" type="radio"
                                            onclick="document.getElementById('searchForm').submit()" name="category"
                                            id="radio1" value=""
                                            {{ empty(request()->input('category')) ? 'checked' : '' }}>
                                        <label class="form-radio-label" for="radio1">
                                            <span>{{ __('All') }}</span>
                                            <span class="qty">({{ $total_products }})</span>
                                        </label>
                                    </li>
                                    @foreach ($categories as $category)
                                        <li>
                                            <input class="input-radio" type="radio"
                                                onclick="document.getElementById('searchForm').submit()" name="category"
                                                id="radio1-{{ $loop->iteration }}" value="{{ $category->slug }}"
                                                {{ request()->input('category') == $category->slug ? 'checked' : '' }}>
                                            <label class="form-radio-label" for="radio1-{{ $loop->iteration }}">
                                                <span>{{ $category->name }}</span>
                                                <span
                                                    class="qty">({{ $category->products_count ?? $category->products()->count() }})</span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="widget widget-price mb-30 p-20 border radius-md">
                        <h5 class="title">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#price" aria-expanded="true" aria-controls="price">
                                {{ __('Pricing') }}
                            </button>
                        </h5>
                        <div id="price" class="collapse show">
                            <div class="accordion-body scroll-y mt-20">
                                <div class="row gx-sm-3 d-none">
                                    <div class="col-md-6">
                                        <div class="form-group mb-30">
                                            <input class="form-control" type="hidden"
                                                value="{{ request()->filled('min') ? request()->input('min') : $min }}"
                                                name="min" id="min">
                                            <input class="form-control" type="hidden" value="{{ $min }}"
                                                id="o_min">
                                            <input class="form-control" type="hidden" value="{{ $max }}"
                                                id="o_max">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-30">
                                            <input class="form-control"
                                                value="{{ request()->filled('max') ? request()->input('max') : $max }}"
                                                type="hidden" name="max" id="max">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="currency_symbol"
                                    value="{{ $basicInfo->base_currency_symbol }}">
                                <div class="price-item mt-10">
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

                    <!-- Ratings Filter -->
                    <div class="widget widget-ratings mb-30 p-20 border radius-md">
                        <h5 class="title">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#ratings" aria-expanded="true" aria-controls="ratings">
                                {{ __('Ratings') }}
                            </button>
                        </h5>
                        <div id="ratings" class="collapse show">
                            <div class="accordion-body scroll-y mt-20">
                                <ul class="list-group custom-radio">
                                    <li>
                                        <input class="input-radio" type="radio"
                                            onclick="document.getElementById('searchForm').submit()" name="rating"
                                            id="radioR" value=""
                                            {{ empty(request()->input('rating')) ? 'checked' : '' }}>
                                        <label class="form-radio-label"
                                            for="radioR"><span>{{ __('All') }}</span></label>
                                    </li>
                                    <li>
                                        <input class="input-radio" type="radio"
                                            onclick="document.getElementById('searchForm').submit()" name="rating"
                                            id="radioR-5" value="5"
                                            {{ request()->input('rating') == 5 ? 'checked' : '' }}>
                                        <label class="form-radio-label"
                                            for="radioR-5"><span>{{ __('5 stars') }}</span></label>
                                    </li>
                                    <li>
                                        <input class="input-radio" type="radio"
                                            onclick="document.getElementById('searchForm').submit()" name="rating"
                                            id="radioR-4" value="4"
                                            {{ request()->input('rating') == 4 ? 'checked' : '' }}>
                                        <label class="form-radio-label"
                                            for="radioR-4"><span>{{ __('4 stars and higher') }}</span></label>
                                    </li>
                                    <li>
                                        <input class="input-radio" type="radio"
                                            onclick="document.getElementById('searchForm').submit()" name="rating"
                                            id="radioR-3" value="3"
                                            {{ request()->input('rating') == 3 ? 'checked' : '' }}>
                                        <label class="form-radio-label"
                                            for="radioR-3"><span>{{ __('3 stars and higher') }}</span></label>
                                    </li>
                                    <li>
                                        <input class="input-radio" type="radio"
                                            onclick="document.getElementById('searchForm').submit()" name="rating"
                                            id="radioR-2" value="2"
                                            {{ request()->input('rating') == 2 ? 'checked' : '' }}>
                                        <label class="form-radio-label"
                                            for="radioR-2"><span>{{ __('2 stars and higher') }}</span></label>
                                    </li>
                                    <li>
                                        <input class="input-radio" type="radio"
                                            onclick="document.getElementById('searchForm').submit()" name="rating"
                                            id="radioR-1" value="1"
                                            {{ request()->input('rating') == 1 ? 'checked' : '' }}>
                                        <label class="form-radio-label"
                                            for="radioR-1"><span>{{ __('1 star and higher') }}</span></label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Reset Button -->
                    <div class="cta">
                        <a href="{{ route('shop.products') }}" class="btn btn-lg btn-primary icon-start w-100">
                            <i class="fas fa-sync-alt"></i>{{ __('Reset All') }}
                        </a>
                    </div>
                </form>

                <!-- Spacer -->
                <div class="pb-40"></div>
            </aside>
        </div>

        @if (!empty(showAd(1)))
            <div class="text-center mt-4">
                {!! showAd(1) !!}
            </div>
<<<<<<< HEAD
<<<<<<< HEAD
=======
        @endif
=======
>>>>>>> 99cdbae7c65aa3db6a5d6c5c45df65ec5649db25
          </div>

          <!-- Ratings Filter -->
          <div class="widget widget-ratings mb-30 p-20 border radius-md">
            <h5 class="title">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ratings"
                aria-expanded="true" aria-controls="ratings">
                {{ __('Ratings') }}
              </button>
            </h5>
            <div id="ratings" class="collapse show">
              <div class="accordion-body scroll-y mt-20">
                <ul class="list-group custom-radio">
                  <li>
                    <input class="input-radio" type="radio"
                      onclick="document.getElementById('searchForm').submit()" name="rating" id="radioR"
                      value="" {{ empty(request()->input('rating')) ? 'checked' : '' }}>
                    <label class="form-radio-label" for="radioR"><span>{{ __('All') }}</span></label>
                  </li>
                  <li>
                    <input class="input-radio" type="radio"
                      onclick="document.getElementById('searchForm').submit()" name="rating" id="radioR-5"
                      value="5" {{ request()->input('rating') == 5 ? 'checked' : '' }}>
                    <label class="form-radio-label" for="radioR-5"><span>{{ __('5 stars') }}</span></label>
                  </li>
                  <li>
                    <input class="input-radio" type="radio"
                      onclick="document.getElementById('searchForm').submit()" name="rating" id="radioR-4"
                      value="4" {{ request()->input('rating') == 4 ? 'checked' : '' }}>
                    <label class="form-radio-label" for="radioR-4"><span>{{ __('4 stars and higher') }}</span></label>
                  </li>
                  <li>
                    <input class="input-radio" type="radio"
                      onclick="document.getElementById('searchForm').submit()" name="rating" id="radioR-3"
                      value="3" {{ request()->input('rating') == 3 ? 'checked' : '' }}>
                    <label class="form-radio-label" for="radioR-3"><span>{{ __('3 stars and higher') }}</span></label>
                  </li>
                  <li>
                    <input class="input-radio" type="radio"
                      onclick="document.getElementById('searchForm').submit()" name="rating" id="radioR-2"
                      value="2" {{ request()->input('rating') == 2 ? 'checked' : '' }}>
                    <label class="form-radio-label" for="radioR-2"><span>{{ __('2 stars and higher') }}</span></label>
                  </li>
                  <li>
                    <input class="input-radio" type="radio"
                      onclick="document.getElementById('searchForm').submit()" name="rating" id="radioR-1"
                      value="1" {{ request()->input('rating') == 1 ? 'checked' : '' }}>
                    <label class="form-radio-label" for="radioR-1"><span>{{ __('1 star and higher') }}</span></label>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Reset Button -->
          <div class="cta">
            <a href="{{ route('shop.products') }}" class="btn btn-lg btn-primary icon-start w-100">
              <i class="fas fa-sync-alt"></i>{{ __('Reset All') }}
            </a>
          </div>
        </form>

        <!-- Spacer -->
        <div class="pb-40"></div>
      </aside>
<<<<<<< HEAD
=======
        @endif
>>>>>>> 40edd79af463ec6c303822e1570ba8bbd1125a00
=======
>>>>>>> c0f9421c02b18e7ce0bd8ef04543e319a51d3f25
>>>>>>> 99cdbae7c65aa3db6a5d6c5c45df65ec5649db25
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize price range slider
            if (typeof noUiSlider !== 'undefined') {
                const priceSlider = document.querySelector('[data-range-slider="filterPriceSlider"]');
                const priceValue = document.querySelector('[data-range-value="filterPriceSliderValue"]');
                const minInput = document.getElementById('min');
                const maxInput = document.getElementById('max');
                const oMin = parseFloat(document.getElementById('o_min').value);
                const oMax = parseFloat(document.getElementById('o_max').value);
                const currencySymbol = document.getElementById('currency_symbol').value;

                if (priceSlider) {
                    noUiSlider.create(priceSlider, {
                        start: [minInput.value || oMin, maxInput.value || oMax],
                        connect: true,
                        range: {
                            'min': oMin,
                            'max': oMax
                        },
                        step: 1
                    });

                    priceSlider.noUiSlider.on('update', function(values, handle) {
                        const [min, max] = values.map(val => Math.round(val));
                        minInput.value = min;
                        maxInput.value = max;
                        priceValue.textContent = `${currencySymbol}${min} - ${currencySymbol}${max}`;
                    });

                    priceSlider.noUiSlider.on('end', function() {
                        document.getElementById('searchForm').submit();
                    });
                }
            }

            // Handle accordion state persistence
            const accordions = document.querySelectorAll('.accordion-button');
            accordions.forEach(accordion => {
                const target = accordion.getAttribute('data-bs-target');
                const collapse = document.querySelector(target);

                // Check localStorage for saved state
                const savedState = localStorage.getItem(target);
                if (savedState === 'false') {
                    const bsCollapse = new bootstrap.Collapse(collapse, {
                        toggle: false
                    });
                    bsCollapse.hide();
                }

                collapse.addEventListener('hidden.bs.collapse', () => {
                    localStorage.setItem(target, 'false');
                });

                collapse.addEventListener('shown.bs.collapse', () => {
                    localStorage.setItem(target, 'true');
                });
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Custom radio button styles */
        .custom-radio {
            list-style: none;
            padding-left: 0;
        }

        .custom-radio li {
            margin-bottom: 8px;
        }

        .input-radio {
            position: absolute;
            opacity: 0;
        }

        .form-radio-label {
            position: relative;
            padding-left: 28px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
        }

        .form-radio-label:before {
            content: '';
            position: absolute;
            left: 0;
            top: 2px;
            width: 18px;
            height: 18px;
            border: 1px solid #ddd;
            border-radius: 50%;
            background: #fff;
        }

        .input-radio:checked+.form-radio-label:before {
            border-color: var(--primary);
        }

        .input-radio:checked+.form-radio-label:after {
            content: '';
            position: absolute;
            left: 5px;
            top: 7px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
        }

        .qty {
            color: #777;
            font-size: 0.9em;
        }

        /* Price slider styles */
        .price-slider {
            margin: 15px 0;
            height: 4px;
        }

        .noUi-connect {
            background: var(--primary);
        }

        .noUi-handle {
            width: 16px;
            height: 16px;
            right: -8px;
            top: -6px;
            border-radius: 50%;
            border: 2px solid var(--primary);
            background: #fff;
            box-shadow: none;
        }

        .noUi-handle:before,
        .noUi-handle:after {
            display: none;
        }

        .filter-price-range {
            font-weight: 600;
            color: var(--primary);
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .widget-offcanvas {
                width: 300px;
            }
        }
    </style>
@endpush
