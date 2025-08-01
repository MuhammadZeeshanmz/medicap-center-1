@php
    $version = $basicInfo->theme_version;
@endphp
@extends('frontend.layout')
@section('pageHeading')
    @if (!empty($pageHeading))
        {{ $pageHeading->cart_page_title }}
    @endif
@endsection

@section('content')
    @includeIf('frontend.partials.breadcrumb', [
        'breadcrumb' => $bgImg->breadcrumb,
        'title' => !empty($pageHeading) ? $pageHeading->cart_page_title : __('Cart'),
    ])

    <!-- Cart-area start -->
    <div class="shopping-area cart user-dashboard pt-100 pb-60">
        <div class="container">
            @if (count($productCart) == 0)
                <div class="row text-center">
                    <div class="col">
                        <h3>{{ __('Cart is Empty') . '!' }}</h3>
                    </div>
                </div>
            @else
                <div class="row text-center">
                    <div class="col">
                        <h3 id="cart-message"></h3>
                    </div>
                </div>
                @php
                    $totalItems = count($productCart);
                    $position = $currencyInfo->base_currency_symbol_position;
                    $symbol = $currencyInfo->base_currency_symbol;

                    $totalPrice = 0;

                    foreach ($productCart as $key => $product) {
                        $totalPrice += $product['price'];
                    }

                    $totalPrice = number_format($totalPrice, 2, '.', '');
                @endphp
                <div class="row justify-content-center gx-xl-5" id="cart-table">
                    <div class="col-xl-10">
                        <form action="#">
                            @php
                                $cart_total_qty = 0;
                                $cart_total_price = 0;
                            @endphp
                            <div class="btn-groups justify-content-between mb-20 w-100">
                                <h6>
                                    {{ __('Total Quantity') . ' :' }}
                                    <span id="cart_total_qty">{{ $cart_total_qty }}</span>
                                </h6>
                                <h6>
                                    {{ __('Total Price') . ' :' }}
                                    <span dir="ltr">
                                        {{ $position == 'left' ? $symbol : '' }}
                                        <span id="cart_total_price">{{ $cart_total_price }}</span>
                                        {{ $position == 'right' ? $symbol : '' }}
                                    </span>
                                </h6>
                            </div>
                            <div class="item-list border radius-md mb-30 table-responsive">
                                <table class="shopping-table table table-borderless">
                                    <thead>
                                        <tr class="table-heading">
                                            <th scope="col" colspan="2" class="first">{{ __('Product') }}</th>
                                            <th scope="col">{{ __('Quantity') }}</th>
                                            <th scope="col">{{ __('Stock') }}</th>
                                            <th scope="col">{{ __('Price') }}</th>
                                            <th scope="col">{{ __('Total') }}</th>
                                            <th scope="col" class="last">{{ __('Remove') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productCart as $key => $c_product)
                                            @php
                                                $product = App\Models\Shop\Product::where('id', $key)->first();
                                            @endphp
                                            <input type="hidden" class="product-id" id="{{ 'in-product-id' . $key }}"
                                                value="{{ $key }}">
                                            <tr class="item" id="cart-product-item{{ $key }}">
                                                <td class="product-img">
                                                    <div class="image">
                                                        <a href="{{ route('shop.product_details', ['slug' => @$c_product['slug']]) }}"
                                                            class="lazy-container radius-md ratio ratio-1-1">
                                                            <img class="lazyload"
                                                                src="{{ asset('assets/frontend/images/placeholder.png') }}"
                                                                data-src="{{ asset('assets/img/products/featured-images/' . $product->featured_image) }}"
                                                                alt="Product">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="product-desc">
                                                    <h6>
                                                        <a class="product-title mb-10"
                                                            href="{{ route('shop.product_details', ['slug' => $c_product['slug']]) }}">
                                                            {{ strlen(@$c_product['title']) > 50 ? mb_substr(@$c_product['title'], 0, 50, 'UTF-8') . '...' : @$c_product['title'] }}
                                                        </a>
                                                    </h6>
                                                    <div class="ratings">
                                                        <div class="rate bg-img"
                                                            data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                                                            <div class="rating-icon bg-img"
                                                                style="width: {{ $product->average_rating * 20 . '%;' }}"
                                                                data-bg-image="{{ asset('assets/frontend/images/rate-star.png') }}">
                                                            </div>
                                                        </div>
                                                        <span class="ratings-total">({{ $product->average_rating }})</span>
                                                    </div>
                                                </td>
                <td class="qty">
    <div class="quantity-input d-flex align-items-center">
        <button type="button" class="quantity-down btn btn-outline-secondary px-3">
            <i class="fas fa-minus"></i>
        </button>
        <input type="text" name="quantity" value="{{ $c_product['quantity'] }}" 
               class="product-qty text-center mx-2" style="width: 50px;">
        <button type="button" class="quantity-up btn btn-outline-secondary px-3">
            <i class="fas fa-plus"></i>
        </button>
    </div>
</td>
                                                <td class="product-availability">
                                                    @if ($c_product['type'] == 'digital')
                                                        <span class="badge bg-success">{{ __('Available Now') }}</span>
                                                    @else
                                                        @if ($product->stock >= $c_product['quantity'])
                                                            <span class="badge bg-success">{{ __('In Stock') }}</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ __('Out Of Stock') }}</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="product-price">
                                                    <h6 dir="ltr" class="m-0">
                                                        {{ $position == 'left' ? $symbol : '' }}
                                                        <span
                                                            class="product-unit-price">{{ $product->current_price }}</span>{{ $position == 'right' ? $symbol : '' }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 dir="ltr" class="m-0">
                                                        {{ $position == 'left' ? $symbol : '' }}
                                                        <span
                                                            class="per-product-total">{{ $product->current_price * $c_product['quantity'] }}</span>
                                                        {{ $position == 'right' ? $symbol : '' }}
                                                    </h6>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('shop.cart.remove_product', ['id' => $key]) }}"
                                                        class="btn btn-remove rounded-pill mx-auto remove-product-icon"
                                                        data-product_id="{{ $key }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php
                                                $cart_total_qty += $c_product['quantity'];
                                                $cart_total_price += $product->current_price * $c_product['quantity'];
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="btn-groups justify-content-end w-100 mb-40">
                                <a href="{{ route('shop.update_cart') }}" class="btn btn-md btn-primary"
                                    title="{{ __('Update Cart') }}" id="update-cart-btn">{{ __('Update Cart') }}</a>
                                <a href="{{ route('shop.checkout') }}" class="btn btn-md btn-primary"
                                    title="{{ __('Checkout') }}" target="_self">{{ __('Checkout') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Cart-area end -->
@endsection

@push('styles')
<style>
/* Quantity Input Styling - Horizontal Layout */
.quantity-input {
    display: inline-flex;  /* Changed to inline-flex for better alignment */
    align-items: center;
    flex-direction: row;  /* Explicitly set to row (horizontal) */
    border-radius: 4px;   /* Added for container */
    overflow: hidden;     /* Prevents child elements from breaking border-radius */
}

.quantity-input button {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    border: 1px solid #ddd;
    background: #f8f9fa;
    cursor: pointer;
    margin: 0;           /* Remove any default margins */
    position: relative;   /* Helps with z-index stacking */
}

/* Remove double borders between elements */
.quantity-input button:first-child {
    border-right: none;
    border-radius: 4px 0 0 4px;
}

.quantity-input button:last-child {
    border-left: none;
    border-radius: 0 4px 4px 0;
}

.quantity-input input {
    width: 50px;
    height: 36px;
    text-align: center;
    border: 1px solid #ddd;
    margin: 0;           /* Remove any default margins */
    padding: 0;          /* Remove any default padding */
    -moz-appearance: textfield;
    border-radius: 0;    /* Remove any border radius */
}

/* Remove number input spinners */
.quantity-input input::-webkit-outer-spin-button,
.quantity-input input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Hover and focus states */
.quantity-input button:hover {
    background: #e9ecef;
    z-index: 1;          /* Bring hovered element to front */
}

.quantity-input input:focus {
    outline: none;
    border-color: #aaa;
    z-index: 1;
}
</style>
@endpush

@section('script')
    <script>
        'use strict';
        let cartEmptyTxt = "{{ __('Cart is Empty') . '!' }}";
    </script>
    <script src="{{ asset('assets/frontend/js/shop.js') }}"></script>
    <script>
       document.addEventListener('DOMContentLoaded', function() {
    // Handle quantity changes in cart
    document.querySelectorAll('.quantity-down').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const input = this.nextElementSibling;
            let currentValue = parseInt(input.value);
            if (!isNaN(currentValue) && currentValue > 1) {
                input.value = currentValue - 1;
                updateCartTotals();
            }
        });
    });

    document.querySelectorAll('.quantity-up').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const input = this.previousElementSibling;
            let currentValue = parseInt(input.value);
            if (!isNaN(currentValue)) {
                input.value = currentValue + 1;
                updateCartTotals();
            }
        });
    });

    // Update cart totals when quantities change
    document.querySelectorAll('.product-qty').forEach(input => {
        input.addEventListener('change', function() {
            updateCartTotals();
        });
    });

    function updateCartTotals() {
        let totalQty = 0;
        let totalPrice = 0;
        
        document.querySelectorAll('tr.item').forEach(row => {
            const qty = parseInt(row.querySelector('.product-qty').value);
            const price = parseFloat(row.querySelector('.product-unit-price').textContent);
            
            if (!isNaN(qty) && !isNaN(price)) {
                totalQty += qty;
                totalPrice += qty * price;
                
                // Update per-product total
                row.querySelector('.per-product-total').textContent = (qty * price).toFixed(2);
            }
        });
        
        // Update cart totals
        document.getElementById('cart_total_qty').textContent = totalQty;
        document.getElementById('cart_total_price').textContent = totalPrice.toFixed(2);
    }
});
    </script>
@endsection