@extends('frontend.layout')

@section('pageHeading')
    {{ !empty($pageHeading) ? $pageHeading->login_page_title : __('Login') }}
@endsection

@section('metaKeywords')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_keyword_login }}
    @endif
@endsection

@section('metaDescription')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_description_login }}
    @endif
@endsection

@section('content')
    @includeIf('frontend.partials.breadcrumb', [
        'breadcrumb' => $bgImg->breadcrumb,
        'title' => !empty($pageHeading) ? $pageHeading->login_page_title : __('Login'),
    ])

    <!-- Authentication-area start -->
    <div class="container-xxl min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row justify-content-center w-100">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <!-- Logo -->
                        <!-- <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">@include('_partials.macros', ['height' => 20, 'withbg' => 'fill: #fff;'])</span>
                                <span class="app-brand-text demo text-body fw-bold ms-1">
                                    {{ config('variables.templateName') }}
                                </span>
                            </a>
                        </div> -->
                        <!-- /Logo -->

                        <!-- <h4 class="mb-1 pt-2 text-center">Welcome to {{ config('variables.templateName') }}! 👋</h4> -->
                        <p class="mb-4 text-center">Please sign-in to your account and start the adventure</p>

                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ __(Session::get('success')) }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ __(Session::get('error')) }}</div>
                        @endif

                        <form id="authForm" action="{{ route('user.login_submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="username"
                                       value="{{ old('username') }}" placeholder="Enter your email or username" autofocus required>
                                @error('username')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="{{ route('user.forget_password') }}">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                           placeholder="••••••••••••" aria-describedby="password" required>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                @error('password')
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
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me">
                                    <label class="form-check-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="{{ route('user.signup') }}">
                                <span>Create an account</span>
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
            </div>
        </div>
    </div>
    <!-- Authentication-area end -->
@endsection