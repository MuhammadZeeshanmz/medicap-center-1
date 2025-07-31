@php
    $version = $basicInfo->theme_version;
@endphp

@extends('frontend.layout')

@section('pageHeading')
    @if (!empty($pageHeading))
        {{ $pageHeading->products_page_title }}
    @endif
@endsection

@section('metaKeywords')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_keyword_products }}
    @endif
@endsection

@section('metaDescription')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_description_products }}
    @endif
@endsection

@section('content')
    @includeIf('frontend.partials.breadcrumb', [
        'breadcrumb' => $bgImg->breadcrumb,
        'title' => !empty($pageHeading) ? $pageHeading->products_page_title : __('Products'),
    ])

    <!-- Shop-area start -->
    <div class="shop-area pt-100 pb-60">
        <div class="container">
            <div class="row gx-xl-5">
                @includeIf('frontend.shop.side-bar')

                <div class="col-lg-8 col-xl-9">
                    <div class="sort-area" data-aos="fade-up">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h5 class="mb-20">
                                    <span class="color-primary">{{ $total_products }}</span>
                                    {{ $total_products > 1 ? __('Products') : __('Product') }}
                                    {{ __('Found') }}
                                </h5>
                            </div>
                            <div class="col-4 d-lg-none">
                                <button class="btn btn-sm btn-outline icon-end radius-sm mb-20" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#widgetOffcanvas"
                                        aria-controls="widgetOffcanvas">
                                    {{ __('Filter') }} <i class="fas fa-filter"></i>
                                </button>
                            </div>
                            <div class="col-8 col-lg-6">
                                <ul class="sort-list list-unstyled mb-20">
                                    <li class="item">
                                        <div class="sort-item d-flex align-items-center">
                                            <label class="me-2 font-sm">{{ __('Sort By') }}:</label>
                                            <form action="{{ route('shop.products') }}" method="get" id="SortForm">
                                                @foreach (['category', 'min', 'max'] as $param)
                                                    @if (!empty(request()->input($param)))
                                                        <input type="hidden" name="{{ $param }}" value="{{ request()->input($param) }}">
                                                    @endif
                                                @endforeach
                                                <select name="sort" class="sort nice-select right color-dark"
                                                        onchange="document.getElementById('SortForm').submit()">
                                                    <option value="newest" {{ request()->input('sort') == 'newest' ? 'selected' : '' }}>
                                                        {{ __('Date : Newest on top') }}
<<<<<<< HEAD
                                                    </option <option
                                                        {{ request()->input('sort') == 'oldest' ? 'selected' : '' }}
                                                        value="oldest">
                                                    {{ __('Date : Oldest on top') }}
                                                    </option>
                                                    <option
                                                        {{ request()->input('sort') == 'high-to-low' ? 'selected' : '' }}
                                                        value="high-to-low">
                                                        {{ __('Price : High to Low') }}
                                                    </option>
                                                    <option
                                                        {{ request()->input('sort') == 'low-to-high' ? 'selected' : '' }}
                                                        value="low-to-high">
=======
                                                    </option>
                                                    <option value="oldest" {{ request()->input('sort') == 'oldest' ? 'selected' : '' }}>
                                                        {{ __('Date : Oldest on top') }}
                                                    </option>
                                                    <option value="high-to-low" {{ request()->input('sort') == 'high-to-low' ? 'selected' : '' }}>
                                                        {{ __('Price : High to Low') }}
                                                    </option>
                                                    <option value="low-to-high" {{ request()->input('sort') == 'low-to-high' ? 'selected' : '' }}>
>>>>>>> 2ebf9ab4b4789e38a3c3bcb5f20410256d09918f
                                                        {{ __('Price : Low to High') }}
                                                    </option>
                                                </select>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-xl-4 col-sm-6" data-aos="fade-up">
                                <div class="product-default shadow-none text-center mb-25">
                                    <figure class="product-img mb-15">
                                        <a href="{{ route('shop.product_details', ['slug' => $product->slug]) }}"
                                           class="lazy-container ratio ratio-1-1">
                                            @if ($product->featured_image && file_exists(public_path('assets/img/products/featured-images/' . $product->featured_image)))
                                                <img class="lazyload"
                                                     src="{{ asset('assets/front/images/placeholder.png') }}"
                                                     data-src="{{ asset('assets/img/products/featured-images/' . $product->featured_image) }}"
                                                     alt="{{ $product->title }}" loading="lazy"
                                                     onerror="this.onerror=null;this.src='{{ asset('assets/front/images/placeholder.png') }}'">
                                            @else
                                                <img class="lazyload"
                                                     src="{{ asset('assets/front/images/placeholder.png') }}"
                                                     data-src="{{ asset('assets/front/images/placeholder.png') }}"
                                                     alt="{{ $product->title }}" loading="lazy">
                                            @endif
                                        </a>
                                        <div class="product-overlay">
                                            <a href="{{ route('shop.product_details', ['slug' => $product->slug]) }}"
                                               target="_self" title="{{ __('View Details') }}" class="icon hover-scale">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('shop.product.add_to_cart', ['id' => $product->id, 'quantity' => 1]) }}"
                                               target="_self" title="{{ __('Add to Cart') }}"
                                               class="icon cart-btn add-to-cart-btn hover-scale">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <div class="ratings d-flex justify-content-center mb-10">
                                            <div class="rate bg-img"
                                                 data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                                                <div class="rating-icon bg-img"
                                                     style="width: {{ $product->average_rating * 20 . '%;' }}"
                                                     data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="product-title mb-2 hover-text-primary">
                                            <a href="{{ route('shop.product_details', ['slug' => $product->slug]) }}">
                                                {{ strlen($product->title) > 50 ? mb_substr($product->title, 0, 50, 'UTF-8') . '...' : $product->title }}
                                            </a>
                                        </h5>
                                        <div class="product-price justify-content-center">
                                            <h6 class="new-price">{{ symbolPrice($product->current_price) }}</h6>
                                            @if (!empty($product->previous_price))
                                                <span class="old-price font-sm">{{ symbolPrice($product->previous_price) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <nav class="pagination-nav mt-20 mb-40 justify-content-center" data-aos="fade-up">
                        <ul class="pagination justify-content-center">
                            {{ $products->appends([
                                'keyword' => request()->input('keyword'),
                                'category' => request()->input('category'),
                                'rating' => request()->input('rating'),
                                'min' => request()->input('min'),
                                'max' => request()->input('max'),
                                'sort' => request()->input('sort'),
                            ])->links() }}
                        </ul>
                    </nav>

                    @if (!empty(showAd(3)))
                        <div class="text-center mb-40">
                            {!! showAd(3) !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Shop-area end -->
@endsection

@section('script')
    <script src="{{ asset('assets/frontend/js/shop.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lazy Load
            if (typeof LazyLoad !== 'undefined') {
                new LazyLoad({
                    elements_selector: ".lazyload",
                    callback_loaded: el => el.classList.add('lazyloaded'),
                    callback_error: el => {
                        if (!el.src.includes('placeholder.png')) {
                            el.src = '{{ asset('assets/front/images/placeholder.png') }}';
                        }
                    }
                });
            }

            // Add to Cart Handler
            document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const url = this.getAttribute('href');
                    fetch(url, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const cartCount = document.querySelector('.cart-count');
                                if (cartCount) cartCount.textContent = data.cartCount;
                                toastr.success(data.message);
                            } else {
                                toastr.error(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            toastr.error('An error occurred');
                        });
                });
            });
        });
    </script>
@endsection

@push('styles')
    <style>
        /* Image Loading */
        .lazy-container {
            display: block;
            position: relative;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .lazyload {
            opacity: 0;
            transition: opacity 0.3s ease;
            width: 100%;
            height: auto;
        }

        .lazyloaded {
            opacity: 1;
        }

        /* Enhanced Product Card Styles */
        .product-default {
            position: relative;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            overflow: hidden;
            border-radius: 12px;
            background-color: #fff;
        }

        .product-default:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        }

        .product-img img {
            transition: transform 0.5s ease;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-default:hover .product-img img {
            transform: scale(1.1);
        }

        .product-overlay {
            position: absolute;
            bottom: -60px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 10px;
            opacity: 0;
            transition: all 0.4s ease;
            backdrop-filter: blur(4px);
            padding: 10px;
        }

        .product-default:hover .product-overlay {
            bottom: 10px;
            opacity: 1;
        }

        .product-overlay .icon {
            color: #fff;
            background-color: var(--primary);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .product-overlay .icon:hover {
            background-color: #222;
            transform: scale(1.1);
        }

        .product-title a {
            color: #212529;
            font-weight: 500;
            font-size: 16px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .product-title a:hover {
            color: var(--primary);
        }

        .rate {
            display: inline-block;
            height: 20px;
            position: relative;
            width: 100px;
        }

        .rating-icon {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background-size: auto 100%;
        }
    </style>
@endpush
