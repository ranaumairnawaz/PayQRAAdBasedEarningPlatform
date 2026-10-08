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
    
    
    <div class="wrap position-relative">
        <div class="bg-rectangle"></div>
            <div class="tf-container position-relative">  
            
            
                <div class="header-v3 d-flex justify-content-between bg-color-bg pt-8 mb-16">
                    <div class="left">
                        <div class="name">
                            <h5 class="text-white fw-3 mt-16 image-select style-default type-currencies bg-color-primary-200">Hi, {{ $user->firstname }}</h5>
                        </div>
                    </div>
                    <div class="right">
                        <a href="#menu-mobile" data-bs-toggle="modal">
                            <i class="icon-category"></i>
                        </a>
                        <a href="#pop-up-notifications" data-bs-toggle="modal">
                            <i class="icon-notification-ringing"></i>
                            <span></span>
                        </a>
                    </div>
                </div>
            
            
                @yield('content')
                
            </div>
            @include($activeTemplate . 'partials.footer_nav')
    </div>

    <script src="{{ asset('assets/templates/payqra') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/count-down.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/carousel.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/multiple-modal.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/init.js"></script>
    <script src="{{ asset('assets/templates/payqra') }}/js/main.js"></script>
    
    @stack('script-lib')


    @php echo loadExtension('tawk-chat') @endphp
    @if (gs('pn'))
        @include('partials.push_script')
    @endif


    @include('partials.notify')

    @if (gs('pn'))
        @include('partials.push_script')
    @endif


    @stack('script')

    <script>
        (function($) {
            "use strict";


            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);



            var inputElements = $('[type=text],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });



            $.each($('input:not([type=checkbox]):not([type=hidden]), select, textarea'), function (i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }

            });

            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });

            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });


            let disableSubmission = false;
            $('.disableSubmission').on('submit', function(e) {
                if (disableSubmission) {
                    e.preventDefault()
                } else {
                    disableSubmission = true;
                }
            });

            
            function formatState(state) {
                if (!state.id) return state.text;
                let gatewayData = $(state.element).data();
                return $(`<div class="d-flex gap-2">${gatewayData.imageSrc ? `<div class="select2-image-wrapper"><img class="select2-image" src="${gatewayData.imageSrc}"></div>` : '' }<div class="select2-content"> <p class="select2-title">${gatewayData.title}</p><p class="select2-subtitle">${gatewayData.subtitle}</p></div></div>`);
            }

            $('.select2').each(function(index,element){
                $(element).select2({
                    templateResult: formatState,
                    minimumResultsForSearch: "-1"
                });
            });

            $('.select2-searchable').each(function(index,element){
                $(element).select2({
                    templateResult: formatState,
                    minimumResultsForSearch: "1"
                });
            });


            $('.select2-basic').each(function(index,element){
                $(element).select2({
                    width:"100%"
                });
            });

        })(jQuery);
    </script>

</body>

</html>
