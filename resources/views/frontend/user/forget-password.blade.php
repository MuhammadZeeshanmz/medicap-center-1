@php
    $version = $basicInfo->theme_version;
@endphp

@extends('frontend.layout')

@section('pageHeading')
    {{ !empty($pageHeading) ? $pageHeading->forget_password_page_title : __('Forget Password') }}
@endsection

@section('metaKeywords')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_keyword_forget_password }}
    @endif
@endsection

@section('metaDescription')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_description_forget_password }}
    @endif
@endsection

@section('content')

    @includeIf('frontend.partials.breadcrumb', [
        'breadcrumb' => $bgImg->breadcrumb,
        'title' => !empty($pageHeading) ? $pageHeading->forget_password_page_title : __('Forget Password'),
    ])

    <!-- Authentication Area Start -->
    <section class="authentication-area ptb-100 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="main-form-wrapper shadow-sm bg-white p-4 rounded">
                        <div class="text-center mb-4">
                            <h3 class="title">
                                {{ !empty($pageHeading) ? $pageHeading->forget_password_page_title : __('Forget Password') }}
                            </h3>
                        </div>

                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ __(Session::get('success')) }}</div>
                        @endif
                        @if (Session::has('warning'))
                            <div class="alert alert-warning">{{ __(Session::get('warning')) }}</div>
                        @endif

                        <form action="{{ route('user.send_forget_password_mail') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email" class="form-label color-dark">{{ __('Email Address') }}<span class="color-red">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="{{ __('Enter your email') }}" required>
                                @error('email')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            @if ($bs->google_recaptcha_status == 1)
                                <div class="form-group mb-3">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary btn-gradient w-100">
                                    {{ __('Send Me a Recovery Link') }}
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <p class="font-sm">
                                {{ __('Remember your password?') }}
                                <a href="{{ route('user.login') }}" class="text-primary fw-bold">{{ __('Login Now') }}</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Authentication Area End -->

@endsection