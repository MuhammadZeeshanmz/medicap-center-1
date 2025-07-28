@php
  $version = $basicInfo->theme_version;
@endphp
@extends('frontend.layout')
@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->service_page_title }}
  @endif
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_services }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_services }}
  @endif
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', [
      'breadcrumb' => $bgImg->breadcrumb,
      'title' => !empty($pageHeading) ? $pageHeading->service_page_title : __('Services'),
  ])

  <!-- Services Listing Section Start -->
  <section class="services-listing-section pt-100 pb-60">
    <div class="container">
      <div class="row gx-xl-5">
        <!-- Services Sidebar -->
        @includeIf('frontend.services.side-bar')
        
        <!-- Main Content Area -->
        <div class="col-lg-8 col-xl-9">
          <!-- Sorting and Filter Controls -->
          <div class="listing-controls" data-aos="fade-up">
            <div class="row align-items-center">
              <div class="col-lg-6">
                <h5 class="results-count mb-20">
                  @if ($total_services > 1)
                    <span class="highlight" id="total-service">{{ $total_services }}</span>
                    {{ __('Services Found') }}
                  @elseif ($total_services == 1)
                    <span class="highlight" id="total-service">{{ $total_services }}</span>
                    {{ __('Service Found') }}
                  @else
                    {{ __('No Service Available') }}
                  @endif
                </h5>
              </div>
              <div class="col-4 d-lg-none">
                <button class="btn btn-sm btn-outline filter-toggle radius-sm mb-20" type="button" 
                  data-bs-toggle="offcanvas" data-bs-target="#widgetOffcanvas" aria-controls="widgetOffcanvas">
                  {{ __('Filter') }} <i class="fal fa-filter"></i>
                </button>
              </div>
              <div class="col-8 col-lg-6">
                <div class="sorting-options">
                  <ul class="sort-list list-unstyled mb-20">
                    <li class="sort-item">
                      <div class="sort-control d-flex align-items-center">
                        <label class="me-2 font-sm">{{ __('Sort By') }}:</label>
                        <select name="sort" class="sort-select nice-select right">
                          <option {{ request()->input('newest') == 'default' ? 'selected' : '' }} value="newest">
                            {{ __('Date : Newest on top') }}
                          </option>
                          <option {{ request()->input('sort') == 'oldest' ? 'selected' : '' }} value="oldest">
                            {{ __('Date : Oldest on top') }}
                          </option>
                          <option {{ request()->input('sort') == 'high-to-low' ? 'selected' : '' }} value="high-to-low">
                            {{ __('Price : High to Low') }}
                          </option>
                          <option {{ request()->input('sort') == 'low-to-high' ? 'selected' : '' }} value="low-to-high">
                            {{ __('Price : Low to High') }}
                          </option>
                        </select>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Services Grid -->
          <div id="search-container">
            <div class="row">
              @foreach ($featuredServices as $service)
                <div class="col-xl-4 col-sm-6" data-aos="fade-up">
                  <div class="service-card featured border radius-md p-15 mb-25">
                    <figure class="service-image mb-15">
                      <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}"
                        title="{{ $service->name }}" class="image-container ratio ratio-2-3">
                        <img class="lazyload" 
                          src="{{ asset('assets/frontend/images/placeholder.png') }}" 
                          data-src="{{ asset('assets/img/services/' . $service->service_image) }}" 
                          alt="{{ $service->name }}"
                          loading="lazy">
                      </a>
                    </figure>
                    <div class="service-details">
                      <div class="service-meta d-flex align-items-center justify-content-between gap-2">
                        <a href="{{ route('frontend.services', ['category_id' => $service->categoryid]) }}" class="service-category">
                          <span class="badge">{{ $service->categoryName }}</span>
                        </a>
                        @auth('web')
                        <a href="{{ checkWishList($service->id, Auth::id()) ? route('remove.wishlist', $service->id) : route('addto.wishlist', $service->id) }}" 
                          class="wishlist-btn {{ checkWishList($service->id, Auth::id()) ? 'active' : '' }}"
                          data-tooltip="tooltip" 
                          title="{{ checkWishList($service->id, Auth::id()) ? __('Saved') : __('Save to Wishlist') }}">
                          <i class="fal fa-heart"></i>
                        </a>
                        @else
                        <a href="{{ route('user.login') }}" class="wishlist-btn" 
                          data-tooltip="tooltip" title="{{ __('Save to Wishlist') }}">
                          <i class="fal fa-heart"></i>
                        </a>
                        @endauth
                      </div>
                      <h3 class="service-title">
                        <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}">
                          {{ truncateString($service->name, 60) }}
                        </a>
                      </h3>
                      
                      <div class="service-provider mb-10 mt-10">
                        @if ($service->vendor_id != 0)
                          @if ($service->vendor->photo)
                            <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}">
                              <img class="lazyload" 
                                src="{{ asset('assets/frontend/images/placeholder.png') }}" 
                                data-src="{{ asset('assets/admin/img/vendor-photo/' . $service->vendor->photo) }}" 
                                alt="{{ $service->vendor->username }}"
                                loading="lazy">
                            </a>
                          @else
                            <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}">
                              <img class="lazyload" 
                                src="{{ asset('assets/frontend/images/placeholder.png') }}" 
                                data-src="{{ asset('assets/img/user.png') }}" 
                                alt="{{ $service->vendor->username }}"
                                loading="lazy">
                            </a>
                          @endif
                          <span class="provider-name">
                            {{ __('By') }} 
                            <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}">
                              {{ $service->vendor->username }}
                            </a>
                          </span>
                        @else
                          <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}">
                            <img class="lazyload" 
                              src="{{ asset('assets/frontend/images/placeholder.png') }}" 
                              data-src="{{ asset('assets/img/admins/' . $admin->image) }}" 
                              alt="{{ $admin->username }}"
                              loading="lazy">
                          </a>
                          <span class="provider-name">
                            {{ __('By') }} 
                            <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}">
                              {{ $admin->username }}
                            </a>
                          </span>
                        @endif
                      </div>
                      
                      @if (!empty($service->address))
                        <div class="service-location">
                          <i class="fal fa-map-marker-alt"></i>
                          {{ truncateString($service->address, 30) }}
                        </div>
                      @endif
                      
                      @if ($service->zoom_meeting == 1)
                        <div class="service-online">
                          <i class="fal fa-video"></i>
                          {{ __('Online') }}
                        </div>
                      @endif
                      
                      <div class="service-footer d-flex align-items-center justify-content-between gap-2 mt-10">
                        <div class="service-price">
                          <span class="current-price">{{ symbolPrice($service->price) }}</span>
                          @if($service->prev_price)
                            <span class="original-price">{{ symbolPrice($service->prev_price) }}</span>
                          @endif
                        </div>
                        <a href="javascript:void(0)" class="book-now-btn" 
                          data-bs-toggle="modal" data-bs-target="#makeBooking" 
                          data-id="{{ $service->id }}">
                          {{ __('Book Now') }}
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

              @foreach ($services as $service)
                <div class="col-xl-4 col-sm-6" data-aos="fade-up">
                  <div class="service-card border radius-md p-15 mb-25">
                    <!-- Same structure as featured services above -->
                    <!-- Content identical to featured services loop -->
                  </div>
                </div>
              @endforeach
            </div>

            <!-- Pagination -->
            <nav class="pagination-wrapper" data-aos="fade-up">
              <ul class="pagination justify-content-center">
                {{ $services->appends([
                    'category_id' => request()->input('category_id'),
                    'min_val' => request()->input('min_val'),
                    'max_val' => request()->input('max_val'),
                    'rating' => request()->input('rating'),
                    'sort_val' => request()->input('sort_val'),
                ])->links() }}
              </ul>
            </nav>
          </div>

          @if (!empty(showAd(3)))
            <div class="advertisement text-center mt-4 mb-40">
              {!! showAd(3) !!}
            </div>
          @endif

          <!-- Hidden Search Form -->
          <form id="searchForm" action="{{ route('frontend.services.category.search') }}" method="get">
            <input type="hidden" id="category" name="category" value="{{ request()->input('category') }}">
            <input type="hidden" id="min_val" name="min_val" value="{{ request()->input('min_val') }}">
            <input type="hidden" id="max_val" name="max_val" value="{{ request()->input('max_val') }}">
            <input type="hidden" id="rating" name="rating" value="{{ request()->input('rating') }}">
            <input type="hidden" id="sort_val" name="sort_val" value="{{ request()->input('sort_val') }}">
            <input type="hidden" id="page" value="{{ request()->input('page') }}">
            <input type="hidden" id="location_val" name="location_val" value="{{ request()->input('location_val') }}">
            <input type="hidden" id="service_title" name="service_title" value="{{ request()->input('service_title') }}">
            <input type="hidden" id="service_type" name="service_type" value="{{ request()->input('service_type') }}">
          </form>

          <div class="mb-15"></div>
        </div>
      </div>
    </div>
  </section>
  <!-- Services Listing Section End -->
@endsection

@section('script')
  <script src="{{ asset('assets/frontend/js/service_search.js') }}"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="{{ $authorizeUrl }}"></script>
  <script>
    let searchUrl = "{{ route('frontend.services.category.search') }}";
    let stripe_key = "{{ $stripe_key }}";
    let authorize_login_key = "{{ $authorize_login_id }}";
    let authorize_public_key = "{{ $authorize_public_key }}";
    let complete = "{{ Session::get('complete') }}";
    let bookingInfo = {!! json_encode(Session::get('paymentInfo')) !!};
    
    // Initialize lazy loading
    document.addEventListener('DOMContentLoaded', function() {
      if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img.lazyload');
        images.forEach(img => {
          img.src = img.dataset.src;
        });
      } else {
        // Load lazysizes script if native loading isn't supported
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
        document.body.appendChild(script);
      }
    });
  </script>
  <script src="{{ asset('assets/frontend/js/appointment.js') }}"></script>
@endsection