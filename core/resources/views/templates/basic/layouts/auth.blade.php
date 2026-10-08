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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/templates/payqra') }}/css/styles.css" />


    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('assets/templates/payqra') }}/images/logo/40.png" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/templates/payqra') }}/images/logo/40.png" />

    <title>PayQra</title>
</head>

<body>
    <div class="preload preload-container">
        <div class="logo-img">
            <img src="{{ asset('template/payqra') }}/images/logo/logo.svg" alt="">
        </div>
        <div class="spinner-circle lg success">
            <span class="spinner-circle1 spinner-child"></span>
            <span class="spinner-circle2 spinner-child"></span>
            <span class="spinner-circle3 spinner-child"></span>
            <span class="spinner-circle4 spinner-child"></span>
            <span class="spinner-circle5 spinner-child"></span>
            <span class="spinner-circle6 spinner-child"></span>
            <span class="spinner-circle7 spinner-child"></span>
            <span class="spinner-circle8 spinner-child"></span>
            <span class="spinner-circle9 spinner-child"></span>
        </div>
    </div>
    <!-- /preload -->
    
    <div class="wrap">
        
        @yield('panel')
        
        
    </div>
    @include('partials.notify')

    <script type="text/javascript" src="{{ asset('assets/templates/payqra') }}/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/templates/payqra') }}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/templates/payqra') }}/js/count-down.js"></script>
    <script type="text/javascript" src="{{ asset('assets/templates/payqra') }}/js/main.js"></script>
    
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
