@extends('frontend.layout')
@section('pageHeading')
    {{ !empty($pageHeading) ? $pageHeading->signup_page_title : __('Signup') }}
@endsection

@section('metaKeywords')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_keyword_signup }}
    @endif
@endsection

@section('metaDescription')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_description_signup }}
    @endif
@endsection

@section('content')
    @includeIf('frontend.partials.breadcrumb', [
        'breadcrumb' => $bgImg->breadcrumb,
        'title' => !empty($pageHeading) ? $pageHeading->signup_page_title : __('Signup'),
    ])

    <!-- Authentication-area start -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4 d-flex justify-content-center">
                <!-- Signup -->
                <div class="card col-md-6 col-sm-10 col-12 p-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <!-- <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">@include('_partials.macros', ['height' => 20, 'withbg' => 'fill: #fff;'])</span>
                                <span class="app-brand-text demo text-body fw-bold ms-1">{{ config('variables.templateName') }}</span>
                            </a>
                        </div> -->
                        <!-- /Logo -->

                        <h4 class="mb-1 pt-2 text-center">{{ __('Create your account') }} 🚀</h4>
                        <p class="mb-4 text-center">{{ __('Start your journey with us') }}</p>

                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ __(Session::get('success')) }}</div>
                        @endif

                        <form id="authForm" action="{{ route('user.signup_submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="userName" class="form-label">{{ __('Username') }}</label>
                                <input type="text" name="username" id="userName" class="form-control" placeholder="Enter your username" value="{{ old('username') }}" required>
                                @error('username')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                                @error('email')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••••••" required>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                @error('password')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label for="confirmPassword" class="form-label">{{ __('Confirm Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password_confirmation" id="confirmPassword" class="form-control" placeholder="••••••••••••" required>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                @error('password_confirmation')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            @if ($bs->google_recaptcha_status == 1)
                                <div class="form-group mb-3">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                        <p class="text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Signup') }}</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>{{ __('Already have an account?') }}</span>
                            <a href="{{ route('user.login') }}">
                                <span>{{ __('Login Now') }}</span>
                            </a>
                        </p>

                        <div class="divider my-4">
                            <div class="divider-text">or</div>
                        </div>

                        <div class="d-flex justify-content-center">
                            @if ($bs->facebook_login_status == 1)
                                <a class="btn btn-icon btn-label-facebook me-3" href="{{ route('user.login.facebook') }}">
                                    <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                                </a>
                            @endif
                            @if ($bs->google_login_status == 1)
                                <a class="btn btn-icon btn-label-google-plus me-3" href="{{ route('user.login.google') }}">
                                    <i class="tf-icons fa-brands fa-google fs-5"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /Signup -->
            </div>
        </div>
    </div>
    <!-- Authentication-area end -->
@endsection