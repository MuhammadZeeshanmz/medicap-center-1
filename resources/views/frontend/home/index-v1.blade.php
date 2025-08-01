@php
    $configData = Helper::appClasses();
@endphp

@extends('frontend.layout')

@section('title', 'Medical Center - Home')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js'])
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
        <section id="hero-animation" class="pt-100 pb-60">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Left Text + Form -->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="hero-text-box">
                            <h1 class="hero-title display-5 fw-bold">
                                {{ !empty($sectionContent->hero_section_title) ? $sectionContent->hero_section_title : 'Find Anything From Nearest Location To Make A Booking' }}
                            </h1>
                            <p class="hero-sub-title fs-5 mt-3 mb-4">
                                {{ !empty($sectionContent->hero_section_subtitle) ? $sectionContent->hero_section_subtitle : 'Link Build is an advanced and modern-looking directory script with rich SEO features where you can create your.' }}
                            </p>

                            <!-- Search Form -->
                            <div class="form-wrapper shadow-md bg-white p-4 rounded-4 mt-4">
                                <form id="homepage_search" action="{{ route('frontend.services') }}" method="get">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-map-marker-alt text-black"></i>
                                                </span>
                                                <input type="text" name="location" id="service_location"
                                                    class="form-control border-start-0"
                                                    placeholder="{{ __('Search By Location') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-clipboard-list text-black"></i>
                                                </span>
                                                <input type="text" name="service_title" id="service_name"
                                                    class="form-control border-start-0"
                                                    placeholder="{{ __('Search Service') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary w-100 py-2">
                                                <i class="fas fa-search me-1"></i> {{ __('Find Now') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="col-lg-6 text-center">
                        <img src="{{ !empty($sectionContent->hero_section_background_img)
                            ? asset('assets/img/hero/' . $sectionContent->hero_section_background_img)
                            : asset('assets/img/front-pages/medical/hero-doctor.png') }}"
                            alt="Booking Illustration" class="img-fluid hero-illustration"
                            style="max-width: 90%; height: auto;">
                    </div>
                </div>
            </div>
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
                        <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="medical icon"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                    </span>
                </h3>

                @if (count($categories) > 0)
                    <div class="swiper services-slider mt-5">
                        <div class="swiper-wrapper">
                            @foreach ($categories as $category)
                                <div class="swiper-slide">
                                    <div class="text-center features-icon-box p-3 border rounded mx-2">
                                        <div class="text-center mb-3">
                                            <i class="{{ $category->icon }} fa-3x"
                                                style="color: #{{ $category->background_color }}"></i>
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
                                        <a href="{{ route('frontend.services', ['category' => $category->slug]) }}"
                                            class="btn btn-sm btn-outline-primary mt-2">View Services</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Swiper Pagination and Arrows -->
                        <!-- <div class="swiper-pagination" style="margin-top: 100px !important;"></div> -->

                    </div>
                @else
                    <div class="col-12 text-center mt-4">
                        <h4>{{ __('NO CATEGORIES FOUND') }}!</h4>
                    </div>
                @endif
            </div>
        </section>
        <!-- Services: End -->

        <!-- Works-area start -->
        @if ($secInfo->work_process_section_status == 1)
            <section class="works-area works-1 pt-100 pb-60 bg-img bg-cover mb-5"
                style="background-image: url('{{ !empty($sectionContent->work_process_background_img) ? asset('assets/img/' . $sectionContent->work_process_background_img) : asset('assets/frontend/images/work-process.png') }}'); padding: 100px 0;">


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
                                                <div class="line bg-white my-3 rounded-pill"
                                                    style="height: 3px; width: 40px;"></div>
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

                                <!-- Pagination -->
                                {{-- <div class="swiper-pagination position-static mt-30" id="works-slider-1-pagination"></div> --}}


                            </div>
                        </div>
                    </div>
                </div>
            </section>

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
                                            <i class="fas fa-angle-left"></i>
                                        </button>
                                        <button type="button" title="Slide next" class="slider-btn"
                                            id="product-slider-1-next">
                                            <i class="fas fa-angle-right"></i>
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
                                                <div class="product-default border radius-md p-15 mb-25"
                                                    style="width:306px;">
                                                    <figure class="product-img mb-15">
                                                        <a href="{{ route('frontend.service.details', ['slug' => $service->slug, 'id' => $service->id]) }}"
                                                            class="d-block overflow-hidden rounded"
                                                            style="height: 200px;">
                                                            <img class="lazyload object-fit-cover w-100 h-100 "
                                                                src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                data-src="{{ asset('assets/img/services/' . $service->service_image) }}"
                                                                alt="Service"
                                                                style="object-fit: cover; width: 100%; height: 100%;">
                                                        </a>
                                                    </figure>

                                                    <div class="product-details p-3">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between gap-2">
                                                            <a
                                                                href="{{ route('frontend.services', ['category_id' => $category->categoryId]) }}">
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
                                                                <i class="fas fa-heart"></i>
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
                                                                            alt="Image" height="50px"
                                                                            style="border-radius: 100%;">
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                        target="_self"
                                                                        title="{{ $service->vendor->username }}">
                                                                        <img class="lazyload"
                                                                            src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                            data-src="{{ asset('assets/img/user.png') }}"
                                                                            alt="Vendor" height="50px"
                                                                            style="border-radius: 100%;">
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
                                                                    <img class="lazyload by-admin"
                                                                        src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                        data-src="{{ asset('assets/img/admins/' . $admin->image) }}"
                                                                        alt="Vendor" height="50px"
                                                                        style="border-radius: 100%;">
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
                                                                    class="fas fa-map-marker-alt"></i>{{ truncateString($service->address, 30) }}</span>
                                                        @endif
                                                        @if ($service->zoom_meeting == 1)
                                                            <span class="font-sm icon-start"><i
                                                                    class="fas fa-video"></i>{{ __('Online') }}</span>
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
                                                                class="bookNowBtn btn btn-sm btn-outline-2 btn-primary"
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
                                    {{-- <div class="swiper-pagination position-static" id="product-slider-1-pagination"></div> --}}
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
            <section class="action-banner" style="margin-top: 100px;">
                <div class="container">
                    <div class="wrapper radius-md pt-40 px-60 bg-img bg-cover"
                        style="background-image: url('{{ asset('assets/img/' . @$sectionContent->call_to_action_section_image) }}'); padding:50px 0px; background-repeat: no-repeat;
">
                        <div class="row align-items-center gx-xl-5">
                            <div class="col-lg-6">
                                <div class="content-title mb-40" data-aos="fade-up" style="padding-left: 100px;">
                                    <h2 class="title color-white mb-25 text-white">
                                        {{ !empty($sectionContent->call_to_action_section_title) ? $sectionContent->call_to_action_section_title : '' }}
                                    </h2>
                                    <p class="color-light text-white">
                                        {{ !empty($sectionContent->action_section_text) ? $sectionContent->action_section_text : '' }}
                                    </p>
                                    @if (!empty($sectionContent->call_to_action_url))
                                        <div class="mt-30">
                                            <a href="{{ @$sectionContent->call_to_action_url }}"
                                                class="btn btn-lg btn-primary btn-gradient icon-start"><i
                                                    class="{{ @$sectionContent->call_to_action_icon }} mb-1 me-2"></i>{{ @$sectionContent->call_to_action_section_btn }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @php
                                $imagePath = !empty($sectionContent->call_to_action_section_inner_image)
                                    ? asset('assets/img/' . $sectionContent->call_to_action_section_inner_image)
                                    : asset('assets/frontend/images/default-image.png');
                            @endphp

                            <div class="col-lg-6">
                                <div class="image mb-40" data-aos="fade-left">
                                    <img class="lazyload by-admin blur-up"
                                        src="{{ asset('assets/frontend/images/line-shape-1.png') }}"
                                        data-src="{{ $imagePath }}" alt="Image" height="450px" width="auto">
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
                            $cusActionContent = App\Models\CustomSectionContent::where(
                                'custom_section_id',
                                $cusAction->id,
                            )
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
                                                        style="color: black;" data-bs-toggle="tab"
                                                        data-bs-target="#serviceTab{{ $category->id }}"
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
                                                                class="d-block overflow-hidden rounded"
                                                                style="height: 200px;">
                                                                <img class="lazyload object-fit-cover w-100 h-100"
                                                                    src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                    data-src="{{ asset('assets/img/services/' . $service->service_image) }}"
                                                                    alt="Service"
                                                                    style="object-fit: cover; width: 100%; height: 100%;">
                                                            </a>
                                                        </figure>
                                                        <div class="product-details p-3">
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
                                                                    <i class="fas fa-heart"></i>
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
                                                                            <img class="lazyload by-admin blur-up"
                                                                                src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                                data-src="{{ asset('assets/admin/img/vendor-photo/' . $service->vendor->photo) }}"
                                                                                alt="Image">
                                                                        </a>
                                                                    @else
                                                                        <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                            target="_self"
                                                                            title="{{ $service->vendor->username }}">
                                                                            <img class="lazyload by-admin"
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
                                                                        <img class="lazyload by-admin blur-up"
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
                                                                        class="fas fa-map-marker-alt"></i>{{ truncateString($service->address, 30) }}</span>
                                                            @endif
                                                            @if ($service->zoom_meeting == 1)
                                                                <span class="font-sm icon-start"><i
                                                                        class="fas fa-video"></i>{{ __('Online') }}</span>
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
                                                                    class="bookNowBtn btn btn-sm btn-outline-2 btn-primary"
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
                                                class="btn btn-lg btn-primary btn-gradient icon-start mt-5"
                                                title="View More" target="_self"><i
                                                    class="fas fa-arrow-right"></i>{{ __('View More') }}</a>
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
                                                                        class="d-block overflow-hidden rounded"
                                                                        style="height: 200px;">
                                                                        <img class="lazyload object-fit-cover w-100 h-100"
                                                                            src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                            data-src="{{ asset('assets/img/services/' . $service->service_image) }}"
                                                                            alt="Service"
                                                                            style="object-fit: cover; width: 100%; height: 100%;">
                                                                    </a>
                                                                </figure>
                                                                <div class="product-details p-3">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between gap-2">
                                                                        <a
                                                                            href="{{ route('frontend.services', ['category_id' => $category->id]) }}">
                                                                            <span
                                                                                class="tag font-sm">{{ @$category->name }}</span>
                                                                        </a>
                                                                        @if (Auth::guard('web')->check())
                                                                            @php
                                                                                $user_id = Auth::guard('web')->user()
                                                                                    ->id;
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
                                                                            data-tooltip="tooltip"
                                                                            data-bs-placement="right"
                                                                            title="{{ $checkWishList == false ? __('Save to Wishlist') : __('Saved') }}">
                                                                            <i class="fas fa-heart"></i>
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
                                                                                    <img class="lazyload by-admin blur-up"
                                                                                        src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                                        data-src="{{ asset('assets/admin/img/vendor-photo/' . $service->vendor->photo) }}"
                                                                                        alt="Image">
                                                                                </a>
                                                                            @else
                                                                                <a href="{{ route('frontend.vendor.details', ['username' => $service->vendor->username]) }}"
                                                                                    target="_self"
                                                                                    title="{{ $service->vendor->username }}">
                                                                                    <img class="lazyload by-admin"
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
                                                                                <img class="lazyload by-admin blur-up"
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
                                                                                class="fas fa-map-marker-alt"></i>{{ truncateString($service->address, 30) }}</span>
                                                                    @endif
                                                                    @if ($service->zoom_meeting == 1)
                                                                        <span class="font-sm icon-start"><i
                                                                                class="fas fa-video"></i>{{ __('Online') }}</span>
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
                                                                            class="bookNowBtn btn btn-sm btn-outline-2 btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#makeBooking"
                                                                            data-id="{{ $service->id }}"
                                                                            title="Book Now" target="_self">
                                                                            {{ __('Book Now') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="cta-btn text-center mt-15">
                                                    <a href="{{ route('frontend.services', ['category_id' => $category->id]) }}"
                                                        class="btn btn-lg btn-primary btn-gradient icon-start mt-5"
                                                        target="_self"><i
                                                            class="fas fa-arrow-right"></i>{{ __('View More') }}</a>
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
                            <div class="section-title title-inline mb-50 d-flex" data-aos="fade-up">
                                <h2 class="title">
                                    {{ !empty($sectionContent->vendor_section_title) ? $sectionContent->vendor_section_title : 'Our Top Featured Vendor' }}
                                </h2>
                                @if ($vendors > 0)
                                    <a href="{{ route('frontend.vendors') }}"
                                        class="btn btn-lg btn-primary btn-gradient icon-start" title="View All Vendor"
                                        target="_self"><i class="fas fa-arrow-right"></i>
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
                                            <div class="swiper-slide" style="width:306px; margin-bottom:50px;">
                                                <div class="swiper-slide" style="width:306px;">
                                                    <div class="product-default border radius-md p-15 mb-25">
                                                        <figure class="product-img mb-15">
                                                            <a href="{{ route('frontend.vendor.details', ['username' => $vendor->username]) }}"
                                                                title="Vendor Image" target="_self"
                                                                class="lazy-container radius-sm ratio ratio-2-3">

                                                                <img class="lazyload"
                                                                    src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                    data-src="{{ $vendor->photo ? asset('assets/admin/img/vendor-photo/' . $vendor->photo) : asset('assets/img/user.png') }}"
                                                                    alt="{{ $vendor->username ?? 'Vendor' }}">

                                                            </a>
                                                        </figure>

                                                        <div class="product-details p-3">
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
                                                                            class="fas fa-map-marker-alt"></i>{{ truncateString($vendorInfo->address, 30) }}</span>
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
                                    {{-- <div class="swiper-pagination position-static" id="product-slider-2-pagination"></div> --}}
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
                            $cusVendorContent = App\Models\CustomSectionContent::where(
                                'custom_section_id',
                                $cusVendor->id,
                            )
                                ->where('language_id', $currentLanguageInfo->id)
                                ->first();
                        @endphp
                        @include('frontend.home.custom-section', ['data' => $cusVendorContent])
                    @endif
                @endif
            @endforeach
        @endif


        <!-- Testimonials: Start -->
        @if ($secInfo->testimonial_section_status == 1)
            <section id="landingReviews" class="section-py landing-reviews pb-0 pb-100">
                <div class="container">
                    <div class="row align-items-center gx-5 gy-4">
                        <!-- Left Column (Text + Slider) -->
                        <div class="col-lg-6">
                            <h2 class="fw-bold mb-3">
                                What Customers Say About <br />
                                <span class="text-primary">Our Booking Systems</span>
                            </h2>
                            <p class="mb-4 text-body">
                                We have 2000+ positive customer reviews
                            </p>

                            <div class="swiper-reviews-carousel overflow-hidden">
                                <div class="swiper" id="swiper-reviews">
                                    <div class="swiper-wrapper">
                                        @if (count($testimonials) > 0)
                                            @foreach ($testimonials as $testimonial)
                                                <div class="swiper-slide">
                                                    <div class="card border-0 shadow-sm p-3 h-100">
                                                        <div
                                                            class="card-body d-flex flex-column justify-content-between h-100">
                                                            <div class="text-body mb-3">
                                                                "{{ $testimonial->comment }}"
                                                            </div>
                                                            <div class="text-warning mb-2">
                                                                @for ($i = 0; $i < $testimonial->rating; $i++)
                                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                                @endfor
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar me-3 avatar-sm">
                                                                    <img src="{{ asset('assets/img/clients/' . $testimonial->image) }}"
                                                                        class="rounded-circle"
                                                                        alt="{{ $testimonial->name }}" />
                                                                </div>
                                                                <div>
                                                                    <h6 class="mb-0 text-body">{{ $testimonial->name }}
                                                                    </h6>
                                                                    <small
                                                                        class="text-muted">{{ $testimonial->occupation }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-12 text-center">
                                                <h4 class="text-muted">{{ __('NO TESTIMONIALS FOUND') }}!</h4>
                                            </div>
                                        @endif
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!-- Right Column (Booking Illustration) -->
                        <div class="col-lg-6 text-center">
                            <img src="{{ !empty($sectionContent->hero_section_background_img)
                                ? asset('assets/img/hero/' . $sectionContent->hero_section_background_img)
                                : asset('assets/img/front-pages/medical/hero-doctor.png') }}"
                                alt="Booking Illustration" class="img-fluid hero-illustration"
                                style="max-width: 90%; height: auto;" />
                        </div>
                    </div>
                </div>
                <hr class="m-0" />
            </section>
        @endif
        <!-- Testimonials: End -->




        <!--/ Success Modal -->
    @endsection

    <style>
        .services-slider,
        .services-slider .swiper-wrapper,
        .services-slider .swiper-slide {
            height: auto !important;
        }
    </style>



    @push('scripts')
        <script>
            $(document).ready(function() {
                // Set service ID on modal open
                $('.bookNowBtn').click(function() {
                    var serviceId = $(this).data('id');
                    $('#service_id').val(serviceId);
                });

                // Restrict past date selection
                $('#date').attr('min', new Date().toISOString().split('T')[0]);

                // Handle form submit
                $('#bookingForm').on('submit', function(e) {
                    e.preventDefault();

                    let form = $(this);
                    let url = form.attr('action');
                    let formData = form.serialize();

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        success: function(response) {
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
                        error: function(xhr) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
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
                $(document).on('paymentSuccess', function(event, appointment) {
                    showSuccessModal(appointment);
                });
            });

            @push('scripts')
                <
                script >
                    document.addEventListener('DOMContentLoaded', function() {
                        // Initialize Swiper
                        const worksSlider = new Swiper('#works-slider-1', {
                            loop: true,
                            slidesPerView: 1,
                            spaceBetween: 30,
                            centeredSlides: true,
                            autoplay: {
                                delay: 5000,
                                disableOnInteraction: fasse,
                            },
                            pagination: {
                                el: '#works-slider-1-pagination',
                                clickable: true,
                                dynamicBullets: true,
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

@section('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ $authorizeUrl }}"></script>
    <script>
        let stripe_key = "{{ $stripe_key }}";
        let authorize_login_key = "{{ $authorize_login_id }}";
        let authorize_public_key = "{{ $authorize_public_key }}";
        var complete = "{{ Session::get('complete') }}";
        var bookingInfo = {!! json_encode(Session::get('paymentInfo')) !!};
    </script>
    @vite(['resources/js/appointment.js'])

    <script>
        @if (old('gateway') == 'stripe')
            $('#stripe-element').removeClass('d-none');
        @endif
    </script>
@endsection

<!-- Swiper Initialization -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper('#works-slider-1', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '#works-slider-1-pagination',
                clickable: true,
            },

            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            breakpoints: {
                576: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 2
                }
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper('.services-slider', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            breakpoints: {
                576: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                }
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('#testimonial-slider-1', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '#testimonial-slider-1-pagination',
                clickable: true,
            },
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
                768: {
                    slidesPerView: 1
                },
                992: {
                    slidesPerView: 1
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const images = document.querySelectorAll('.parallax-img img');
        new simpleParallax(images, {
            scale: 1.1,
            delay: 0.1,
            transition: 'cubic-bezier(0,0,0,1)',
            overflow: true,
        });
    });
</script>


<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
