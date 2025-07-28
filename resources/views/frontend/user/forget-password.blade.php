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

    <!-- Authentication-area start -->
    <div class="container-xxl min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row justify-content-center" style="width:70%;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <div class="text-center mb-4">
                            <h3 class="title">
                                {{ !empty($pageHeading) ? $pageHeading->forget_password_page_title : __('Forget Password') }}
                            </h3>
                            <p class="mb-0 mt-2">
                                {{ __('Enter your email address and we’ll send you a link to reset your password.') }}</p>
                        </div>

                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ __(Session::get('success')) }}</div>
                        @endif
                        @if (Session::has('warning'))
                            <div class="alert alert-warning">{{ __(Session::get('warning')) }}</div>
                        @endif

                        <form action="{{ route('user.send_forget_password_mail') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="{{ __('Enter your email') }}" required>
                                @error('email')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            @if ($bs->google_recaptcha_status == 1)
                                <div class="form-group mb-3">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                        <p class="mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">
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
    </div>
    <!-- Authentication-area end -->
@endsection
