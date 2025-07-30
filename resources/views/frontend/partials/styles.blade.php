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
<<<<<<< HEAD
    // 'resources/css/base.css',
=======
<<<<<<< HEAD
    'resources/css/base.css',
=======
       'resources/css/base.css',
>>>>>>> c0f9421c02b18e7ce0bd8ef04543e319a51d3f25
>>>>>>> 99cdbae7c65aa3db6a5d6c5c45df65ec5649db25
    // 'resources/css/font-awesome.css',
    // 'resources/css/font.css',
    // 'resources/css/inner-pages.css',
    // 'resources/css/responsive.css',
    // 'resources/css/rtl.css',
    // 'resources/css/style.css',
    // 'resources/css/tinymce-content.css',
    // 'resources/css/toastr.min.css',
    //  foooter css
    // 'resources/css/footer/footer.css',
    // header css
    // 'resources/css/header/header.css',
    // vendor css
    // 'resources/css/vendors/bootstrap.min.css',
    // 'resources/css/vendors/animate.min.css',
    // 'resources/css/vendors/aos.min.css',
    // 'resources/css/vendors/bs-stepper.min.css',
    // 'resources/css/vendors/datatables.min.css',
    // 'resources/css/vendors/daterangepicker.css',
    // 'resources/css/vendors/leaflet.css',
    // 'resources/css/vendors/magnific-popup.min.css',
    // 'resources/css/vendors/MarkerCluster.css',
    // 'resources/css/vendors/nice-select.css',
    // 'resources/css/vendors/nouislider.min.css',
    // 'resources/css/vendors/pignose.calendar.min.css',
    // 'resources/css/vendors/swiper-bundle.min.css',
])
<!-- Library Styles -->
@vite(['resources/assets/vendor/libs/node-waves/node-waves.scss', 'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss', 'resources/assets/vendor/libs/typeahead-js/typeahead.scss', 'resources/assets/vendor/scss/pages/front-page.scss'])

<!-- Vendor-Specific CSS -->
{{-- @yield('vendor-style') --}}

<!-- Page-Specific CSS -->
{{-- @yield('page-style') --}}
@yield('style')
