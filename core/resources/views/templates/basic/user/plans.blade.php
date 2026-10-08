@extends($activeTemplate . 'layouts.simple')
@section('content')
<div class="wrap">
    <div class="wg-setting">
        <div class="top-wg">

            {{-- Header Section --}}
            <div class="header-2 header-fix bg-primary-100">
                @include($activeTemplate . 'partials.simple_header', ['title' => 'Subscription Plans'])
            </div>
        </div>
        <div class="tf-container mb-5 pt-80">

            {{-- Pricing Plans Section (Adapted for mobile card view) --}}
            @if (!blank($plans))
                <div class="list-setting-item plan-list mb-5">
                    @foreach ($plans as $plan)
                        <div class="plan-item mb-4 mt-3 p-0 bg-white  border-radius-sm shadow-sm position-relative">
                            
                            <div class="d-flex justify-content-between rounded-sm align-items-center p-3 @if($plan->highlight) bg-primary @else bg-white @endif">
                                <div class="flex-grow-1 me-2">
                                    {{-- Plan Name and Price --}}
                                    <span class="text-large fw-bold mb-1 d-block @if ($plan->highlight) text-white @else text-primary @endif">{{ __($plan->name) }}</span>
                                    <h2 class="fw-bold @if($plan->highlight) text-white @else text-dark @endif">{{ showAmount($plan->price) }}</h2>
                                </div>
                            </div>
                            
                            {{-- Plan Details (Collapsible/Hidden by default for clean look) --}}
                            <div class="mt-3 pt-2 p-3 border-top">
                                <h6 class="text-medium mb-2">@lang('Plan Details')</h6>
                                
                                <div class="d-flex justify-content-between text-small text-muted">
                                    <span><i class="icon-check me-1 text-success"></i> @lang('Daily Ads'):</span>
                                    <span>{{ $plan->daily_limit }}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between text-small text-muted mt-1">
                                    <span><i class="icon-check me-1 text-success"></i> @lang('Referral Bonus'):</span>
                                    <span>@lang('Upto') {{ $plan->ref_level }} @lang('Level')</span>
                                </div>
                                
                                <div class="d-flex justify-content-between text-small text-muted mt-1">
                                    <span><i class="icon-check me-1 text-success"></i> @lang('Validity'):</span>
                                    <span>{{ $plan->validity }} @lang('Days')</span>
                                </div>
        
                                 <div class="d-flex justify-content-between text-small text-muted mt-1">
                                    <span><i class="icon-check me-1 text-success"></i> @lang('Daily Earning'):</span>
                                    @if($plan->percent == 0)
                                    <span>{{ showAmount(5*$plan->daily_limit) }}</span>
                                    @else
                                    <span>{{ showAmount((($plan->price*$plan->percent)/100)*$plan->daily_limit) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center" >
                                {{-- Subscription Button --}}
                                    @auth
                                        @if (auth()->user()->runningPlan && auth()->user()->plan_id == $plan->id)
                                            <button class="btn btn-sm btn-dark " disabled>@lang('Current Plan')</button>
                                        @else
                                            <a class="btn btn-sm w-100 bg-primary text-white subscribe-btn" href="{{ route('user.buyPlan', @$plan->id) }}" data-plan="{{ $plan }}">
                                                @lang('Subscribe Now')
                                            </a>
                                        @endif
                                    @else
                                        <a class="btn btn-sm w-100 bg-primary text-white" href="{{ route('user.login') }}">
                                            @lang('Subscribe Now')
                                        </a>
                                    @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card">
                    <div class="card-body p-0">
                        @include($activeTemplate . 'partials.empty', [
                            'message' => 'Plan not found',
                        ])
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


{{-- Footer Nav (from the simple template) --}}
@include($activeTemplate . 'partials.footer_nav')

@endsection

@push('script')
    <script>
        "use strict";
        (function($) {
            // Optional: Apply background to specific section if needed by the simple layout CSS
            // $(".overview-area").addClass("section--bg"); 
            
            // Add any specific plan-related JS here if required (e.g., confirmation before buying)
            $('.subscribe-btn').on('click', function(e) {
                // Add a confirmation dialog before redirecting, if required
                // e.preventDefault();
                // If confirmed, proceed: window.location.href = $(this).attr('href');
            });
            
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        /* Styling to make the plan cards look distinct from transactions */
        .plan-list .plan-item {
            border: 1px solid var(--primary-color-200); /* A slightly more prominent border */
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .plan-list .plan-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(var(--primary-color-rgb), 0.1);
        }
        /* Specific button styling for the new layout (adjust variables as per theme) */
        .btn-primary-100 {
            background-color: var(--primary-color-100);
            color: #fff;
            border: none;
        }
        .btn-primary-100:hover {
             background-color: var(--primary-color-200);
             color: #fff;
        }
    </style>
@endpush