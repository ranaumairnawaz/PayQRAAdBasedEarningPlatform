@extends($activeTemplate . 'layouts.simple')
@section('content')
<div class="wrap">
    <div class="wg-setting">
        <div class="top-wg mb-20">
            
            {{-- Fixed Header --}}
            <div class="header-2 header-fix bg-primary-100">
                @include($activeTemplate . 'partials.simple_header', ['title' => 'Community'])
            </div>
            
            {{-- Identity Section --}}
            <div class="tf-container pt-80">
                <div class="wg-setting-profile">
                    <div class="image">
                        {{-- Telegram Logo or Avatar --}}
                        <img loading="lazy" alt="img" width="60" height="60" src="{{ asset('assets/templates/payqra') }}/images/logo/144.png">
                    </div>
                    <div class="title d-flex align-items-center gap-8 justify-content-center">
                        <h6>@lang('Official Community')</h6>
                    </div>
                    <div class="gmail text-muted">
                        @lang('Join us for updates & support')
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="tf-container mb-5">
    {{-- Telegram Join Card --}}
    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
        <div class="card-body p-4 text-center">
            <div class="icon-box mb-3 mx-auto d-flex align-items-center justify-content-center" 
                 style="width: 70px; height: 70px; background: #e3f2fd; border-radius: 50%;">
                <i class="fa fa-telegram text-primary" style="font-size: 35px;"></i>
            </div>
            
            <h5 class="fw-700 mb-2">@lang('Telegram Group')</h5>
            <p class="text-muted text-small mb-4">
                @lang('Get the latest news, platform updates, and real-time support from our community members.')
            </p>

            <a href="https://t.me/payqra" target="_blank" class="tf-btn primary w-100 py-3">
                <i class="fab fa-telegram-plane me-2"></i> @lang('Join Now')
            </a>
        </div>
        
        <div class="card-footer bg-light border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-small text-muted">@lang('Username')</span>
                <span class="text-small fw-500 text-dark">@payqra</span>
            </div>
        </div>
    </div>

    {{-- Support Note --}}
    <div class="mt-4 p-3 bg-light border-radius-8 text-center">
        <p class="text-small text-muted mb-0">
            @lang('Having trouble joining? Contact our support via ticket.')
        </p>
    </div>
</div>

{{-- Navigation footer --}}
@include($activeTemplate . 'partials.footer_nav')
@endsection

@push('style')
<style>
    /* Styling to match the simple theme */
    .card {
        background: #ffffff;
    }
    .text-small {
        font-size: 13px;
    }
    .fw-700 {
        font-weight: 700;
    }
    .primary {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        color: white !important;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        text-decoration: none;
    }
</style>
@endpush