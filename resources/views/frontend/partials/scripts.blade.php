<script>
    'use strict';
    const baseUrl = "{{ url('/') }}";
    const all_model = "{{ __('All') }}";
    const read_more = "{{ __('Read More') }}";
    const read_less = "{{ __('Read Less') }}";
    const show_more = "{{ __('Show More') . '+' }}";
    const show_less = "{{ __('Show Less') . '-' }}";
    const langDir = "{{ $currentLanguageInfo->direction }}";
    var vapid_public_key = "{!! env('VAPID_PUBLIC_KEY') !!}";
    let bookingUnableText =
        "{{ __('We regret to inform you that the service you are trying to book is currently unavailable. Please contact our support team for further assistance') }}";
    
</script>

{{-- Helpers & Config --}}
@vite(['resources/assets/vendor/js/helpers.js'])

@if ($configData['hasCustomizer'])
    @vite(['resources/assets/vendor/js/template-customizer.js'])
@endif

@vite([
    'resources/assets/js/config.js',
    'resources/assets/js/front-config.js', // Only include if both back & front use same layout
])
{{-- @vite(['resources/js/app.js', 'resources/js/appointment.js', 'resources/js/disqus.js', 'resources/js/init-map.js', 'resources/js/product_checkout.js', 'resources/js/script.js', 'resources/js/service_search.js', 'resources/js/shop.js', 'resources/js/svg-loader.min.js', 'resources/js/tawk-to.js', 'resources/js/toastr.min.js', 'resources/js/vendor-contact.js']) --}}

@if ($configData['hasCustomizer'])
    <script type="module">
        window.templateCustomizer = new TemplateCustomizer({
            cssPath: '',
            themesPath: '',
            defaultStyle: "{{ $configData['styleOpt'] }}",
            defaultShowDropdownOnHover: "{{ $configData['showDropdownOnHover'] ?? '' }}", // for front layout might be missing
            displayCustomizer: "{{ $configData['displayCustomizer'] }}",
            lang: '{{ app()->getLocale() }}',
            pathResolver: function(path) {
                var resolvedPaths = {
                    // Core stylesheets
                    @foreach (['core'] as $name)
                        '{{ $name }}.scss': '{{ Vite::asset('resources/assets/vendor/scss' . $configData['rtlSupport'] . '/' . $name . '.scss') }}',
                        '{{ $name }}-dark.scss': '{{ Vite::asset('resources/assets/vendor/scss' . $configData['rtlSupport'] . '/' . $name . '-dark.scss') }}',
                    @endforeach

                    // Themes
                    @foreach (['default', 'bordered', 'semi-dark'] as $name)
                        'theme-{{ $name }}.scss': '{{ Vite::asset('resources/assets/vendor/scss' . $configData['rtlSupport'] . '/theme-' . $name . '.scss') }}',
                        'theme-{{ $name }}-dark.scss': '{{ Vite::asset('resources/assets/vendor/scss' . $configData['rtlSupport'] . '/theme-' . $name . '-dark.scss') }}',
                    @endforeach
                }
                return resolvedPaths[path] || path;
            },
            'controls': <?php echo json_encode($configData['customizerControls'] ?? ['rtl', 'style']); ?>,
        });
    </script>
@endif

{{-- Vendor JS --}}
@vite(['resources/assets/vendor/libs/jquery/jquery.js', 'resources/assets/vendor/libs/popper/popper.js', 'resources/assets/vendor/js/bootstrap.js', 'resources/assets/vendor/libs/node-waves/node-waves.js', 'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js', 'resources/assets/vendor/libs/hammer/hammer.js', 'resources/assets/vendor/libs/typeahead-js/typeahead.js', 'resources/assets/vendor/js/dropdown-hover.js', 'resources/assets/vendor/js/mega-dropdown.js', 'resources/assets/vendor/js/menu.js'])

// @yield('vendor-script')

// {{-- Theme JS --}}
@vite(['resources/assets/js/main.js', 'resources/assets/js/front-main.js'])

@vite([
    //     'resources/js/appointment.js',
    //     'resources/js/app.js',
    //     'resources/js/disqus.js',
    //     'resources/js/init-map.js',
    //     'resources/js/product_checkout.js',
    //     'resources/js/script.js',
    //     'resources/js/service_search.js',
    //     'resources/js/svg-loadger.js',
    //     'resources/js/tawk.js',
    //     'resources/js/toastr.js',
    //     'resources/js/vendor-contact.js',
    //     'resources/js/vendors/aos.min.js',
    //     'resources/js/vendors/bootstrap.min.js',
    //     'resources/js/vendors/bs-stepper.min.js',
    //     'resources/js/vendors/datatables.min.js',
    //     'resources/js/vendors/daterangepicker.js',
    //     'resources/js/vendors/jquery.counter.min.js',
    //     'resources/js/vendors/jquery.magnific-popup.min.js',
    //     'resources/js/vendors/jquery.min.js',
    //     'resources/js/vendors/jquery.nice-select.min.js',
    //     'resources/js/vendors/jquery.syotimer.min.js',
    //     'resources/js/vendors/lazysizes.min.js',
    //     'resources/js/vendors/leaflet.js',
    //     'resources/js/vendors/moment.min.js',
    //     'resources/js/vendors/mouse-hover-move.js',
    //     'resources/js/vendors/nouislider.min.js',
    //     'resources/js/vendors/parallax.min.js',
    //     'resources/js/vendors/pignose.calendar.full.min.js',
    //     'resources/js/vendors/popper.min.js',
    //     'resources/js/vendors/svg-loader.min.js',
    //     'resources/js/vendors/swiper-bundle.min.js',
    //     'resources/js/vendors/tabs-scroller.js',
    //     'resources/js/vendors/tweenMax.min.js',
])

@yield('script')
@if (session()->has('success'))
    <script>
        "use strict";
        toastr['success']("{{ __(session('success')) }}");
    </script>
@endif

@if (session()->has('error'))
    <script>
        "use strict";
        toastr['error']("{{ __(session('error')) }}");
    </script>
@endif
@if (session()->has('warning'))
    <script>
        "use strict";
        toastr['warning']("{{ __(session('warning')) }}");
    </script>
@endif
