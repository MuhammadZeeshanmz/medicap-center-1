<!-- Header-area start -->
<header class="header-area header-1 bg-white @if (!request()->routeIs('index')) header-static @endif" data-aos="fade-down">
    <!-- Start mobile menu -->
    <div class="mobile-menu">
        <div class="container">
            <div class="mobile-menu-wrapper"></div>
        </div>
    </div>
    <!-- End mobile menu -->

    <div class="main-responsive-nav d-lg-none">
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
                        <!-- Brand & Toggle Button -->
                        <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                            <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <i class="ti ti-menu-2 ti-sm align-middle"></i>
                            </button>
                            <a class="navbar-brand" href="{{ route('index') }}" target="_self">
                                <img src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="Brand Logo">
                            </a>
                        </div>

                        <!-- Menu wrapper: Start -->
                        <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                            <button
                                class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                                type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <i class="ti ti-x ti-sm"></i>
                            </button>

                            @php $menuDatas = json_decode($menuInfos); @endphp
                            <ul class="navbar-nav me-auto">
                                @foreach ($menuDatas as $menuData)
                                    @php $href = get_href($menuData); @endphp
                                    @if (!property_exists($menuData, 'children'))
                                        <li class="nav-item">
                                            <a href="{{ $href }}"
                                                class="nav-link fw-medium">{{ $menuData->text }}</a>
                                        </li>
                                    @else
                                        <li class="nav-item dropdown">
                                            <a href="{{ $href }}" class="nav-link fw-medium dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                {{ $menuData->text }}
                                            </a>
                                            <ul class="dropdown-menu">
                                                @php $childMenusDatas = $menuData->children; @endphp
                                                @foreach ($childMenusDatas as $childMenusData)
                                                    @php $childHref = get_href($childMenusData); @endphp
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ $childHref }}">{{ $childMenusData->text }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="landing-menu-overlay d-lg-none"></div>
                        <!-- Menu wrapper: End -->

                        <!-- Toolbar: Start -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                  <!-- Language Selector -->
<div class="item dropdown">
  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa fa-globe me-2"></i>
    <span>{{ $currentLanguageInfo->name }}</span>
  </a>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
    @foreach ($allLanguageInfos as $languageInfo)
      <li>
        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('change_language', ['lang_code' => $languageInfo->code]) }}">
          {{ $languageInfo->name }}
          @if ($languageInfo->code == $currentLanguageInfo->code)
            <i class="fas fa-check text-success"></i>
          @endif
        </a>
      </li>
    @endforeach
  </ul>
</div>


                            <!-- Customer Dropdown -->
                            <div class="item ms-2">
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

                            <!-- Vendor Dropdown -->
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
                        </ul>
                        <!-- Toolbar: End -->
                    </div>
                </div>
            </nav>
            <!-- Navbar: End -->
        </div>
    </div>
</header>
<!-- Header-area end -->
 <style>
  #languageDropdown i {
    font-size: 18px;
  }

  .dropdown-menu {
    min-width: 160px;
  }
</style>
