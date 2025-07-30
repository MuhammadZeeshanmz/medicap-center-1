<!-- Header-area start -->
<header class="header-area header-1 bg-white @if (!request()->routeIs('index')) header-static @endif" data-aos="fade-down">
    <!-- Start mobile menu -->
    <div class="mobile-menu">
        <div class="container">
            <div class="mobile-menu-wrapper"></div>
        </div>
    </div>
    <!-- End mobile menu -->

    <div class="main-responsive-nav">
        <div class="container">
            <!-- Mobile Logo -->
            <div class="logo">
                @if (!empty($websiteInfo->logo))
                    <a href="{{ route('index') }}" target="_self" title="Superv">
                        <img src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="Brand logo">
                    </a>
                @endif
            </div>
            <!-- Menu toggle button -->
            <button class="menu-toggler" type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <div class="main-navbar">
        <div class="container">
            <!-- Navbar: Start -->
            <nav class="layout-navbar shadow-none py-0">
                <div class="container">
                    <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4">
                        <!-- Menu logo wrapper: Start -->
                        <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                            <!-- Mobile menu toggle: Start-->
                            <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <i class="ti ti-menu-2 ti-sm align-middle"></i>
                            </button>
                            <!-- Mobile menu toggle: End-->
                            <a class="navbar-brand" href="{{ route('index') }}" target="_self">
                                <img src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="Brand Logo">
                            </a>
                        </div>
                        <!-- Menu logo wrapper: End -->
                        <!-- Menu wrapper: Start -->
                        <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                            <button
                                class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                                type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <i class="ti ti-x ti-sm"></i>
                            </button>
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link fw-medium" aria-current="page"
                                        href="{{ url('front-pages/landing') }}#landingHero">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-medium"
                                        href="{{ url('front-pages/landing') }}#landingFeatures">Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-medium"
                                        href="{{ url('front-pages/landing') }}#landingTeam">Team</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-medium"
                                        href="{{ url('front-pages/landing') }}#landingFAQ">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-medium"
                                        href="{{ url('front-pages/landing') }}#landingContact">Contact us</a>
                                </li>
                                <li class="nav-item mega-dropdown  ">
                                    <a href="javascript:void(0);"
                                        class="nav-link dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium"
                                        aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">
                                        <span>Pages</span>
                                    </a>
                                    <div class="dropdown-menu p-4">
                                        <div class="row gy-4">
                                            <div class="col-12 col-lg">
                                                <div class="h6 d-flex align-items-center mb-2 mb-lg-3">
                                                    <div class="avatar avatar-sm flex-shrink-0 me-2">
                                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                                class='ti ti-layout-grid'></i></span>
                                                    </div>
                                                    <span class="ps-1">Other</span>
                                                </div>

                                            </div>
                                            <div class="col-12 col-lg">
                                                <div class="h6 d-flex align-items-center mb-2 mb-lg-3">
                                                    <div class="avatar avatar-sm flex-shrink-0 me-2">
                                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                                class='ti ti-lock-open'></i></span>
                                                    </div>
                                                    <span class="ps-1">Auth Demo</span>
                                                </div>
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link mega-dropdown-link"
                                                            href="{{ url('/auth/login-basic') }}" target="_blank">
                                                            <i class='ti ti-circle me-1'></i>
                                                            Login (Basic)
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link mega-dropdown-link"
                                                            href="{{ url('/auth/login-cover') }}" target="_blank">
                                                            <i class='ti ti-circle me-1'></i>
                                                            Login (Cover)
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link mega-dropdown-link"
                                                            href="{{ url('/auth/register-basic') }}" target="_blank">
                                                            <i class='ti ti-circle me-1'></i>
                                                            Register (Basic)
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link mega-dropdown-link"
                                                            href="{{ url('/auth/register-cover') }}" target="_blank">
                                                            <i class='ti ti-circle me-1'></i>
                                                            Register (Cover)
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link mega-dropdown-link"
                                                            href="{{ url('/auth/register-multisteps') }}"
                                                            target="_blank">
                                                            <i class='ti ti-circle me-1'></i>
                                                            Register (Multi-steps)
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link mega-dropdown-link"
                                                            href="{{ url('/auth/forgot-password-basic') }}"
                                                            target="_blank">
                                                            <i class='ti ti-circle me-1'></i>
                                                            Forgot Password (Basic)
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link mega-dropdown-link"
                                                            href="{{ url('/auth/forgot-password-cover') }}"
                                                            target="_blank">
                                                            <i class='ti ti-circle me-1'></i>
                                                            Forgot Password (Cover)
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link mega-dropdown-link"
                                                            href="{{ url('/auth/reset-password-basic') }}"
                                                            target="_blank">
                                                            <i class='ti ti-circle me-1'></i>
                                                            Reset Password (Basic)
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link mega-dropdown-link"
                                                            href="{{ url('/auth/reset-password-cover') }}"
                                                            target="_blank">
                                                            <i class='ti ti-circle me-1'></i>
                                                            Reset Password (Cover)
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-12 col-lg">
                                                <div class="h6 d-flex align-items-center mb-2 mb-lg-3">
                                                    <div class="avatar avatar-sm flex-shrink-0 me-2">
                                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                                class='ti ti-file-analytics'></i></span>
                                                    </div>
                                                    <span class="ps-1">Other</span>
                                                </div>

                                            </div>
                                            <div class="col-lg-4 d-none d-lg-block">
                                                <div class="bg-body nav-img-col p-2">
                                                    <img src="{{ asset('assets/img/front-pages/misc/nav-item-col-img.png') }}"
                                                        alt="nav item col image" class="w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-medium" href="{{ url('/') }}"
                                        target="_blank">Admin</a>
                                </li>
                            </ul>
                        </div>
                        <div class="landing-menu-overlay d-lg-none"></div>
                        <!-- Menu wrapper: End -->
                        <!-- Toolbar: Start -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            {{-- @if ($configData['hasCustomizer'] == true)
                                <!-- To change the language -->
                                <div class="item">
                                    <div class="language">
                                        <form action="{{ route('change_language') }}" method="GET">
                                            <select class="niceselect" name="lang_code"
                                                onchange="this.form.submit()">
                                                @foreach ($allLanguageInfos as $languageInfo)
                                                    <option value="{{ $languageInfo->code }}"
                                                        {{ $languageInfo->code == $currentLanguageInfo->code ? 'selected' : '' }}>
                                                        {{ $languageInfo->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <!-- / End Language-->
                            @endif --}}
                            <!-- navbar button: Start -->
                            <div class="item">
                                <div class="dropdown">
                                    <button class="btn btn-outline btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        @if (!Auth::guard('web')->check())
                                            {{ __('Customer') }}
                                        @else
                                            {{ Auth::guard('web')->user()->username }}
                                        @endif
                                    </button>
                                    <ul class="dropdown-menu radius-0">
                                        @if (!Auth::guard('web')->check())
                                            <li><a class="dropdown-item"
                                                    href="{{ route('user.login') }}">{{ __('Login') }}</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('user.signup') }}">{{ __('Signup') }}</a></li>
                                        @else
                                            <li><a class="dropdown-item"
                                                    href="{{ route('user.dashboard') }}">{{ __('Dashboard') }}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('user.logout') }}">{{ __('Logout') }}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            {{-- Vendor --}}
                            <div class="item ms-2">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        @if (!Auth::guard('vendor')->check())
                                            {{ __('Vendor') }}
                                        @else
                                            {{ Auth::guard('vendor')->user()->username }}
                                        @endif
                                    </button>
                                    <ul class="dropdown-menu radius-0">
                                        @if (!Auth::guard('vendor')->check())
                                            <li><a class="dropdown-item"
                                                    href="{{ route('vendor.login') }}">{{ __('Login') }}</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('vendor.signup') }}">{{ __('Signup') }}</a></li>
                                        @else
                                            <li><a class="dropdown-item"
                                                    href="{{ route('vendor.dashboard') }}">{{ __('Dashboard') }}</a>
                                            </li>

                                            <li><a class="dropdown-item"
                                                    href="{{ route('vendor.logout') }}">{{ __('Logout') }}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!-- navbar button: End -->
                        </ul>
                        <!-- Toolbar: End -->
                    </div>
                </div>
            </nav>
            <!-- Navbar: End -->
            {{-- <nav class="navbar navbar-expand-lg">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('index') }}" target="_self">
          <img src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="Brand Logo">
        </a>
        <!-- Navigation items -->
        <div class="collapse navbar-collapse">
          @php
            $menuDatas = json_decode($menuInfos);
          @endphp
          <ul id="mainMenu" class="navbar-nav mobile-item mx-auto">
            @foreach ($menuDatas as $menuData)
              @php $href = get_href($menuData) @endphp
              @if (!property_exists($menuData, 'children'))
                <li class="nav-item">
                  <a href="{{ $href }}" class="nav-link toggle">{{ $menuData->text }}</a>
                </li>
              @else
                <li class="nav-item">
                  <a href="{{ $href }}" class="nav-link toggle">{{ $menuData->text }}<i
                      class="fas fa-plus"></i></a>
                  <ul class="menu-dropdown">
                    @php $childMenusDatas = $menuData->children @endphp
                    @foreach ($childMenusDatas as $childMenusData)
                      @php
                        $href = get_href($childMenusData);
                      @endphp
                      <li class="nav-item">
                        <a class="nav-link" href="{{ $href }}">{{ $childMenusData->text }}</a>
                      </li>
                    @endforeach
                  </ul>
                </li>
              @endif
            @endforeach
          </ul>
        </div>
        <div class="more-option mobile-item">
          <div class="item">
            <div class="language">
              <form action="{{ route('change_language') }}" method="GET">
                <select class="niceselect" name="lang_code" onchange="this.form.submit()">
                  @foreach ($allLanguageInfos as $languageInfo)
                    <option value="{{ $languageInfo->code }}"
                      {{ $languageInfo->code == $currentLanguageInfo->code ? 'selected' : '' }}>
                      {{ $languageInfo->name }}
                    </option>
                  @endforeach
                </select>
              </form>
            </div>
          </div>
          <div class="item">
            <div class="dropdown">
              <button class="btn btn-outline btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                @if (!Auth::guard('web')->check())
                  {{ __('Customer') }}
                @else
                  {{ Auth::guard('web')->user()->username }}
                @endif
              </button>
              <ul class="dropdown-menu radius-0">
                @if (!Auth::guard('web')->check())
                  <li><a class="dropdown-item" href="{{ route('user.login') }}">{{ __('Login') }}</a></li>
                  <li><a class="dropdown-item" href="{{ route('user.signup') }}">{{ __('Signup') }}</a></li>
                @else
                  <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">{{ __('Dashboard') }}</a></li>
                  <li><a class="dropdown-item" href="{{ route('user.logout') }}">{{ __('Logout') }}</a></li>
                @endif
              </ul>
            </div>
          </div>
          <div class="item">
            <div class="dropdown">
              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                @if (!Auth::guard('vendor')->check())
                  {{ __('Vendor') }}
                @else
                  {{ Auth::guard('vendor')->user()->username }}
                @endif
              </button>
              <ul class="dropdown-menu radius-0">
                @if (!Auth::guard('vendor')->check())
                  <li><a class="dropdown-item" href="{{ route('vendor.login') }}">{{ __('Login') }}</a></li>
                  <li><a class="dropdown-item" href="{{ route('vendor.signup') }}">{{ __('Signup') }}</a></li>
                @else
                  <li><a class="dropdown-item" href="{{ route('vendor.dashboard') }}">{{ __('Dashboard') }}</a></li>

                  <li><a class="dropdown-item" href="{{ route('vendor.logout') }}">{{ __('Logout') }}</a></li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </nav> --}}
        </div>
    </div>
</header>
<!-- Header-area end -->
