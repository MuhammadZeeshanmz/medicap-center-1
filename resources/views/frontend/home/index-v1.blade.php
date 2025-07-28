@php
$configData = Helper::appClasses();
@endphp
<<<<<<< HEAD
@extends('frontend.layout')

@section('pageHeading')
    {{ __('Home') }}
@endsection
=======

@extends('frontend.layout')
>>>>>>> 15d155151d7c343083218b5175d33a0389d30aac

@section('title', 'Medical Center - Home')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/nouislider/nouislider.scss',
  'resources/assets/vendor/libs/swiper/swiper.scss'
])
@endsection

<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
<style>
  .landing-hero {
    background-color: #f0f7fd;
  }
  .section-title-img {
    height: 15px;
    bottom: -5px;
  }
  .features-icon-box {
    padding: 20px;
    transition: all 0.3s ease;
  }
  .features-icon-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
  .landing-contact .contact-img-box {
    border-radius: 10px;
    overflow: hidden;
  }
  .landing-faq .faq-image {
    max-width: 100%;
    height: auto;
  }
</style>
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/nouislider/nouislider.js',
  'resources/assets/vendor/libs/swiper/swiper.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/front-page-landing.js'])
<script src="https://js.stripe.com/v3/"></script>
<script>
  let stripe_key = "{{ $stripe_key ?? '' }}";
  let authorize_login_key = "{{ $authorize_login_id ?? '' }}";
  let authorize_public_key = "{{ $authorize_public_key ?? '' }}";
  var complete = "{{ Session::get('complete') ?? '' }}";
  var bookingInfo = {!! json_encode(Session::get('paymentInfo') ?? []) !!};
</script>
<script src="{{ asset('assets/frontend/js/appointment.js') }}"></script>
@endsection

@section('content')
<div data-bs-spy="scroll" class="scrollspy-example">
  <!-- Hero: Start -->
  <section id="hero-animation">
    <div id="landingHero" class="section-py landing-hero position-relative">
      <div class="container">
        <div class="hero-text-box text-center">
          <h1 class="text-primary hero-title display-6 fw-bold">
            {{ !empty($sectionContent->hero_section_title) ? $sectionContent->hero_section_title : 'Compassionate Care for Your Health Journey' }}
          </h1>
          <h2 class="hero-sub-title h6 mb-4 pb-1">
            {{ !empty($sectionContent->hero_section_subtitle) ? $sectionContent->hero_section_subtitle : 'State-of-the-art medical services with a personal touch. Because your health matters to us.' }}
          </h2>
          <div class="landing-hero-btn d-inline-block position-relative">
            <a href="#landingContact" class="btn btn-primary btn-lg">Book an Appointment</a>
          </div>
        </div>
        <div id="heroDashboardAnimation" class="hero-animation-img">
          <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
            <img src="{{ !empty($sectionContent->hero_section_background_img) ? asset('assets/img/hero/' . $sectionContent->hero_section_background_img) : asset('assets/img/front-pages/medical/hero-doctor.png') }}" alt="doctor and patient" class="animation-img" />
          </div>
        </div>
      </div>
    </div>
    <div class="landing-hero-blank"></div>
  </section>
  <!-- Hero: End -->

  <!-- Services: Start -->
  <section id="landingFeatures" class="section-py landing-features">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Our Services</span>
      </div>
      <h3 class="text-center mb-1">
        <span class="position-relative fw-bold z-1">Most Popular Categories
          <img src="{{asset('assets/img/front-pages/icons/section-title-icon.png')}}" alt="medical icon" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
        
      </h3>
      <!-- <p class="text-center mb-3 mb-md-5 pb-3">
        We offer a wide range of medical services to meet all your healthcare needs.
      </p> -->
      <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
        @if(count($categories) > 0)
          @foreach($categories as $category)
          <div class="col-lg-4 col-sm-6 text-center features-icon-box">
            <div class="text-center mb-3">
              <i class="{{ $category->icon }} fa-3x" style="color: #{{ $category->background_color }}"></i>
            </div>
            <h5 class="mb-3">{{ $category->name }}</h5>
            <p class="features-icon-description">
              @if ($category->service_count > 1)
                {{ $category->service_count }} services available
              @elseif($category->service_count == 1)
                {{ $category->service_count }} service available
              @else
                Services coming soon
              @endif
            </p>
            <a href="{{ route('frontend.services', ['category' => $category->slug]) }}" class="btn btn-sm btn-outline-primary mt-2">View Services</a>
          </div>
          @endforeach
        @else
          <div class="col-12 text-center">
            <h4>{{ __('NO CATEGORIES FOUND') }}!</h4>
          </div>
        @endif
      </div>
    </div>
  </section>
  <!-- Services: End -->

  <!-- Works-area start -->
@if ($secInfo->work_process_section_status == 1)
<section class="works-area works-1 pt-100 pb-60 bg-img bg-cover"
    data-bg-image="{{ !empty($sectionContent->work_process_background_img) ? asset('assets/img/' . $sectionContent->work_process_background_img) : asset('assets/frontend/images/work-process.png') }}">

    <div class="container">
        <div class="row align-items-center gx-xl-5">
            <!-- Left Content Column -->
            <div class="col-lg-5">
                <div class="content-title mb-40" data-aos="fade-up">
                    <h2 class="title mb-25 color-white">
                        {{ !empty($sectionContent->workprocess_section_title) ? $sectionContent->workprocess_section_title : 'How Our Booking System Works' }}
                    </h2>
                    <p class="color-white">
                        {{ !empty($sectionContent->workprocess_section_subtitle) ? $sectionContent->workprocess_section_subtitle : 'Simple steps to book your appointment with our professional team.' }}
                    </p>

                    @if (!empty($sectionContent->workprocess_section_url))
                    <div class="mt-30">
                        <a href="{{ $sectionContent->workprocess_section_url }}"
                           class="btn btn-lg btn-primary btn-gradient icon-start">
                            <i class="{{ $sectionContent->workprocess_icon }} me-2"></i>
                            {{ $sectionContent->workprocess_section_btn }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Slider Column -->
            <div class="col-lg-7">
                <div class="swiper works-slider mb-40" id="works-slider-1" data-aos="fade-up">
                    <div class="swiper-wrapper">
                        @foreach ($processes as $process)
                        <div class="swiper-slide">
                            <div class="card card-bg-{{ $loop->iteration }} p-30 radius-lg"
                                 style="background-color: #{{ $process->background_color }};
                                        background-image: linear-gradient(-35deg, #{{ $process->background_color }} 0%, #021B79 100%);">
                                <div class="card-icon color-white">
                                    <i class="{{ $process->icon }} fs-1"></i>
                                </div>
                                <div class="line bg-white my-3 rounded-pill" style="height: 3px; width: 40px;"></div>
                                <h4 class="card-title color-white lc-1 mb-15">
                                    {{ $process->title }}
                                </h4>
                                <p class="card-text color-light">
                                    {{ $process->text }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Custom Pagination -->
                    <div class="swiper-pagination position-static mt-30" id="works-slider-1-pagination"></div>

                    <!-- Navigation Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Works-area end -->

<!-- Service-area start - Modern Theme -->
<!-- Service-area start -->
<!-- Service-area start -->
@if ($secInfo->feature_section_status == 1)
<section class="service-area service-1 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title title-inline mb-50" data-aos="fade-up">
                    <h2 class="title">
                        {{ !empty($sectionContent->featured_service_section_title) ? $sectionContent->featured_service_section_title : 'Our Top Featured Services' }}
                    </h2>
                    <!-- Slider navigation buttons -->
                    @if ($featured_services->count() > 4)
                    <div class="slider-navigation">
                        <button type="button" title="Slide prev" class="slider-btn" id="product-slider-1-prev">
                            <i class="fal fa-angle-left"></i>
                        </button>
                        <button type="button" title="Slide next" class="slider-btn" id="product-slider-1-next">
                            <i class="fal fa-angle-right"></i>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-12">
                @if ($featured_services->count() == 0)
                <h4 class="text-center">{{ __('NO SERVICE FOUND') . '!' }}</h4>
                @else
                <!-- Slider main container -->
                <div class="swiper product-slider" id="product-slider-1" data-slides-per-view="4" data-swiper-loop="false" data-aos="fade-up">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        @foreach ($featured_services as $service)
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="product-default border radius-md p-15 mb-25">
                                <figure class="product-img mb-15">
                                    <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}"
                                        title="Image" target="_self" class="lazy-container radius-sm ratio ratio-2-3">
                                        <img class="lazyload" src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                            data-src="{{ asset('assets/img/services/' . $service->service_image) }}" alt="Service">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <div class="d-flex align-items-center justify-content-between gap-2">
                                        <a href="{{ route('frontend.services', ['category_id' => $category->categoryId]) }}">
                                            <span class="tag font-sm">{{ $service->categoryName }}</span>
                                        </a>
                                        @if (Auth::guard('web')->check())
                                            @php
                                                $user_id = Auth::guard('web')->user()->id;
                                                $checkWishList = checkWishList($service->id, $user_id);
                                            @endphp
                                        @else
                                            @php
                                                $checkWishList = false;
                                            @endphp
                                        @endif
                                        <a href="{{ $checkWishList == false ? route('addto.wishlist', $service->id) : route('remove.wishlist', $service->id) }}"
                                            class="btn btn-icon border radius-sm {{ $checkWishList == false ? '' : 'wishlist-active' }}"
                                            data-tooltip="tooltip" data-bs-placement="right"
                                            title="{{ $checkWishList == false ? __('Save to Wishlist') : __('Saved') }}">
                                            <i class="fal fa-heart"></i>
                                        </a>
                                    </div>
                                    <h6 class="product-title mb-0">
                                        <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}"
                                            target="_self" title="{{ $service->name }}">
                                            {{ truncateString($service->name, 60) }}
                                        </a>
                                    </h6>
                                    <input type="hidden" value="{{ $service->language_id }}">
                                    <div class="author mb-10 mt-10">
                                        @if ($service->vendor_id != 0)
                                            @if ($service->vendor->photo != null)
                                                <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                    target="_self" title="{{ $service->vendor->username }}">
                                                    <img class="lazyload blur-up"
                                                        src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                        data-src="{{ asset('assets/admin/img/vendor-photo/' . $service->vendor->photo) }}"
                                                        alt="Image">
                                                </a>
                                            @else
                                                <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                    target="_self" title="{{ $service->vendor->username }}">
                                                    <img class="lazyload" src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                        data-src="{{ asset('assets/img/user.png') }}" alt="Vendor">
                                                </a>
                                            @endif
                                            <span class="font-sm">
                                                {{ __('By') }} <a
                                                    href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                    target="_self"
                                                    title="{{ $service->vendor->username }}">{{ $service->vendor->username }}</a>
                                            </span>
                                        @else
                                            <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}"
                                                target="_self" title="{{ $admin->username }}">
                                                <img class="lazyload" src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                    data-src="{{ asset('assets/img/admins/' . $admin->image) }}" alt="Vendor">
                                            </a>
                                            <span class="font-sm">
                                                {{ __('By') }} <a
                                                    href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}"
                                                    target="_self" title="{{ $admin->username }}">{{ $admin->username }}</a>
                                            </span>
                                        @endif
                                    </div>
                                    @if (!empty($service->address))
                                        <span class="font-sm icon-start"><i
                                                class="fal fa-map-marker-alt"></i>{{ truncateString($service->address, 30) }}</span>
                                    @endif
                                    @if ($service->zoom_meeting == 1)
                                        <span class="font-sm icon-start"><i class="fal fa-video"></i>{{ __('Online') }}</span>
                                    @endif
                                    <div class="d-flex align-items-center justify-content-between gap-2 mt-10">
                                        <div class="product-price">
                                            <span class="h6 new-price">{{ symbolPrice($service->price) }}</span>
                                            <span
                                                class="prev-price font-sm">{{ $service->prev_price ? symbolPrice($service->prev_price) : '' }}</span>
                                        </div>
                                        <a href="javaScript:void(0)" class="bookNowBtn btn btn-sm btn-outline-2"
                                            data-bs-toggle="modal" data-bs-target="#makeBooking" data-id="{{ $service->id }}"
                                            title="Book Now" target="_self">
                                            {{ __('Book Now') }}</a>
                                    </div>
                                </div>
                            </div><!-- product-default -->
                        </div>
                        @endforeach
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination position-static" id="product-slider-1-pagination"></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif
<!-- Service-area end -->

@if (count($after_featured_service) > 0)
    @foreach ($after_featured_service as $cusFeature)
        @if (isset($homecusSec[$cusFeature->id]))
            @if ($homecusSec[$cusFeature->id] == 1)
                @php
                    $cusFeatureContent = App\Models\CustomSectionContent::where('custom_section_id', $cusFeature->id)
                        ->where('language_id', $currentLanguageInfo->id)
                        ->first();
                @endphp
                @include('frontend.home.custom-section', ['data' => $cusFeatureContent])
            @endif
        @endif
    @endforeach
@endif
<!-- Service-area end -->
<!-- 
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
        const serviceSlider = new Swiper('#product-slider-1', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: false,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '#product-slider-1-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '#product-slider-1-next',
                prevEl: '#product-slider-1-prev',
            },
            breakpoints: {
                576: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                992: { slidesPerView: 4 }
            }
        });

        // Tooltip initialization
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Wishlist button handler
        document.querySelectorAll('.wishlist-btn').forEach(button => {
            button.addEventListener('click', function() {
                if (this.classList.contains('active')) {
                    this.classList.remove('active');
                    this.setAttribute('title', 'Save to Wishlist');
                } else {
                    this.classList.add('active');
                    this.setAttribute('title', 'Saved');
                }
                // Update tooltip title
                const tooltip = bootstrap.Tooltip.getInstance(this);
                if (tooltip) {
                    tooltip.setContent({'.tooltip-inner': this.getAttribute('title')});
                }
            });
        });
    });
</script>
@endpush -->
<!-- Action banner start -->
@if ($secInfo->call_to_action_section_status == 1)
<section class="cta-section">
    <div class="container">
        <div class="cta-wrapper radius-md pt-40 px-60 bg-img bg-cover"
             data-bg-image="{{ asset('assets/img/' . @$sectionContent->call_to_action_section_image) }}">
            <div class="row align-items-center gx-xl-5">
                <div class="col-lg-6">
                    <div class="cta-content mb-40" data-aos="fade-up">
                        <h2 class="cta-title color-white mb-25">
                            {{ !empty($sectionContent->call_to_action_section_title) ? $sectionContent->call_to_action_section_title : 'Ready to Get Started?' }}
                        </h2>
                        <p class="color-light">
                            {{ !empty($sectionContent->action_section_text) ? $sectionContent->action_section_text : 'Take the first step towards better healthcare today.' }}
                        </p>
                        @if (!empty($sectionContent->call_to_action_url))
                        <div class="mt-30">
                            <a href="{{ @$sectionContent->call_to_action_url }}"
                               class="btn btn-lg btn-primary btn-gradient icon-start">
                                <i class="{{ @$sectionContent->call_to_action_icon }} me-2"></i>
                                {{ @$sectionContent->call_to_action_section_btn ?: 'Get Started' }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cta-image mb-40" data-aos="fade-left">
                        <img class="lazyload blur-up" 
                             src="{{ asset('assets/frontend/images/placeholder.png') }}"
                             data-src="{{ asset('assets/img/' . @$sectionContent->call_to_action_section_inner_image) }}"
                             alt="Call to Action">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Action banner end -->

<<<<<<< HEAD
                                            .category-area.category-1 .swiper-slide .card:hover .card-title.title-hover{{ $loop->iteration }} {
                                                color: #{{ $category->background_color }};
                                            }
                                        </style>
                                        <a href="{{ route('frontend.services', ['category' => $category->slug]) }}"
                                            target="_self">
                                            <div class="swiper-slide">
                                                <div class="card p-25 border radius-md text-center">
                                                    <div
                                                        class="card-icon icon-bg{{ $loop->iteration }} radius-md mx-auto mb-20">
                                                        <i class="{{ $category->icon }}"></i>
                                                    </div>
                                                    <h4 class="card-title title-hover{{ $loop->iteration }} lc-1 mb-1">
                                                        <a href="{{ route('frontend.services', ['category' => $category->slug]) }}"
                                                            target="_self" title="{{ $category->name }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    </h4>
                                                    <span class="font-sm">
                                                        @if ($category->service_count > 1)
                                                            {{ $category->service_count }}
                                                            {{ __('Services Available') }}
                                                        @elseif($category->service_count == 1)
                                                            {{ $category->service_count }}
                                                            {{ __('Service Available') }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination position-static mt-40" id="category-slider-1-pagination">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Category-area end -->
    @if (count($after_category) > 0)
        @foreach ($after_category as $cusCategory)
            @if (isset($homecusSec[$cusCategory->id]))
                @if ($homecusSec[$cusCategory->id] == 1)
                    @php
                        $cusCategoryContent = App\Models\CustomSectionContent::where(
                            'custom_section_id',
                            $cusCategory->id,
                        )
                            ->where('language_id', $currentLanguageInfo->id)
                            ->first();
                    @endphp
                    @include('frontend.home.custom-section', ['data' => $cusCategoryContent])
                @endif
            @endif
        @endforeach
    @endif
    <!-- Works-area start -->
    @if ($secInfo->work_process_section_status == 1)
        <section class="works-area works-1 pt-100 pb-60 bg-img bg-cover"
            data-bg-image="{{ !empty($sectionContent->work_process_background_img) ? asset('assets/img/' . $sectionContent->work_process_background_img) : asset('assets/frontend/images/work-process.png') }}">

            <div class="container">
                <div class="row align-items-center gx-xl-5">
                    <div class="col-lg-5">
                        <div class="content-title mb-40" data-aos="fade-up">
                            <h2 class="title mb-25 color-white">
                                {{ !empty($sectionContent->workprocess_section_title) ? $sectionContent->workprocess_section_title : 'How appointment Booking System Works' }}
                            </h2>
                            <p class="color-white">
                                {{ !empty($sectionContent->workprocess_section_subtitle) ? $sectionContent->workprocess_section_subtitle : 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind. ' }}
                            </p>
                            @if (!empty($sectionContent->workprocess_section_url))
                                <div class="mt-30">
                                    <a href="{{ @$sectionContent->workprocess_section_url }}"
                                        class="btn btn-lg btn-primary btn-gradient icon-start">
                                        <i class="{{ @$sectionContent->workprocess_icon }}"></i>
                                        {{ @$sectionContent->workprocess_section_btn }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="swiper works-slider mb-40" id="works-slider-1" data-aos="fade-up">
                            <div class="swiper-wrapper">
                                @foreach ($processes as $processe)
                                    <style>
                                        .works-area.works-1 .swiper-slide .card.card-bg{{ $loop->iteration }} {
                                            background-color: #{{ $processe->background_color }};
                                            background-image: linear-gradient(-35deg, #{{ $processe->background_color }} 0%, #021B79 100%);
                                        }
                                    </style>
                                    <div class="swiper-slide">
                                        <div class="card card-bg{{ $loop->iteration }} p-30 radius-lg">
                                            <div class="card-icon color-white">
                                                <i class="{{ $processe->icon }}"></i>
                                            </div>
                                            <div class="line bg-white my-3 rounded-pill"></div>
                                            <h4 class="card-title color-white lc-1 mb-15">
                                                {{ $processe->title }}
                                            </h4>
                                            <p class="card-text color-light">
                                                {{ $processe->text }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination position-static mt-30" id="works-slider-1-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Works-area end -->
    @if (count($after_work_process) > 0)
        @foreach ($after_work_process as $work_process)
            @if (isset($homecusSec[$work_process->id]))
                @if ($homecusSec[$work_process->id] == 1)
                    @php
                        $work_processContent = App\Models\CustomSectionContent::where(
                            'custom_section_id',
                            $work_process->id,
                        )
                            ->where('language_id', $currentLanguageInfo->id)
                            ->first();
                    @endphp
                    @include('frontend.home.custom-section', ['data' => $work_processContent])
                @endif
            @endif
        @endforeach
    @endif
    <!-- Service-area start -->
    @if ($secInfo->feature_section_status == 1)
        <section class="service-area service-1 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title title-inline mb-50" data-aos="fade-up">
                            <h2 class="title">
                                {{ !empty($sectionContent->featured_service_section_title) ? $sectionContent->featured_service_section_title : 'Our Top Featured Services' }}
                            </h2>
                            <!-- Slider navigation buttons -->
                            @if ($featured_services->count() > 4)
                                <div class="slider-navigation">
                                    <button type="button" title="Slide prev" class="slider-btn"
                                        id="product-slider-1-prev">
                                        <i class="fal fa-angle-left"></i>
                                    </button>
                                    <button type="button" title="Slide next" class="slider-btn"
                                        id="product-slider-1-next">
                                        <i class="fal fa-angle-right"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        @if ($featured_services->count() == 0)
                            <h4 class="text-center">{{ __('NO SERVICE FOUND') . '!' }}</h4>
                        @else
                            <!-- Slider main container -->
                            <div class="swiper product-slider" id="product-slider-1" data-slides-per-view="4"
                                data-swiper-loop="false" data-aos="fade-up">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    @foreach ($featured_services as $service)
                                        <!-- Slides -->
                                        <div class="swiper-slide">
                                            <div class="product-default border radius-md p-15 mb-25">
                                                <figure class="product-img mb-15">
                                                    <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}"
                                                        title="Image" target="_self"
                                                        class="lazy-container radius-sm ratio ratio-2-3">
                                                        <img class="lazyload"
                                                            src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                            data-src="{{ asset('assets/img/services/' . $service->service_image) }}"
                                                            alt="Service">
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <div class="d-flex align-items-center justify-content-between gap-2">
                                                        <a
                                                            href="{{ route('frontend.services', ['category_id' => $category->categoryId]) }}">
                                                            <span class="tag font-sm">{{ $service->categoryName }}</span>
                                                        </a>
                                                        @if (Auth::guard('web')->check())
                                                            @php
                                                                $user_id = Auth::guard('web')->user()->id;
                                                                $checkWishList = checkWishList($service->id, $user_id);
                                                            @endphp
                                                        @else
                                                            @php
                                                                $checkWishList = false;
                                                            @endphp
                                                        @endif
                                                        <a href="{{ $checkWishList == false ? route('addto.wishlist', $service->id) : route('remove.wishlist', $service->id) }}"
                                                            class="btn btn-icon border radius-sm {{ $checkWishList == false ? '' : 'wishlist-active' }}"
                                                            data-tooltip="tooltip" data-bs-placement="right"
                                                            title="{{ $checkWishList == false ? __('Save to Wishlist') : __('Saved') }}">
                                                            <i class="fal fa-heart"></i>
                                                        </a>

                                                    </div>
                                                    <h6 class="product-title mb-0">
                                                        <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}"
                                                            target="_self" title="{{ $service->name }}">
                                                            {{ truncateString($service->name, 60) }}
                                                        </a>
                                                    </h6>
                                                    <input type="hidden" value="{{ $service->language_id }}">
                                                    <div class="author mb-10 mt-10">
                                                        @if ($service->vendor_id != 0)
                                                            @if ($service->vendor->photo != null)
                                                                <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                    target="_self"
                                                                    title="{{ $service->vendor->username }}">
                                                                    <img class="lazyload blur-up"
                                                                        src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                        data-src="{{ asset('assets/admin/img/vendor-photo/' . $service->vendor->photo) }}"
                                                                        alt="Image">
                                                                </a>
                                                            @else
                                                                <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                    target="_self"
                                                                    title="{{ $service->vendor->username }}">
                                                                    <img class="lazyload"
                                                                        src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                        data-src="{{ asset('assets/img/user.png') }}"
                                                                        alt="Vendor">
                                                                </a>
                                                            @endif
                                                            <span class="font-sm">
                                                                {{ __('By') }} <a
                                                                    href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                    target="_self"
                                                                    title="{{ $service->vendor->username }}">{{ $service->vendor->username }}</a>
                                                            </span>
                                                        @else
                                                            <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}"
                                                                target="_self" title="{{ $admin->username }}">
                                                                <img class="lazyload"
                                                                    src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                    data-src="{{ asset('assets/img/admins/' . $admin->image) }}"
                                                                    alt="Vendor">
                                                            </a>
                                                            <span class="font-sm">
                                                                {{ __('By') }} <a
                                                                    href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}"
                                                                    target="_self"
                                                                    title="{{ $admin->username }}">{{ $admin->username }}</a>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    @if (!empty($service->address))
                                                        <span class="font-sm icon-start"><i
                                                                class="fal fa-map-marker-alt"></i>{{ truncateString($service->address, 30) }}</span>
                                                    @endif
                                                    @if ($service->zoom_meeting == 1)
                                                        <span class="font-sm icon-start"><i
                                                                class="fal fa-video"></i>{{ __('Online') }}</span>
                                                    @endif
                                                    <div
                                                        class="d-flex align-items-center justify-content-between gap-2 mt-10">
                                                        <div class="product-price">
                                                            <span
                                                                class="h6 new-price">{{ symbolPrice($service->price) }}</span>
                                                            <span
                                                                class="prev-price font-sm">{{ $service->prev_price ? symbolPrice($service->prev_price) : '' }}</span>
                                                        </div>
                                                        <a href="javaScript:void(0)"
                                                            class="bookNowBtn btn btn-sm btn-outline-2"
                                                            data-bs-toggle="modal" data-bs-target="#makeBooking"
                                                            data-id="{{ $service->id }}" title="Book Now"
                                                            target="_self">
                                                            {{ __('Book Now') }}</a>
                                                    </div>
                                                </div>
                                            </div><!-- product-default -->
                                        </div>
                                    @endforeach

                                </div>

                                <!-- If we need pagination -->
                                <div class="swiper-pagination position-static" id="product-slider-1-pagination"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Service-area end -->
    @if (count($after_featured_service) > 0)
        @foreach ($after_featured_service as $cusFeature)
            @if (isset($homecusSec[$cusFeature->id]))
                @if ($homecusSec[$cusFeature->id] == 1)
                    @php
                        $cusFeatureContent = App\Models\CustomSectionContent::where(
                            'custom_section_id',
                            $cusFeature->id,
                        )
                            ->where('language_id', $currentLanguageInfo->id)
                            ->first();
                    @endphp
                    @include('frontend.home.custom-section', ['data' => $cusFeatureContent])
                @endif
            @endif
        @endforeach
    @endif
    <!-- Action banner start -->
    @if ($secInfo->call_to_action_section_status == 1)
        <section class="action-banner">
            <div class="container">
                <div class="wrapper radius-md pt-40 px-60 bg-img bg-cover"
                    data-bg-image="{{ asset('assets/img/' . @$sectionContent->call_to_action_section_image) }}">
                    <div class="row align-items-center gx-xl-5">
                        <div class="col-lg-6">
                            <div class="content-title mb-40" data-aos="fade-up">
                                <h2 class="title color-white mb-25">
                                    {{ !empty($sectionContent->call_to_action_section_title) ? $sectionContent->call_to_action_section_title : '' }}
                                </h2>
                                <p class="color-light">
                                    {{ !empty($sectionContent->action_section_text) ? $sectionContent->action_section_text : '' }}
                                </p>
                                @if (!empty($sectionContent->call_to_action_url))
                                    <div class="mt-30">
                                        <a href="{{ @$sectionContent->call_to_action_url }}"
                                            class="btn btn-lg btn-primary btn-gradient icon-start"><i
                                                class="{{ @$sectionContent->call_to_action_icon }}"></i>{{ @$sectionContent->call_to_action_section_btn }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="image mb-40" data-aos="fade-left">
                                <img class="lazyload blur-up" src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                    data-src="{{ asset('assets/img/' . @$sectionContent->call_to_action_section_inner_image) }}"
                                    alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Action banner end -->
    @if (count($after_call_to_action) > 0)
        @foreach ($after_call_to_action as $cusAction)
            @if (isset($homecusSec[$cusAction->id]))
                @if ($homecusSec[$cusAction->id] == 1)
                    @php
                        $cusActionContent = App\Models\CustomSectionContent::where('custom_section_id', $cusAction->id)
                            ->where('language_id', $currentLanguageInfo->id)
                            ->first();
                    @endphp
                    @include('frontend.home.custom-section', ['data' => $cusActionContent])
                @endif
            @endif
        @endforeach
    @endif
    <!-- Service-area start -->
    @if ($secInfo->latest_service_section_status == 1)
        <section class="service-area service-1 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title title-center mb-50" data-aos="fade-up">
                            <h2 class="title mb-20">
                                {{ !empty($sectionContent->latest_service_section_title) ? $sectionContent->latest_service_section_title : 'Most Popular Booking Services We Offer' }}
                            </h2>
                            @if (count($categories) > 0)
                                <div class="tabs-navigation">
                                    <ul class="nav nav-tabs" data-hover="fancyHover">
                                        <li class="nav-item active">
                                            <button class="nav-link hover-effect active btn-md radius-sm"
                                                data-bs-toggle="tab" data-bs-target="#forAll"
                                                type="button">{{ __('All Services') }}</button>
                                        </li>
                                        @foreach ($categories as $category)
                                            <li class="nav-item">
                                                <button class="nav-link hover-effect btn-md radius-sm"
                                                    data-bs-toggle="tab" data-bs-target="#serviceTab{{ $category->id }}"
                                                    type="button">{{ $category->name }}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        @if (count($services) == 0)
                            <h4 class="text-center">{{ __('NO SERVICE FOUND') }}!</h4>
                        @else
                            <div class="tab-content" data-aos="fade-up">
                                <div class="tab-pane fade show active" id="forAll">
                                    <div class="row">
                                        @foreach ($services as $service)
                                            <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up">
                                                <div class="product-default border radius-md p-15 mb-25">
                                                    <figure class="product-img mb-15">
                                                        <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}"
                                                            title="Image" target="_self"
                                                            class="lazy-container radius-sm ratio ratio-2-3">
                                                            <img class="lazyload"
                                                                src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                data-src="{{ asset('assets/img/services/' . $service->service_image) }}"
                                                                alt="Service">
                                                        </a>

                                                    </figure>
                                                    <div class="product-details">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between gap-2">
                                                            <a
                                                                href="{{ route('frontend.services', ['category_id' => $service->categoryId]) }}">
                                                                <span
                                                                    class="tag font-sm">{{ $service->categoryName }}</span>
                                                            </a>
                                                            @if (Auth::guard('web')->check())
                                                                @php
                                                                    $user_id = Auth::guard('web')->user()->id;
                                                                    $checkWishList = checkWishList(
                                                                        $service->id,
                                                                        $user_id,
                                                                    );
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $checkWishList = false;
                                                                @endphp
                                                            @endif
                                                            <a href="{{ $checkWishList == false ? route('addto.wishlist', $service->id) : route('remove.wishlist', $service->id) }}"
                                                                class="btn btn-icon border radius-sm {{ $checkWishList == false ? '' : 'wishlist-active' }}"
                                                                data-tooltip="tooltip" data-bs-placement="right"
                                                                title="{{ $checkWishList == false ? __('Save to Wishlist') : __('Saved') }}">
                                                                <i class="fal fa-heart"></i>
                                                            </a>
                                                        </div>
                                                        <h6 class="product-title mb-0">
                                                            <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}"
                                                                target="_self">
                                                                {{ truncateString($service->name, 60) }}
                                                            </a>
                                                        </h6>
                                                        <input type="hidden" value="{{ $service->language_id }}">
                                                        <div class="author mb-10 mt-10">
                                                            @if ($service->vendor_id != 0)
                                                                @if ($service->vendor->photo != null)
                                                                    <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                        target="_self"
                                                                        title="{{ $service->vendor->username }}">
                                                                        <img class="lazyload blur-up"
                                                                            src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                            data-src="{{ asset('assets/admin/img/vendor-photo/' . $service->vendor->photo) }}"
                                                                            alt="Image">
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                        target="_self"
                                                                        title="{{ $service->vendor->username }}">
                                                                        <img class="lazyload"
                                                                            src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                            data-src="{{ asset('assets/img/user.png') }}"
                                                                            alt="Vendor">
                                                                    </a>
                                                                @endif
                                                                <span class="font-sm">
                                                                    {{ __('By') }} <a
                                                                        href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                        target="_self"
                                                                        title="{{ $service->vendor->username }}">{{ $service->vendor->username }}</a>
                                                                </span>
                                                            @else
                                                                <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}"
                                                                    target="_self" title="{{ $admin->username }}">
                                                                    <img class="lazyload blur-up"
                                                                        src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                        data-src="{{ asset('assets/img/admins/' . $admin->image) }}"
                                                                        alt="Image">
                                                                </a>
                                                                <span class="font-sm">
                                                                    {{ __('By') }} <a
                                                                        href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}"
                                                                        target="_self"
                                                                        title="{{ $admin->username }}">{{ $admin->username }}</a>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        @if (!empty($service->address))
                                                            <span class="font-sm icon-start"><i
                                                                    class="fal fa-map-marker-alt"></i>{{ truncateString($service->address, 30) }}</span>
                                                        @endif
                                                        @if ($service->zoom_meeting == 1)
                                                            <span class="font-sm icon-start"><i
                                                                    class="fal fa-video"></i>{{ __('Online') }}</span>
                                                        @endif
                                                        <div
                                                            class="d-flex align-items-center justify-content-between gap-2 mt-10">
                                                            <div class="product-price">
                                                                <span
                                                                    class="h6 new-price">{{ symbolPrice($service->price) }}</span>
                                                                <span
                                                                    class="prev-price font-sm">{{ $service->prev_price ? symbolPrice($service->prev_price) : '' }}</span>
                                                            </div>
                                                            <a href="javaScript:void(0)"
                                                                class="bookNowBtn btn btn-sm btn-outline-2"
                                                                data-bs-toggle="modal" data-bs-target="#makeBooking"
                                                                data-id="{{ $service->id }}" title="Book Now"
                                                                target="_self">
                                                                {{ __('Book Now') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="cta-btn text-center mt-15">
                                        <a href="{{ route('frontend.services') }}"
                                            class="btn btn-lg btn-primary btn-gradient icon-start" title="View More"
                                            target="_self"><i class="fal fa-arrow-right"></i>{{ __('View More') }}</a>
                                    </div>
                                </div>
                                @foreach ($categories as $category)
                                    @php
                                        $vendorStatus = App\Models\Vendor::where('status', 1)
                                            ->select('id')
                                            ->get()
                                            ->toArray();
                                        $services = App\Models\Services\Services::join(
                                            'service_contents',
                                            'service_contents.service_id',
                                            '=',
                                            'services.id',
                                        )
                                            ->join(
                                                'service_categories',
                                                'service_categories.id',
                                                '=',
                                                'service_contents.category_id',
                                            )
                                            ->where('service_contents.language_id', $language->id)
                                            ->where('service_categories.language_id', $language->id)
                                            ->where('service_contents.category_id', $category->id)
                                            ->where(function ($query) use ($vendorStatus) {
                                                $query
                                                    ->whereIn('services.vendor_id', $vendorStatus)
                                                    ->orWhere('services.vendor_id', 0);
                                            })
                                            ->when('services.vendor_id' != '0', function ($query) {
                                                return $query
                                                    ->leftJoin(
                                                        'memberships',
                                                        'services.vendor_id',
                                                        '=',
                                                        'memberships.vendor_id',
                                                    )
                                                    ->where(function ($query) {
                                                        $query
                                                            ->where([
                                                                ['memberships.status', '=', 1],
                                                                [
                                                                    'memberships.start_date',
                                                                    '<=',
                                                                    now()->format('Y-m-d'),
                                                                ],
                                                                [
                                                                    'memberships.expire_date',
                                                                    '>=',
                                                                    now()->format('Y-m-d'),
                                                                ],
                                                            ])
                                                            ->orWhere('services.vendor_id', '=', 0);
                                                    });
                                            })
                                            ->select(
                                                'services.*',
                                                'service_contents.name',
                                                'service_contents.address',
                                                'service_contents.slug',
                                            )
                                            ->paginate(8);
                                    @endphp
                                    @if (count($services) > 0)
                                        <div class="tab-pane fade" id="serviceTab{{ $category->id }}">
                                            <div class="row">
                                                @foreach ($services as $service)
                                                    <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up">
                                                        <div class="product-default border radius-md p-15 mb-25">
                                                            <figure class="product-img mb-15">
                                                                <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}"
                                                                    title="Image" target="_self"
                                                                    class="lazy-container radius-sm ratio ratio-2-3">
                                                                    <img class="lazyload"
                                                                        src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                        data-src="{{ asset('assets/img/services/' . $service->service_image) }}"
                                                                        alt="Service">
                                                                </a>

                                                            </figure>
                                                            <div class="product-details">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between gap-2">
                                                                    <a
                                                                        href="{{ route('frontend.services', ['category_id' => $category->id]) }}">
                                                                        <span
                                                                            class="tag font-sm">{{ @$category->name }}</span>
                                                                    </a>
                                                                    @if (Auth::guard('web')->check())
                                                                        @php
                                                                            $user_id = Auth::guard('web')->user()->id;
                                                                            $checkWishList = checkWishList(
                                                                                $service->id,
                                                                                $user_id,
                                                                            );
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            $checkWishList = false;
                                                                        @endphp
                                                                    @endif
                                                                    <a href="{{ $checkWishList == false ? route('addto.wishlist', $service->id) : route('remove.wishlist', $service->id) }}"
                                                                        class="btn btn-icon border radius-sm {{ $checkWishList == false ? '' : 'wishlist-active' }}"
                                                                        data-tooltip="tooltip" data-bs-placement="right"
                                                                        title="{{ $checkWishList == false ? __('Save to Wishlist') : __('Saved') }}">
                                                                        <i class="fal fa-heart"></i>
                                                                    </a>
                                                                </div>
                                                                <h6 class="product-title mb-0">
                                                                    <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}"
                                                                        target="_self" title="{{ $service->name }}">
                                                                        {{ truncateString($service->name, 60) }}
                                                                    </a>
                                                                </h6>
                                                                <div class="author mb-10 mt-10">
                                                                    @if ($service->vendor_id != 0)
                                                                        @if ($service->vendor->photo)
                                                                            <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                                target="_self"
                                                                                title="{{ $service->vendor->username }}">
                                                                                <img class="lazyload blur-up"
                                                                                    src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                                    data-src="{{ asset('assets/admin/img/vendor-photo/' . $service->vendor->photo) }}"
                                                                                    alt="Image">
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                                target="_self"
                                                                                title="{{ $service->vendor->username }}">
                                                                                <img class="lazyload"
                                                                                    src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                                    data-src="{{ asset('assets/img/user.png') }}"
                                                                                    alt="Vendor">
                                                                            </a>
                                                                        @endif
                                                                        <span class="font-sm">
                                                                            {{ __('By') }} <a
                                                                                href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                                target="_self"
                                                                                title="{{ $service->vendor->username }}">{{ $service->vendor->username }}</a>
                                                                        </span>
                                                                    @else
                                                                        <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}"
                                                                            target="_self"
                                                                            title="{{ $admin->username }}">
                                                                            <img class="lazyload blur-up"
                                                                                src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                                data-src="{{ asset('assets/img/admins/' . $admin->image) }}"
                                                                                alt="Image">
                                                                        </a>
                                                                        <span class="font-sm">

                                                                            {{ __('By') }} <a
                                                                                href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}"
                                                                                target="_self"
                                                                                title="{{ $admin->username }}">{{ $admin->username }}</a>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                @if (!empty($service->address))
                                                                    <span class="font-sm icon-start"><i
                                                                            class="fal fa-map-marker-alt"></i>{{ truncateString($service->address, 30) }}</span>
                                                                @endif
                                                                @if ($service->zoom_meeting == 1)
                                                                    <span class="font-sm icon-start"><i
                                                                            class="fal fa-video"></i>{{ __('Online') }}</span>
                                                                @endif
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between gap-2 mt-10">
                                                                    <div class="product-price">
                                                                        <span
                                                                            class="h6 new-price">{{ symbolPrice($service->price) }}</span>
                                                                        <span
                                                                            class="prev-price font-sm">{{ $service->prev_price ? symbolPrice($service->prev_price) : '' }}</span>
                                                                    </div>
                                                                    <a href="javaScript:void(0)"
                                                                        class="bookNowBtn btn btn-sm btn-outline-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#makeBooking"
                                                                        data-id="{{ $service->id }}" title="Book Now"
                                                                        target="_self">
                                                                        {{ __('Book Now') }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="cta-btn text-center mt-15">
                                                <a href="{{ route('frontend.services', ['category_id' => $category->id]) }}"
                                                    class="btn btn-lg btn-primary btn-gradient icon-start"
                                                    target="_self"><i
                                                        class="fal fa-arrow-right"></i>{{ __('View More') }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Service-area end -->
    @if (count($after_latest_service) > 0)
        @foreach ($after_latest_service as $cusLatestServie)
            @if (isset($homecusSec[$cusLatestServie->id]))
                @if ($homecusSec[$cusLatestServie->id] == 1)
                    @php
                        $cusLatestServieContent = App\Models\CustomSectionContent::where(
                            'custom_section_id',
                            $cusLatestServie->id,
                        )
                            ->where('language_id', $currentLanguageInfo->id)
                            ->first();
                    @endphp
                    @include('frontend.home.custom-section', ['data' => $cusLatestServieContent])
                @endif
            @endif
        @endforeach
    @endif
    <!-- Shop-area start -->
    @if ($secInfo->vendor_featured_section_status == 1)
        <section class="shop-area shop-1 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title title-inline mb-50" data-aos="fade-up">
                            <h2 class="title">
                                {{ !empty($sectionContent->vendor_section_title) ? $sectionContent->vendor_section_title : 'Our Top Featured Vendor' }}
                            </h2>
                            @if ($vendors > 0)
                                <a href="{{ route('frontend.vendors') }}"
                                    class="btn btn-lg btn-primary btn-gradient icon-start" title="View All Vendor"
                                    target="_self"><i class="fal fa-arrow-right"></i>
                                    @if ($vendors > 1)
                                        {{ __('View All Vendors') }}
                                    @else
                                        {{ __('View All Vendor') }}
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        @if ($featuredVendors->count() == 0)
                            <h4 class="text-center">{{ __('NO VENDOR FOUND') . '!' }}</h4>
                        @else
                            <!-- Slider main container -->
                            <div class="swiper product-slider" id="product-slider-2" data-slides-per-view="4"
                                data-swiper-loop="false" data-aos="fade-up">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    @foreach ($featuredVendors as $vendor)
                                        <div class="swiper-slide">
                                            <div class="product-default border radius-md p-15 mb-25">
                                                <figure class="product-img mb-15">
                                                    <a href="{{ route('frontend.vendor.details', ['username' => $vendor->username]) }}"
                                                        title="Image" target="_self"
                                                        class="lazy-container radius-sm ratio ratio-2-3">
                                                        @if ($vendor->photo)
                                                            <img class="lazyload"
                                                                src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                data-src="{{ asset('assets/admin/img/vendor-photo/' . $vendor->photo) }}"
                                                                alt="Vendor">
                                                        @else
                                                            <img class="lazyload"
                                                                src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                data-src="{{ asset('assets/img/user.png') }}"
                                                                alt="Vendor">
                                                        @endif
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    @php
                                                        $vendorInfo = App\Models\VendorInfo::where([
                                                            ['vendor_id', $vendor->vendorId],
                                                            ['language_id', $language->id],
                                                        ])->first();
                                                    @endphp
                                                    <h6 class="product-title mb-0">
                                                        <a href="{{ route('frontend.vendor.details', ['username' => $vendor->username]) }}"
                                                            target="_self" title="{{ $vendor->username }}">
                                                            @if ($vendorInfo->name != null)
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
                                                    <div class="d-flex align-items-center gap-15 mt-10">
                                                        <a href="{{ route('frontend.vendor.details', ['username' => $vendor->username]) }}"
                                                            class="btn btn-sm btn-outline-2"
                                                            title="{{ __('Visit Store') }}"
                                                            target="_self">{{ __('Visit Store') }}</a>
                                                        <span class="font-sm">
                                                            @if ($vendor->total_service > 1)
                                                                {{ $vendor->total_service }}
                                                                {{ __('Services Available') }}
                                                            @elseif($vendor->total_service == 1)
                                                                {{ $vendor->total_service }}
                                                                {{ __('Services Available') }}
                                                            @else
                                                                {{ __('No Service Available') }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- If we need pagination -->
                                <div class="swiper-pagination position-static" id="product-slider-2-pagination"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Shop-area end -->
    @if (count($after_vendor) > 0)
        @foreach ($after_vendor as $cusVendor)
            @if (isset($homecusSec[$cusVendor->id]))
                @if ($homecusSec[$cusVendor->id] == 1)
                    @php
                        $cusVendorContent = App\Models\CustomSectionContent::where('custom_section_id', $cusVendor->id)
                            ->where('language_id', $currentLanguageInfo->id)
                            ->first();
                    @endphp
                    @include('frontend.home.custom-section', ['data' => $cusVendorContent])
                @endif
            @endif
        @endforeach
    @endif
    <!-- Testimonial-area start -->
    @if ($secInfo->testimonial_section_status == 1)
        <section class="testimonial-area testimonial-1 parallax pb-60">
            <div class="container container-lg-fluid">
                <div class="row align-items-center gx-xl-5">
                    <div class="col-lg-6">
                        <div class="fluid-left">
                            <div class="content-title mb-40" data-aos="fade-up">
                                <h2 class="title mb-20">
                                    {{ !empty($sectionContent->testimonial_section_title) ? $sectionContent->testimonial_section_title : 'What Customers Say About Our Booking Systems ' }}
                                </h2>
                                <div class="content-text mb-40">
                                    <p>
                                        {{ !empty($sectionContent->testimonial_section_subtitle) ? $sectionContent->testimonial_section_subtitle : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum omnis natus cumque possimus dicta suscipit enim, aperiam, voluptatum quis deleniti. ' }}
                                    </p>
                                </div>
                            </div>
                            @if (count($testimonials) > 0)
                                <div class="swiper mb-40" id="testimonial-slider-1" data-aos="fade-up">
                                    <div class="swiper-wrapper">
                                        @foreach ($testimonials as $testimonial)
                                            <div class="swiper-slide">
                                                <div class="slider-item radius-md">
                                                    <div class="client gap-20 flex-wrap">
                                                        <div class="client-info d-flex align-items-center">
                                                            <div class="client-img">
                                                                <div class="lazy-container rounded-pill ratio ratio-1-1">
                                                                    <img class="lazyload"
                                                                        src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                        data-src="{{ asset('assets/img/clients/' . $testimonial->image) }}"
                                                                        alt="Person Image">
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <h6 class="name mb-0">{{ $testimonial->name }}</h6>
                                                                <span
                                                                    class="designation font-sm">{{ $testimonial->occupation }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="rating-area flex-column align-items-start">
                                                            <div class="ratings">
                                                                <div class="rate bg-img"
                                                                    data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                                                                    <div class="rating-icon bg-img"
                                                                        data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}"
                                                                        style="width: {{ $testimonial->rating * 20 . '%;' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span class="ratings-total">
                                                                {{ $testimonial->rating }} {{ __('star of') }}
                                                                {{ $total_testimonial }}
                                                                @if ($total_testimonial > 1)
                                                                    {{ __('reviews') }}
                                                                @else
                                                                    {{ __('review') }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="quote">
                                                        <span class="icon"><i class="fal fa-quote-right"></i></span>
                                                        <p class="text font-lg mb-0">
                                                            {{ $testimonial->comment }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination position-static mt-30"
                                        id="testimonial-slider-1-pagination">
                                    </div>
                                </div>
                            @else
                                <h4>{{ __('NO TESTIMONIAL FOUND') }}!</h4>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="image mb-40 parallax-img" data-speed="0.5" data-revert="true">
                            <img class="lazyload blur-up" src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                data-src="{{ asset('assets/img/' . @$sectionContent->testimonial_section_image) }}"
                                alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if (count($after_testimonial) > 0)
        @foreach ($after_testimonial as $cusTest)
            @if (isset($homecusSec[$cusTest->id]))
                @if ($homecusSec[$cusTest->id] == 1)
                    @php
                        $cusTestContent = App\Models\CustomSectionContent::where('custom_section_id', $cusTest->id)
                            ->where('language_id', $currentLanguageInfo->id)
                            ->first();
                    @endphp
                    @include('frontend.home.custom-section', ['data' => $cusTestContent])
                @endif
            @endif
        @endforeach
    @endif
    <!-- Testimonial-area end -->
@endsection
=======
@if (count($after_call_to_action) > 0)
    @foreach ($after_call_to_action as $cusAction)
        @if (isset($homecusSec[$cusAction->id]) && $homecusSec[$cusAction->id] == 1)
            @php
                $cusActionContent = App\Models\CustomSectionContent::where('custom_section_id', $cusAction->id)
                    ->where('language_id', $currentLanguageInfo->id)
                    ->first();
            @endphp
            @include('frontend.home.custom-section', ['data' => $cusActionContent])
        @endif
    @endforeach
@endif
  <!-- Services Listing: Start -->
  @if($secInfo->latest_service_section_status == 1)
  <section id="landingServices" class="section-py bg-body landing-services">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Our Services</span>
      </div>
      <h3 class="text-center mb-1">
        <span class="position-relative fw-bold z-1">Medical
          <img src="{{asset('assets/img/front-pages/icons/section-title-icon.png')}}" alt="medical icon" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
        Services
      </h3>
      <p class="text-center mb-5 pb-3">Explore our comprehensive range of medical services</p>
      
      <div class="row">
        @if(count($services) > 0)
          @foreach($services as $service)
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="avatar avatar-lg">
                    @if($service->vendor_id != 0 && $service->vendor->photo)
                      <img src="{{ asset('assets/admin/img/vendor-photo/' . $service->vendor->photo) }}" alt="Vendor" class="rounded-circle">
                    @else
                      <img src="{{ asset('assets/img/user.png') }}" alt="Vendor" class="rounded-circle">
                    @endif
                  </div>
                  <div class="ms-3">
                    <h5 class="mb-0">{{ $service->name }}</h5>
                    <small class="text-muted">
                      @if($service->vendor_id != 0)
                        By {{ $service->vendor->username }}
                      @else
                        By Admin
                      @endif
                    </small>
                  </div>
                </div>
                <div class="mb-3">
                  @if(!empty($service->address))
                    <span class="badge bg-label-secondary me-2">
                      <i class="fas fa-map-marker-alt me-1"></i> {{ truncateString($service->address, 20) }}
                    </span>
                  @endif
                  @if($service->zoom_meeting == 1)
                    <span class="badge bg-label-success">
                      <i class="fas fa-video me-1"></i> Online
                    </span>
                  @endif
                </div>
                <p class="mb-3">{{ truncateString($service->description, 100) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <h5 class="mb-0 text-primary">{{ symbolPrice($service->price) }}</h5>
                  <button class="bookNowBtn btn btn-sm btn-primary" 
                          data-bs-toggle="modal" 
                          data-bs-target="#makeBooking" 
                          data-id="{{ $service->id }}">
                    Book Now
                  </button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          
          <div class="col-12 text-center mt-4">
            <a href="{{ route('frontend.services') }}" class="btn btn-primary btn-lg">View All Services</a>
          </div>
        @else
          <div class="col-12 text-center">
            <h4>{{ __('NO SERVICES FOUND') }}!</h4>
          </div>
        @endif
      </div>
    </div>
  </section>
  @endif
  <!-- Services Listing: End -->
  <!-- Our doctors: Start -->
  @if($secInfo->vendor_featured_section_status == 1)
  <section id="landingTeam" class="section-py landing-team">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Our Specialists</span>
      </div>
      <h3 class="text-center mb-1">
        <span class="position-relative fw-bold z-1">Meet Our
          <img src="{{asset('assets/img/front-pages/icons/section-title-icon.png')}}" alt="medical icon" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
        Medical Team</h3>
      <p class="text-center mb-md-5 pb-3">Board-certified physicians dedicated to your health and well-being.</p>
      <div class="row gy-5 mt-2">
        @if(count($featuredVendors) > 0)
          @foreach($featuredVendors as $vendor)
          <div class="col-lg-3 col-sm-6">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-primary position-relative team-image-box">
                @if($vendor->photo)
                  <img src="{{ asset('assets/admin/img/vendor-photo/' . $vendor->photo) }}" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="doctor" />
                @else
                  <img src="{{ asset('assets/img/user.png') }}" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="doctor" />
                @endif
              </div>
              <div class="card-body border border-top-0 border-label-primary text-center">
                <h5 class="card-title mb-0">{{ $vendor->username }}</h5>
                <p class="text-muted mb-0">Specialist</p>
                <div class="mt-2">
                  <a href="{{ route('frontend.vendor.details', ['username' => $vendor->username]) }}" class="btn btn-sm btn-outline-primary">View Profile</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        @else
          <div class="col-12 text-center">
            <h4>{{ __('NO VENDORS FOUND') }}!</h4>
          </div>
        @endif
      </div>
    </div>
  </section>
  @endif

  
  <!-- Our doctors: End -->

 

  
<!-- Testimonials: Start -->
  @if($secInfo->testimonial_section_status == 1)
  <section id="landingReviews" class="section-py bg-body landing-reviews pb-0">
    <div class="container">
      <div class="row align-items-center gx-0 gy-4 g-lg-5">
        <div class="col-md-6 col-lg-5 col-xl-3">
          <div class="mb-3 pb-1">
            <span class="badge bg-label-primary">Patient Testimonials</span>
          </div>
          <h3 class="mb-1">
            <span class="position-relative fw-bold z-1">What our patients
              <img src="{{asset('assets/img/front-pages/icons/section-title-icon.png')}}" alt="medical icon" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
            </span>
            say
          </h3>
          <p class="mb-3 mb-md-5">
            {{ !empty($sectionContent->testimonial_section_subtitle) ? $sectionContent->testimonial_section_subtitle : 'Hear from our patients about their experiences at our medical center.' }}
          </p>
          <div class="landing-reviews-btns">
            <button id="reviews-previous-btn" class="btn btn-label-primary reviews-btn me-3 scaleX-n1-rtl" type="button">
              <i class="ti ti-chevron-left ti-sm"></i>
            </button>
            <button id="reviews-next-btn" class="btn btn-label-primary reviews-btn scaleX-n1-rtl" type="button">
              <i class="ti ti-chevron-right ti-sm"></i>
            </button>
          </div>
        </div>
        <div class="col-md-6 col-lg-7 col-xl-9">
          <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
            <div class="swiper" id="swiper-reviews">
              <div class="swiper-wrapper">
                @if(count($testimonials) > 0)
                  @foreach($testimonials as $testimonial)
                  <div class="swiper-slide">
                    <div class="card h-100">
                      <div class="card-body text-body d-flex flex-column justify-content-between h-100">
                        <p>
                          "{{ $testimonial->comment }}"
                        </p>
                        <div class="text-warning mb-3">
                          @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="ti ti-star-filled ti-sm"></i>
                          @endfor
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="avatar me-2 avatar-sm">
                            <img src="{{ asset('assets/img/clients/' . $testimonial->image) }}" alt="Avatar" class="rounded-circle" />
                          </div>
                          <div>
                            <h6 class="mb-0">{{ $testimonial->name }}</h6>
                            <p class="small text-muted mb-0">{{ $testimonial->occupation }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                @else
                  <div class="col-12 text-center">
                    <h4>{{ __('NO TESTIMONIALS FOUND') }}!</h4>
                  </div>
                @endif
              </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="m-0" />
 
  </section>
  @endif
  <!-- Testimonials: End -->
   

 
<!--/ Success Modal -->
@endsection

@push('scripts')
<script>
  $(document).ready(function () {
    // Set service ID on modal open
    $('.bookNowBtn').click(function () {
      var serviceId = $(this).data('id');
      $('#service_id').val(serviceId);
    });

    // Restrict past date selection
    $('#date').attr('min', new Date().toISOString().split('T')[0]);

    // Handle form submit
    $('#bookingForm').on('submit', function (e) {
      e.preventDefault();

      let form = $(this);
      let url = form.attr('action');
      let formData = form.serialize();

      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function (response) {
          if (response.success) {
            if (response.payment_required) {
              $('#makeBooking').modal('hide');
              $('#paymentContainer').html(response.payment_html);
              $('#paymentModal').modal('show');
            } else {
              showSuccessModal(response.appointment);
            }
          } else {
            toastr.error(response.message);
          }
        },
        error: function (xhr) {
          let errors = xhr.responseJSON.errors;
          $.each(errors, function (key, value) {
            toastr.error(value[0]);
          });
        }
      });
    });

    function showSuccessModal(appointment) {
      let html = `
        <p><strong>Service:</strong> ${appointment.service_name}</p>
        <p><strong>Date:</strong> ${appointment.date}</p>
        <p><strong>Time:</strong> ${appointment.time}</p>
        <p><strong>Reference:</strong> ${appointment.reference}</p>
      `;

      $('#appointmentDetails').html(html);
      $('#paymentModal').modal('hide');
      $('#successModal').modal('show');

      $('#bookingForm')[0].reset();
    }

    // Global event for payment success
    $(document).on('paymentSuccess', function (event, appointment) {
      showSuccessModal(appointment);
    });
  });
  
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
        const worksSlider = new Swiper('#works-slider-1', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '#works-slider-1-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            }
        });

        // Hover effect
        const cards = document.querySelectorAll('.works-slider .card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
                this.style.transition = 'all 0.3s ease';
                this.style.boxShadow = '0 15px 30px rgba(0,0,0,0.2)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });
    });
</script>
@endpush
</script>
@endpush
>>>>>>> 15d155151d7c343083218b5175d33a0389d30aac
