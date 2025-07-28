@php
  $version = $basicInfo->theme_version;
@endphp
@extends('frontend.layout')

@section('pageHeading')
  {{ !empty($pageHeading) ? $pageHeading->vendor_page_title : __('Vendors') }}
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keywords_vendor_page }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_vendor_page }}
  @endif
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', [
      'breadcrumb' => $bgImg->breadcrumb,
      'title' => !empty($pageHeading) ? $pageHeading->vendor_page_title : __('Vendors'),
  ])

  <!-- Vendor-area start -->

@php
  $version = $basicInfo->theme_version;
@endphp
@extends('frontend.layout')

@section('pageHeading')
  {{ !empty($pageHeading) ? $pageHeading->vendor_page_title : __('Vendors') }}
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keywords_vendor_page }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_vendor_page }}
  @endif
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', [
      'breadcrumb' => $bgImg->breadcrumb,
      'title' => !empty($pageHeading) ? $pageHeading->vendor_page_title : __('Vendors'),
  ])

  <!-- Vendor-area start -->
  <div class="vendor-area pt-100 pb-60">
    <div class="container">
      <div class="sort-area" data-aos="fade-up">
        <div class="row align-items-center">
          <div class="col-lg-5">
            <h5 class="mb-20">
              @php
                $t_vendor = $vendors->count();
                if ($admin) {
                    $a_vendor = 1;
                } else {
                    $a_vendor = 0;
                }
                $totalvendor = $t_vendor + $a_vendor;
              @endphp
              {{ $totalvendor }}
              {{ count($vendors) > 1 ? __('Vendors') : __('Vendor') }} {{ __('Found') }}
            </h5>
          </div>
          <div class="col-lg-7">
            <form action="{{ route('frontend.vendors') }}" method="GET">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group icon-start mb-20">
                    <span class="icon color-primary">
                      <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="name" value="{{ request()->input('name') }}"
                      class="form-control border-primary" placeholder="{{ __('Vendor name/username') }}">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group icon-start mb-20">
                    <span class="icon color-primary">
                      <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <input type="text" name="location" class="form-control border-primary"
                      value="{{ request()->input('location') }}" placeholder="{{ __('Enter location') }}">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group icon-start">
                    <button type="submit" class="btn btn-icon bg-primary radius-sm color-white w-100">
                      <i class="fal fa-search"></i>
                      <span class="d-inline-block d-md-none">{{ __('Search') }}</span>
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        @if ($admin)
          <div class="col-md-6 col-lg-4 col-xl-3" data-aos="fade-up">
            <div class="card text-center border radius-md p-15 mb-25">
              <figure class="card-img mx-auto mb-15">
                <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}" title="Image"
                  target="_self" class="lazy-container rounded-circle ratio ratio-1-1">
                  @if ($admin->image && file_exists(public_path('assets/img/admins/' . $admin->image)))
                    <img class="lazyload" 
                         src="{{ asset('assets/frontend/images/placeholder.png') }}"
                         data-src="{{ asset('assets/img/admins/' . $admin->image) }}" 
                         alt="{{ $admin->username }}"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='{{ asset('assets/img/user.png') }}'">
                  @else
                    <img class="lazyload" 
                         src="{{ asset('assets/frontend/images/placeholder.png') }}"
                         data-src="{{ asset('assets/img/user.png') }}" 
                         alt="{{ $admin->username }}"
                         loading="lazy">
                  @endif
                </a>
              </figure>
              <div class="card-details">
                <h6 class="card-title mb-1">
                  <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}" target="_self"
                    title="{{ $admin->username }}">
                    {{ __('Admin') }}
                  </a>
                </h6>

                @if ($admin->address != null)
                  <span class="font-sm icon-start"><i
                      class="fal fa-map-marker-alt"></i>{{ truncateString($admin->address, 30) }}</span>
                @endif
                <div class="mt-10 pt-10 border-top text-center">
                  @php
                    $total_service = App\Models\Services\Services::where('vendor_id', 0)->where('status', 1)->count();
                  @endphp
                  <span class="font-sm">
                    @if ($total_service > 1)
                      {{ $total_service }} {{ __('Services Available') }}
                    @elseif($total_service == 1)
                      {{ $total_service }} {{ __('Service Available') }}
                    @else
                      {{ __('No Service Available') }}
                    @endif
                  </span>
                </div>
              </div>
              <div class="ratings d-flex justify-content-center mt-2">
                @php
                  $reviews = App\Models\Services\ServiceReview::where('vendor_id', 0)->get();
                  if ($reviews != '[]') {
                      $totalRating = 0;
                      foreach ($reviews as $review) {
                          $totalRating += $review->rating;
                      }
                      $numOfReview = count($reviews);
                      $averageRating = number_format($totalRating / $numOfReview, 1);
                  }
                @endphp
                <div class="rate bg-img" data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                  @if (empty($averageRating))
                    @php
                      $width = '0%';
                    @endphp
                    <div class="rating-icon bg-img" style="width: {{ $width }}"
                      data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                    </div>
                  @else
                    <div class="rating-icon bg-img" style="width: {{ $averageRating * 20 . '%;' }}"
                      data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                    </div>
                  @endif
                </div>
                <span class="ratings-total">
                  @if (!empty($averageRating))
                    ({{ $averageRating }} {{ __('Ratings') }})
                  @else
                    (0 {{ __('Rating') }})
                  @endif
                </span>
              </div>
            </div>
          </div>
        @endif
        @foreach ($vendors as $vendor)
          <div class="col-md-6 col-lg-4 col-xl-3" data-aos="fade-up">
            <div class="card text-center border radius-md p-15 mb-25">
              <figure class="card-img mx-auto mb-15">
                <a href="{{ route('frontend.vendor.details', ['username' => $vendor->username]) }}" title="Image"
                  target="_self" class="lazy-container rounded-circle ratio ratio-1-1">
                  @if ($vendor->photo && file_exists(public_path('assets/admin/img/vendor-photo/' . $vendor->photo)))
                    <img class="lazyload" 
                         src="{{ asset('assets/frontend/images/placeholder.png') }}"
                         data-src="{{ asset('assets/admin/img/vendor-photo/' . $vendor->photo) }}" 
                         alt="{{ $vendor->username }}"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='{{ asset('assets/img/user.png') }}'">
                  @else
                    <img class="lazyload" 
                         src="{{ asset('assets/frontend/images/placeholder.png') }}"
                         data-src="{{ asset('assets/img/user.png') }}" 
                         alt="{{ $vendor->username }}"
                         loading="lazy">
                  @endif
                </a>
              </figure>
              <div class="card-details">
                @php
                  $vendorInfo = App\Models\VendorInfo::where([
                      ['vendor_id', $vendor->vendorId],
                      ['language_id', $language->id],
                  ])->first();
                @endphp
                <h6 class="card-title mb-1">
                  <a href="{{ route('frontend.vendor.details', ['username' => $vendor->username]) }}" target="_self"
                    title="{{ $vendor->username }}">
                    @if ($vendorInfo && $vendorInfo->name != null)
                      {{ $vendorInfo->name }}
                    @else
                      {{ $vendor->username }}
                    @endif
                  </a>
                </h6>
                @if ($vendorInfo)
                  @if ($vendorInfo->address != null)
                    <span class="font-sm icon-start"><i
                        class="fal fa-map-marker-alt"></i>{{ truncateString($vendorInfo->address, 30) }}</span>
                  @endif
                @endif
                <div class="mt-10 pt-10 border-top text-center">
                  @php
                    $total_service = App\Models\Services\Services::where('vendor_id', $vendor->vendorId)
                        ->where('status', 1)
                        ->count();
                  @endphp

                  <span class="font-sm">
                    @if ($total_service > 1)
                      {{ $total_service }} {{ __('Services Available') }}
                    @elseif($total_service == 1)
                      {{ $total_service }} {{ __('Service Available') }}
                    @else
                      {{ __('No Service Available') }}
                    @endif
                  </span>
                </div>
              </div>
              <div class="ratings d-flex justify-content-center mt-2">
                @php
                  $reviews = App\Models\Services\ServiceReview::where('vendor_id', $vendor->id)->get();
                  if ($reviews != '[]') {
                      $totalRating = 0;
                      foreach ($reviews as $review) {
                          $totalRating += $review->rating;
                      }
                      $numOfReview = count($reviews);
                      $averageRating = number_format($totalRating / $numOfReview, 1);
                  }
                @endphp
                <div class="rate bg-img" data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                  @if (empty($averageRating))
                    @php
                      $width = '0%';
                    @endphp
                    <div class="rating-icon bg-img" style="width:{{ $width }}"
                      data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                    </div>
                  @else
                    <div class="rating-icon bg-img" style="width: {{ $averageRating * 20 . '%;' }}"
                      data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                    </div>
                  @endif
                </div>
                <span class="ratings-total">
                  @if (!empty($averageRating))
                    ({{ $averageRating }} {{ __('Ratings') }})
                  @else
                    (0 {{ __('Rating') }})
                  @endif
                </span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <nav class="pagination-nav pb-25 d-flex justify-content-center" data-aos="fade-up">
        {{ $vendors->links() }}
      </nav>
      @if (!empty(showAd(3)))
        <div class="text-center mt-4">
          {!! showAd(3) !!}
        </div>
      @endif
    </div>
  </div>
  <!-- Vendor-area end -->
@endsection

@push('css')
<style>
  /* Image Loading Styles */
  .lazy-container {
    display: block;
    width: 100%;
    height: 0;
    padding-bottom: 100%; /* 1:1 Aspect Ratio */
    position: relative;
    overflow: hidden;
    background-color: #f5f5f5;
    border-radius: 50%;
  }
  
  .lazy-container img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: opacity 0.3s ease;
    opacity: 0;
  }
  
  .lazy-container img.lazyloaded {
    opacity: 1;
  }
  
  /* Card consistent height */
  .card {
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  
  .card-details {
    flex-grow: 1;
  }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Initialize lazy loading with fallback
  const lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazyload",
    callback_loaded: function(el) {
      el.classList.add('lazyloaded');
    },
    callback_error: function(el) {
      if (!el.src.includes('user.png')) {
        el.src = '{{ asset("assets/img/user.png") }}';
      }
    }
  });
  
  // Manual fallback for browsers that don't support IntersectionObserver
  if (typeof IntersectionObserver === 'undefined') {
    document.querySelectorAll('.lazyload').forEach(img => {
      img.src = img.dataset.src;
    });
  }
});
</script>
@endpush
<!-- Vendor-area end -->

@push('css')
<style>
  /* Image Loading Fixes */
  .lazy-container {
    display: block;
    position: relative;
    overflow: hidden;
  }
  
  .lazyload {
    transition: opacity 0.3s ease;
    opacity: 0;
  }
  
  .lazyloaded {
    opacity: 1;
  }
  
  /* Hover Effects */
  .hover-scale {
    transition: transform 0.3s ease;
  }
  .hover-scale:hover {
    transform: scale(1.05);
  }
  
  .hover-text-primary:hover {
    color: var(--primary) !important;
  }
  
  .hover-text-accent:hover {
    color: var(--accent) !important;
  }
  
  .hover-text-info:hover {
    color: var(--info) !important;
  }
  
  .hover-shadow {
    transition: box-shadow 0.3s ease;
  }
  .hover-shadow:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
  
  .hover-shadow-sm {
    transition: box-shadow 0.3s ease;
  }
  .hover-shadow-sm:hover {
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
  }
  
  .hover-shadow-lg {
    transition: box-shadow 0.3s ease;
  }
  .hover-shadow-lg:hover {
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  }
  
  .hover-border-primary {
    transition: border-color 0.3s ease;
  }
  .hover-border-primary:hover {
    border-color: var(--primary) !important;
  }
  
  .hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }
  
  .hover-lift-sm {
    transition: transform 0.3s ease;
  }
  .hover-lift-sm:hover {
    transform: translateY(-3px);
  }
  
  .hover-grow {
    transition: transform 0.3s ease;
  }
  .hover-grow:hover {
    transform: scale(1.05);
  }
  
  .hover-bounce {
    animation: bounce 2s infinite;
  }
  @keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
  }
  
  .hover-pop {
    transition: transform 0.2s ease;
  }
  .hover-pop:hover {
    transform: scale(1.2);
  }
  
  .hover-underline {
    position: relative;
  }
  .hover-underline::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background-color: var(--primary);
    transition: width 0.3s ease;
  }
  .hover-underline:hover::after {
    width: 100%;
  }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Initialize lazy loading
  if (typeof LazyLoad !== 'undefined') {
    new LazyLoad({
      elements_selector: ".lazyload",
      callback_loaded: function(el) {
        el.classList.add('lazyloaded');
      }
    });
  }
  
  // Fallback for images
  document.querySelectorAll('img').forEach(img => {
    img.addEventListener('error', function() {
      if (!this.src.includes('user.png')) {
        this.src = '{{ asset("assets/img/user.png") }}';
      }
    });
  });
});
</script>
@endpush
  <!-- Vendor-area end -->
@endsection
