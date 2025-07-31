@php
  $version = $basicInfo->theme_version;
  $service = $details->content->first();
  $title = !empty($service) ? truncateString($service->name, 40) : 'Service Details';
@endphp
@extends('frontend.layout')

@section('pageHeading')
  {{ $title ?? __('Service Details') }}
@endsection

@section('metaKeywords')
  @if ($service) {{ $service->meta_keyword }} @endif
@endsection

@section('metaDescription')
  @if ($service) {{ $service->meta_description }} @endif
@endsection

@section('content')
  <!-- Page Header Section -->
  <section class="page-header"
           @if(!empty($bgImg->breadcrumb))
             style="background-image: url('{{ asset('assets/img/' . $bgImg->breadcrumb) }}')"
           @endif>
    <div class="container">
      <div class="header-content">
        <h1>{{ $title ?? '' }}</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">
              {{ !empty($pageHeading) ? $pageHeading->service_page_title : __('Service Details') }}
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </section>

  <!-- Service Details Section -->
  <section class="service-details-section">
    <div class="container">
      <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
          <!-- Service Gallery -->
          <div class="service-gallery">
            <div class="gallery-main">
              <div class="swiper gallery-slider">
                <div class="swiper-wrapper">
                  @foreach($details->sliderImage as $item)
                    <div class="swiper-slide">
                      <div class="gallery-item">
                        <a href="{{ asset('assets/img/services/service-gallery/' . $item->image) }}" class="gallery-link">
                          <img class="lazyload"
                               src="{{ asset('assets/frontend/images/placeholder.png') }}"
                               data-src="{{ asset('assets/img/services/service-gallery/' . $item->image) }}"
                               alt="Service image"
                               loading="lazy">
                        </a>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div class="gallery-navigation">
                  <button class="gallery-prev"><i class="fas fa-angle-left"></i></button>
                  <button class="gallery-next"><i class="fas fa-angle-right"></i></button>
                </div>
              </div>
            </div>
            <div class="gallery-thumbs">
              <div class="swiper gallery-thumb-slider">
                <div class="swiper-wrapper">
                  @foreach($details->sliderImage as $item)
                    <div class="swiper-slide">
                      <div class="thumb-item">
                        <img class="lazyload"
                             src="{{ asset('assets/frontend/images/placeholder.png') }}"
                             data-src="{{ asset('assets/img/services/service-gallery/' . $item->image) }}"
                             alt="Service thumbnail"
                             loading="lazy">
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <!-- Service Info -->
          <div class="service-info">
            <div class="row">
              <div class="col-md-8">
                <div class="service-meta">
                  <span class="service-category">
                    <a href="{{ route('frontend.services', ['category_id' => $service->category->id]) }}">
                      {{ @$service->category->name }}
                    </a>
                  </span>
                  <h2 class="service-title">{{ $service->name }}</h2>

                  @if(!empty($service->address))
                    <div class="service-location">
                      <i class="fas fa-map-marker-alt"></i>
                      {{ $service->address }}
                    </div>
                  @endif

                  @if($details->zoom_meeting == 1)
                    <div class="service-online">
                      <i class="fas fa-video"></i>
                      {{ __('Online') }}
                    </div>
                  @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="service-pricing">
                  <div class="current-price">{{ symbolPrice($details->price) }}</div>
                  @if($details->prev_price)
                    <div class="original-price">{{ symbolPrice($details->prev_price) }}</div>
                  @endif
                </div>

                <div class="service-provider">
                  <div class="provider-avatar">
                    @if($details->vendor_id != 0)
                      @if($details->vendor->photo != null)
                        <a href="{{ route('frontend.vendor.details', ['username' => $details->vendor->username]) }}">
                          <img class="lazyload"
                               src="{{ asset('assets/frontend/images/placeholder.png') }}"
                               data-src="{{ asset('assets/admin/img/vendor-photo/' . $details->vendor->photo) }}"
                               alt="{{ $details->vendor->username }}"
                               loading="lazy">
                        </a>
                      @else
                        <a href="{{ route('frontend.vendor.details', ['username' => $details->vendor->username]) }}">
                          <img class="lazyload"
                               src="{{ asset('assets/frontend/images/placeholder.png') }}"
                               data-src="{{ asset('assets/img/user.png') }}"
                               alt="{{ $details->vendor->username }}"
                               loading="lazy">
                        </a>
                      @endif
                    @else
                      <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}">
                        <img class="lazyload"
                             src="{{ asset('assets/frontend/images/placeholder.png') }}"
                             data-src="{{ asset('assets/img/admins/' . $admin->image) }}"
                             alt="{{ $admin->username }}"
                             loading="lazy">
                      </a>
                    @endif
                  </div>
                  <div class="provider-info">
                    <div class="provider-name">
                      {{ __('By') }}
                      @if($details->vendor_id != 0)
                        <a href="{{ route('frontend.vendor.details', ['username' => $details->vendor->username]) }}">
                          {{ $details->vendor->username }}
                        </a>
                      @else
                        <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}">
                          {{ $admin->username }}
                        </a>
                      @endif
                    </div>
                    <div class="provider-rating">
                      <div class="rating-stars">
                        <div class="rating-background"></div>
                        <div class="rating-foreground" style="width: {{ $details->average_rating * 20 }}%"></div>
                      </div>
                      <span class="rating-count">
                        @if($details->average_rating > 0)
                          {{ $details->average_rating }} {{ __('Ratings') }}
                        @else
                          (0 {{ __('Rating') }})
                        @endif
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Service Description -->
          <div class="service-description">
            <h3>{{ __('Service Description') }}</h3>
            <div class="description-content">
              {!! $service->description !!}
            </div>
          </div>

          <!-- Service Features -->
          @if($service->features != null)
            <div class="service-features">
              <h3>{{ __('Service Features') }}</h3>
              <ul class="features-list">
                @foreach(explode("\n", $service->features) as $feature)
                  <li class="feature-item">
                    <i class="fas fa-check-square"></i>
                    <span>{{ trim($feature) }}</span>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Booking CTA -->
          <div class="booking-cta">
            <div class="cta-content">
              <h4>{{ __('Do you want to book this service') }}?</h4>
              <button class="book-now-btn"
                      data-bs-toggle="modal"
                      data-bs-target="#makeBooking"
                      data-id="{{ $details->id }}">
                {{ __('Book Now') }}
              </button>
            </div>
          </div>

          <!-- Related Services -->
          @if(count($related_services) > 0)
            <div class="related-services">
              <h3>
                {{ count($related_services) > 1 ? __('Related Services') : __('Related Service') }}
              </h3>

              <div class="services-slider">
                <div class="swiper related-services-slider">
                  <div class="swiper-wrapper">
                    @foreach($related_services as $related_service)
                      <div class="swiper-slide">

                      </div>
                    @endforeach
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div>
            </div>
          @endif

          <!-- Reviews Section -->
          <div class="service-reviews">
            <div class="reviews-summary">
              <h4>{{ __('Total Reviews') }}: {{ $reviews->count() }}</h4>
              <div class="average-rating">
                <div class="rating-stars">
                  <div class="rating-background"></div>
                  <div class="rating-foreground" style="width: {{ $details->average_rating * 20 }}%"></div>
                </div>
                <span class="average-score">({{ $details->average_rating ?? 0 }})</span>
              </div>
            </div>

            <!-- Rating Breakdown -->
            <div class="rating-breakdown">
              @foreach([5,4,3,2,1] as $rating)
                @php
                  $ratingCount = $reviews->where('rating', $rating)->count();
                  $percentage = $reviews->count() > 0 ? round(($ratingCount / $reviews->count()) * 100) : 0;
                @endphp
                <div class="rating-progress">
                  <span class="rating-label">{{ $rating }} {{ __('Stars') }}</span>
                  <div class="progress-container">
                    <div class="progress-bar" style="width: {{ $percentage }}%"></div>
                  </div>
                </div>
              @endforeach
            </div>

            <!-- Reviews List -->
            @if($reviews->count() == 0)
              <div class="no-reviews">
                <h5>{{ __('This service has no review yet') . '!' }}</h5>
              </div>
            @else
              <div class="reviews-list">
                <h5>{{ __('All Reviews') }}</h5>
                @foreach($reviews as $review)
                  <div class="review-item">
                    <div class="review-header">
                      <div class="reviewer-info">
                        <div class="reviewer-avatar">
                          <img class="lazyload"
                               src="{{ asset('assets/frontend/images/placeholder.png') }}"
                               data-src="{{ $review->user->image ? asset('assets/img/users/' . $review->user->image) : asset('assets/img/user.png') }}"
                               alt="{{ $review->user->name }}"
                               loading="lazy">
                        </div>
                        <div class="reviewer-details">
                          <h6>{{ $review->user->name }}</h6>
                          <div class="review-rating">
                            <div class="rating-stars">
                              <div class="rating-background"></div>
                              <div class="rating-foreground" style="width: {{ $review->rating * 20 }}%"></div>
                            </div>
                            <span class="rating-value">({{ $review->rating }})</span>
                          </div>
                          <div class="reviewer-verified">
                            <i class="fas fa-badge-check"></i>
                            {{ __('Verified User') }}
                          </div>
                        </div>
                      </div>
                      <div class="review-meta">
                        <div class="review-location">
                          <i class="fas fa-map-marker-alt"></i>
                          {{ $review->user->address }}, {{ $review->user->country }}
                        </div>
                        <div class="review-date">
                          <i class="fas fa-clock"></i>
                          {{ $review->created_at->diffForHumans() }}
                        </div>
                      </div>
                    </div>
                    <div class="review-content">
                      {{ $review->comment }}
                    </div>
                  </div>
                @endforeach
              </div>
            @endif

            <!-- Review Form -->
            @guest('web')
              <div class="review-login-cta">
                <a href="{{ route('user.login', ['redirect_path' => 'product-details']) }}" class="login-btn">
                  {{ __('Login to leave a review') }}
                </a>
              </div>
            @endguest

            @auth('web')
              <div class="review-form">
                <h5>{{ __('Add Review') }}</h5>
                <form action="{{ route('frontend.service.rating.store', ['id' => $details->id]) }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <textarea class="form-control" name="comment" placeholder="{{ __('Your review') }}">{{ old('comment') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>{{ __('Rating') }}</label>
                    <div class="star-rating">
                      @for($i = 1; $i <= 5; $i++)
                        <span class="star" data-rating="{{ $i }}"></span>
                      @endfor
                    </div>
                    <input type="hidden" name="rating" id="selected-rating">
                  </div>
                  <input type="hidden" name="vendor_id" value="{{ $details->vendor_id }}">
                  <button type="submit" class="submit-review-btn">{{ __('Submit Review') }}</button>
                </form>
              </div>
            @endauth
          </div>
        </div>

        <!-- Sidebar -->
           @include('frontend.services.details-sidebar')
        
      </div>
    </div>
  </section>
@endsection

@section('scripts')
  <script src="{{ asset('assets/frontend/js/vendors/leaflet.js') }}"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="{{ $authorizeUrl }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize lazy loading
      if ('loading' in HTMLImageElement.prototype) {
        const lazyImages = document.querySelectorAll('img.lazyload');
        lazyImages.forEach(img => {
          img.src = img.dataset.src;
        });
      } else {
        // Fallback to lazysizes
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
        document.body.appendChild(script);
      }

      // Initialize map if coordinates exist
      if (latitude && longitude) {
        initMap(latitude, longitude);
      }

      // Booking and payment variables
      const stripe_key = "{{ $stripe_key }}";
      const authorize_login_key = "{{ $authorize_login_id }}";
      const authorize_public_key = "{{ $authorize_public_key }}";
      const complete = "{{ Session::get('complete') }}";
      const bookingInfo = {!! json_encode(Session::get('paymentInfo')) !!};

      @if(old('gateway') == 'stripe')
        document.getElementById('stripe-element').classList.remove('d-none');
      @endif
    });
  </script>

  <script src="{{ asset('assets/frontend/js/appointment.js') }}"></script>
  <script src="{{ asset('assets/frontend/js/init-map.js') }}"></script>
@endsection
