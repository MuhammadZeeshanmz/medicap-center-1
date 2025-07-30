@php
    $version = $basicInfo->theme_version;
@endphp

@extends('frontend.layout')

@section('pageHeading')
    {{ !empty($pageHeading) ? $pageHeading->pricing_page_title : __('Pricing') }}
@endsection

@section('metaKeywords')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_keyword_pricing }}
    @endif
@endsection

@section('metaDescription')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_description_pricing }}
    @endif
@endsection

@section('content')
    <style>
        .pricing-card {
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
        }

        .pricing-card:hover {
            border-color: var(--bs-primary);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .recommended-card {
            background-color: #3f51b5;
            /* Deep indigo/blue tone */
        }

        .recommended-card:hover {
            background-color: #1919e8ff !important;
        }

        .pricing-card.bg-white:hover {
            background-color: #f9f9f9;
        }

        .pricing-btn {
            transition: all 0.3s ease;
        }

        .pricing-btn:hover {
            background-color: var(--bs-primary);
            color: #fff !important;
        }
    </style>


    @includeIf('frontend.partials.breadcrumb', [
        'breadcrumb' => $bgImg->breadcrumb,
        'title' => !empty($pageHeading) ? $pageHeading->pricing_page_title : __('Pricing'),
    ])

    <!-- Pricing-area Start -->
    <section class="pricing-area pricing-area_v1 pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (!empty($terms) && count($terms) > 0)
                        <div class="section-title title-center mb-50" data-aos="fade-up">
                            {{-- <div class="section-img">
                <img src="{{ asset('assets/img/' . $version . '/section-shape.png') }}" alt="section shape" class="shape hover-scale">
              </div> --}}
                            <h2 class="title mb-30 hover-text-primary">{{ __('Most Affordable Package') }}</h2>
                            <div class="tabs-navigation text-center">
                                <ul class="nav nav-tabs d-inline-flex flex-wrap justify-content-center p-3 radius-md bg-light"
                                    style="gap: 10px;">
                                    @foreach ($terms as $term)
                                        <li class="nav-item">
                                            <button
                                                class="nav-link btn-md radius-sm {{ $loop->iteration == ceil($loop->count / 2) ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#{{ $term }}" type="button">
                                                {{ __($term) }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="tab-content" data-aos="fade-up">
                        @foreach ($terms as $term)
                            @php
                                $packages = \App\Models\Package::where('status', '1')
                                    ->where('term', strtolower($term))
                                    ->orderBy('price', 'asc')
                                    ->get();
                            @endphp
                            <div class="tab-pane fade {{ $loop->iteration == ceil($loop->count / 2) ? 'show active' : '' }}"
                                id="{{ $term }}">
                                <div class="row justify-content-center">
                                    @foreach ($packages as $package)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div
                                                class="card pricing-card shadow-sm h-100 rounded-4 {{ $package->recommended == 1 ? 'recommended-card text-white' : 'bg-white' }}">
                                                <div class="card-body d-flex flex-column align-items-center text-center">
                                                    <div
                                                        class="d-flex align-items-center justify-content-center gap-2 mb-3">
                                                        @if (!empty($package->image) && file_exists(public_path('assets/img/packages/' . $package->image)))
                                                            <img src="{{ asset('assets/img/packages/' . $package->image) }}"
                                                                alt="{{ $package->title }}"
                                                                class="img-fluid package-image hover-rotate"
                                                                style="height: 24px;">
                                                        @else
                                                            <i
                                                                class="fas fa-box {{ $package->recommended == 1 ? 'text-white' : 'text-primary' }}"></i>
                                                        @endif
                                                        <h4 class="fw-bold mb-0">{{ $package->title }}</h4>
                                                        @if ($package->recommended == 1)
                                                            <span
                                                                class="badge bg-white text-danger mb-3">{{ __('Recommended') }}</span>
                                                        @endif
                                                    </div>



                                                    <h5 class="mb-2">
                                                        @if ($package->price == 0)
                                                            {{ __('Free') }}
                                                        @else
                                                            {{ format_price($package->price) }}<small
                                                                class="{{ $package->recommended == 1 ? 'text-light' : 'text-muted' }}">
                                                                / {{ __(str_replace('ly', '', $package->term)) }}</small>
                                                        @endif
                                                    </h5>
                                                    <ul class="list-unstyled text-start w-100 mt-3">
                                                        <li class="mb-2"><i
                                                                class="fas fa-check me-2 text-success"></i>{{ __('Services') }}
                                                            ({{ $package->number_of_service_add === 999999 ? __('Unlimited') : $package->number_of_service_add }})
                                                        </li>
                                                        <li class="mb-2"><i
                                                                class="fas fa-check me-2 text-success"></i>{{ __('Images/Service') }}
                                                            ({{ $package->number_of_service_image === 999999 ? __('Unlimited') : $package->number_of_service_image }})
                                                        </li>
                                                        <li class="mb-2"><i
                                                                class="fas fa-check me-2 text-success"></i>{{ __('Appointments') }}
                                                            ({{ $package->number_of_appointment === 999999 ? __('Unlimited') : $package->number_of_appointment }})
                                                        </li>
                                                        <li class="mb-2"><i
                                                                class="fas fa-check me-2 text-success"></i>{{ __('Staffs') }}
                                                            ({{ $package->staff_limit === 999999 ? __('Unlimited') : $package->staff_limit }})
                                                        </li>
                                                        <li class="mb-2">
                                                            @if ($package->support_ticket_status == 1)
                                                                <i class="fas fa-check me-2 text-success"></i>
                                                            @else
                                                                <i class="fas fa-times me-2 text-danger"></i>
                                                            @endif
                                                            {{ __('Support Tickets') }}
                                                        </li>
                                                        <li class="mb-2">
                                                            @if ($package->zoom_meeting_status == 1)
                                                                <i class="fas fa-check me-2 text-success"></i>
                                                            @else
                                                                <i class="fas fa-times me-2 text-danger"></i>
                                                            @endif
                                                            {{ __('Zoom Meeting') }}
                                                        </li>
                                                        <li class="mb-2">
                                                            @if ($package->calendar_status == 1)
                                                                <i class="fas fa-check me-2 text-success"></i>
                                                            @else
                                                                <i class="fas fa-times me-2 text-danger"></i>
                                                            @endif
                                                            {{ __('Google Calendar') }}
                                                        </li>
                                                        @if (!empty($package->custom_features))
                                                            @php
                                                                $features = array_filter(
                                                                    explode("\n", $package->custom_features),
                                                                );
                                                            @endphp
                                                            @foreach ($features as $value)
                                                                @if (trim($value))
                                                                    <li class="mb-2"><i
                                                                            class="fas fa-check me-2 text-success"></i>{{ trim($value) }}
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                    <div class="mt-auto w-100">
                                                        @if (Auth::guard('vendor')->check())
                                                            <a href="{{ route('vendor.plan.extend.checkout', ['package_id' => $package->id]) }}"
                                                                class="btn pricing-btn {{ $package->recommended == 1 ? 'btn-outline-light' : 'btn-outline-primary' }} w-100 mt-3">{{ __('Extend') }}</a>
                                                        @else
                                                            <a href="{{ route('vendor.login', ['redirectPath' => 'buy_plan', 'buy_package' => $package->id]) }}"
                                                                class="btn pricing-btn {{ $package->recommended == 1 ? 'btn-outline-light' : 'btn-outline-primary' }} w-100 mt-3">{{ __('Purchase') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Pricing-area End -->
@endsection
