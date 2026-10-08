<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <!-- font -->
    <link rel="stylesheet" href="{{ asset('assets/templates/payqra') }}/fonts/fonts.css">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/templates/payqra') }}/icons/icomoon/style.css">
    <link rel="stylesheet" href="{{ asset('assets/templates/payqra') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/templates/payqra') }}/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('assets/templates/payqra') }}/css/swiper-bundle.min.css">
    <link rel="manifest" href="{{ asset('assets/templates/payqra') }}/_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/templates/payqra') }}/css/styles.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @include('partials.seo')
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('assets/templates/payqra') }}/images/logo/40.png" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/templates/payqra') }}/images/logo/40.png" />
    @stack('style-lib')
    @stack('style')
    @php echo loadExtension('google-analytics') @endphp
    <title>{{ gs()->siteName(__($pageTitle)) }}</title>
</head>

<body class="bg-4">
    
    @include($activeTemplate . 'partials.preloader')
    @yield('content')    
    
    @include('partials.notify')

    <script src="{{ asset('assets/templates/payqra') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/count-down.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/carousel.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/main.js"></script>
    
    @stack('script')
    @stack('script-lib')
    @if (gs('pn'))
        @include('partials.push_script')
    @endif

</body>
</html>