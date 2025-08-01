{{-- This loads compiled styles handled by vite.config.mjs --}}
<!-- Fonts -->
{{--  --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />



<!-- Icon Fonts -->
@vite([
    'resources/assets/vendor/fonts/tabler-icons.scss',
    //  'resources/assets/vendor/fonts/fontawesome.scss',
    'resources/assets/vendor/fonts/flag-icons.scss',
])

<!-- Core + Theme CSS -->
@vite(['resources/assets/vendor/scss' . $configData['rtlSupport'] . '/core' . ($configData['style'] !== 'light' ? '-' . $configData['style'] : '') . '.scss', 'resources/assets/vendor/scss' . $configData['rtlSupport'] . '/' . $configData['theme'] . ($configData['style'] !== 'light' ? '-' . $configData['style'] : '') . '.scss', 'resources/assets/css/demo.css'])

@vite([
    'resources/assets/css/custome.css',
    // 'resources/css/app.css',
    'resources/css/base.css',
])
<!-- Library Styles -->
@vite(['resources/assets/vendor/libs/node-waves/node-waves.scss', 'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss', 'resources/assets/vendor/libs/typeahead-js/typeahead.scss', 'resources/assets/vendor/scss/pages/front-page.scss'])

<!-- Vendor-Specific CSS -->
{{-- @yield('vendor-style') --}}

<!-- Page-Specific CSS -->
{{-- @yield('page-style') --}}
@yield('style')
