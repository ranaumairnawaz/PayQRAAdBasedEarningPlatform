@extends($activeTemplate . 'layouts.simple')

{{-- 
    Pushing all necessary CSS to the layout's <head> section 
    to ensure styles for fixed header and ad elements load first. 
--}}
@push('style')
<style>
    /* Header Css End */

    /* Progress Bar */
    #myProgress {
        width: 100%;
        background-color: #ffffff42;
        border-radius: 5px;
        overflow: hidden;
    }

    #myBar {
        width: 10%;
        height: 30px;
        background-color: #001880; /* Base color */
        text-align: center;
        line-height: 30px;
        color: white;
    }

    /* Ad Frame/Body positioning */
    .adFram {
        border: 0;
        position: absolute;
        top: 86px; /* Adjusted based on fixed header height (approx) */
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
    }

    .adBody {
        position: absolute;
        top: 30%;
        left: 40%;
    }

    .iframe-container {
        position: absolute;
        width: 100%; 
        max-width: 600px;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        display: flex;
        justify-content: center;
        top: 20%; 
        left: 50%;
        transform: translateX(-50%);
    }
    
    .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Custom CSS for the Sliding Button */
    
    /* 1. Hiding the element initially, setting it to 'flex' when visible */
    .slide-to-confirm-container.initial-hide {
        display: none !important; 
    }
    .slide-to-confirm-container {
        /* Ensure it uses flexbox when shown for better alignment */
        display: flex;
        align-items: center;
        max-width: 250px;
        width: 100%;
    }
    .modal-header {
         border-bottom: 1px solid #eee;
    }

    /* Media Queries */
    @media only screen and (max-width: 767px) {
        .adFram {
            top: 116px !important;
        }
        .iframe-container {
             top: 15%; 
        }
    }
    @media only screen and (max-width: 575px) {
        .adFram {
            top: 156px !important;
        }
        .confirm-btn {
            margin-top: 10px; /* Space out the report button from the slider */
        }
    }
</style>
@endpush


@section('content')

<div class="wrap">
    <div class="wg-setting">
        
        <div class="top-wg mb-20">
            
            <div class="header-2 header-fix bg-primary-100">
                @include($activeTemplate . 'partials.simple_header')
            </div>
            
            <div class="tf-container pt-80">
                <div class="wg-setting-profile">
                    <div class="col-12 col-md-4 mb-2 mb-md-0">
                        <div id="myProgress">
                            <div id="myBar">0%</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

{{-- Ad Display Wrapper (Rest remains the same) --}}
<div class="advertise-wrapper" style="position: relative; height: calc(100vh - 100px);">
    @if ($ptc->ads_type == 1)
        <iframe src="{{ $ptc->ads_body }}" class="adFram"></iframe>
    @elseif($ptc->ads_type == 2)
        <div class="container mt-5">
            <img src="{{ getImage(fileManager()->ptc()->path . '/' . $ptc->ads_body) }}" class="w-100">
        </div>
    @elseif($ptc->ads_type == 3)
        <div class="adBody">
            @php echo $ptc->ads_body @endphp
        </div>
    @else
        <div class="d-flex justify-content-center">
            <div class="iframe-container">
                <iframe src="{{ $ptc->ads_body }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    @endif
</div>


{{-- Report Modal (Rest remains the same) --}}
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">@lang('Report This Ad')</h5>
                <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.ptc.report.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="ptc_id" value="{{ $ptc->id }}">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>@lang("Type")</label>
                        <select name="type" class="form-control form-select" required>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ __($type->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang("Description")</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">@lang("Submit")</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="fixed-bottom-btn bg-primary-100 ">
    <div class="tf-container">
        <div class="col-12 col-md-8 d-flex justify-content-md-end justify-content-center">
            <form id="confirm-form" method="post" class="d-flex align-items-center flex-wrap justify-content-center justify-content-md-end">
                @csrf
                <input type="hidden" name="engagement_id" value="{{ $engagement->id }}">
                <input type="hidden" name="result" value="0" >
                
                {{-- 🔑 SLIDING CONFIRM BUTTON CONTAINER --}}
                {{-- Using custom class 'initial-hide' instead of d-none --}}
                <div class="slide-to-confirm-container me-3 initial-hide" id="slide-to-confirm-container">
                    <div class="btn-start" id="swipe-track">
                        {{-- Updated Icon to be a simple right arrow --}}
                        <span id="slider" class="icon btn-swipe">
                            <i class="icon-direction-right text-white"></i>
                        </span>
                        <span class="swipe-text fw-5">@lang('Slide to Confirm')</span>
                        <span class="swipe-confirm-text">@lang('Confirmed!')</span>
                    </div>
                    <input type="hidden" name="slide_confirm" id="slide_confirm_input" value="0">
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

{{-- 
    Updated JavaScript
--}}
@push('script')
<script>
    (function($, document) {
        "use strict";
        
        // --- Tab Visibility Check (Anti-cheat) ---
        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'hidden') {
                document.body.innerHTML = `
                    <div class="d-flex flex-wrap justify-content-center align-items-center clear-msg">
                        <img src="{{ asset('assets/images/somethingwrong.png') }}" alt="@lang('image')" class="img-fluid mx-auto mb-5">
                    </div>
                `;
            }
        });

        // --- Sliding Button Logic ---
        const slider = document.getElementById('slider');
        const swipeTrack = document.getElementById('swipe-track');
        const confirmForm = document.getElementById('confirm-form');
        const confirmInput = document.getElementById('slide_confirm_input');
        const container = document.getElementById('slide-to-confirm-container');
        
        const confirmRoute = '{{ route('user.ptc.confirm', encrypt($ptc->id . '|' . auth()->user()->id)) }}';
        
        let isDragging = false;
        let startX = 0;
        let maxDrag = 0;
        let isConfirmed = false;
        
        function initializeSlider() {
            if(swipeTrack && slider) {
                // Calculate the maximum distance the slider can move
                maxDrag = swipeTrack.offsetWidth - slider.offsetWidth;
            }
        }

        const dragStart = (e) => {
            // Use e.button === 0 to ensure only left-click initiates drag
            if (isConfirmed || !container || container.classList.contains('initial-hide') || (e.button && e.button !== 0)) return; 
            
            isDragging = true;
            startX = (e.clientX || e.touches[0].clientX) - slider.getBoundingClientRect().left;
            slider.style.transition = 'none';
        };

        const dragging = (e) => {
            if (!isDragging || isConfirmed) return;
            
            // Prevent scrolling on touch devices during drag
            if (e.type === 'touchmove') {
                e.preventDefault();
            }

            const currentX = e.clientX || e.touches[0].clientX;
            let newX = currentX - swipeTrack.getBoundingClientRect().left - startX;
            
            newX = Math.max(0, Math.min(newX, maxDrag));
            
            slider.style.transform = `translateX(${newX}px)`;

            // Check if slide is complete (within a small tolerance)
            if (newX >= maxDrag - 5) {
                isConfirmed = true;
                isDragging = false;
                slider.style.transform = `translateX(${maxDrag}px)`;
                swipeTrack.classList.add('confirmed');
                swipeTrack.classList.add('ready');
                
                confirmInput.value = 1;
                confirmForm.setAttribute('action', confirmRoute);
                
                // Submit the form automatically
                setTimeout(() => {
                    confirmForm.submit();
                }, 100); 
            }
        };

        const dragEnd = () => {
            if (!isDragging) return;
            isDragging = false;
            
            if (!isConfirmed) {
                // Snap back to start if not fully slid
                slider.style.transition = 'transform 0.3s ease-out';
                slider.style.transform = 'translateX(0)';
            }
        };

        // Attach event listeners for sliding, ensure elements exist
        if (slider) {
            slider.addEventListener('mousedown', dragStart);
            document.addEventListener('mousemove', dragging);
            document.addEventListener('mouseup', dragEnd);

            // Added passive: false for touchmove to allow preventDefault
            slider.addEventListener('touchstart', dragStart);
            document.addEventListener('touchmove', dragging, { passive: false }); 
            document.addEventListener('touchend', dragEnd);
            
            window.addEventListener('resize', initializeSlider);
        }
        // --- End of Sliding Button Logic ---

        // --- Progress Bar function ---
        function move() {
            var elem = document.getElementById("myBar");
            var width = 0;
            var id = setInterval(frame, {{ $ptc->duration * 10 }}); 

            function frame() {
                if (width >= 100) {
                    // Timer finished: SHOW the sliding button by removing the custom hide class
                    if(container) {
                        // FIX: Use native JS for performance and reliability against Bootstrap CSS
                        container.classList.remove("initial-hide"); 
                        initializeSlider(); // Initialize slider dimensions after showing
                    }
                    clearInterval(id);
                } else {
                    width++;
                    elem.style.width = width + '%';
                    elem.innerHTML = width + '%';
                }
            }
        }
        
        // Start progress bar on page load
        window.onload = move;

        // --- Modal & Engagement ---
        $('#report').on("click", function(){
            var modal = new bootstrap.Modal(document.getElementById('reportModal'));
            modal.show();
        });

        $(window).on('beforeunload', function() {
            $.get("{{ route('user.ptc.engagement', $engagement->id) }}", {},function (data, textStatus, jqXHR) {});
        });


    })(jQuery, document);
</script>
@endpush