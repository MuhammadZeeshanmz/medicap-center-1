@extends('frontend.layout')

@section('pageHeading')
    {{ !empty($pageHeading) && $pageHeading->vendor_signup_page_title ? $pageHeading->vendor_signup_page_title : __('Signup') }}
@endsection

@section('metaKeywords')
    {{ !empty($seoInfo) ? $seoInfo->meta_keywords_vendor_signup : '' }}
@endsection

@section('metaDescription')
    {{ !empty($seoInfo) ? $seoInfo->meta_description_vendor_signup : '' }}
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
                <div class="card col-md-6 col-sm-10 col-12 p-0" style="width: 40%;">

                    <div class="card-body">


                        <h4 class="mb-1 pt-2 text-center">{{ __('Create your account') }} </h4>
                        <p class="mb-4 text-center">{{ __('Start your journey with us') }}</p>

                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ __(Session::get('success')) }}</div>
                        @endif

                        <form action="{{ route('vendor.signup_submit') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-20">
                                        <label for="userName" class="form-label color-dark">{{ __('Username') }}<span
                                                class="color-red">*</span></label>
                                        <input type="text" name="username" value="{{ old('username') }}" id="userName"
                                            class="form-control" placeholder="{{ __('Username') }}">
                                        @error('username')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-20">
                                        <label for="email" class="form-label color-dark">{{ __('Email') }}<span
                                                class="color-red">*</span></label>
                                        <input type="email" value="{{ old('email') }}" name="email" id="email"
                                            class="form-control" placeholder="{{ __('Email') }}">
                                        @error('email')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-20">
                                        <label for="password" class="form-label color-dark">{{ __('Password') }}<span
                                                class="color-red">*</span></label>
                                        <div class="position-relative">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="{{ __('Password') }}">
                                            <span class="show-password-field">
                                                <i class="show-icon"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-20">
                                        <label for="confirmPassword"
                                            class="form-label color-dark">{{ __('Confirm Password') }}<span
                                                class="color-red">*</span></label>
                                        <div class="position-relative">
                                            <input type="password" name="password_confirmation" id="confirmPassword"
                                                class="form-control" placeholder="{{ __('Confirm Password') }}">
                                            <span class="show-password-field">
                                                <i class="show-icon"></i>
                                            </span>
                                        </div>
                                        @error('password_confirmation')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                @if ($bs->google_recaptcha_status == 1)
                                    <div class="form-group mb-20">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                        @error('g-recaptcha-response')
                                            <p class="mt-1 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center mt-20">
                        <div class="link font-sm">
                            {{ __('Already a member') . '?' }} <a href="{{ route('vendor.login') }}" target="_self"
                                title="Login Now">{{ __('Login Now') }}</a>
                        </div>
                    </div>
                </div>

                <!-- /Signup -->
            </div>
        </div>
        <!-- Authentication-area end -->
    @endsection