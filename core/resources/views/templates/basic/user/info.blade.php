@extends($activeTemplate . 'layouts.simple')
@section('content')
<div class="wrap">
    <div class="wg-setting">
        <div class="top-wg mb-20">
            
            {{-- Fixed Header --}}
            <div class="header-2 header-fix bg-primary-100">
                @include($activeTemplate . 'partials.simple_header', ['title' => 'App Info'])
            </div>
            
            {{-- App Identity Section --}}
            <div class="tf-container pt-80">
                <div class="wg-setting-profile text-center">
                    <div class="image mx-auto shadow-sm" style="border-radius: 20px; overflow: hidden; background: #fff; padding: 10px;">
                        {{-- App Icon Placeholder --}}
                        <img loading="lazy" alt="App Logo" width="80" height="80" src="{{ asset('assets/templates/payqra') }}/images/logo/144.png">
                    </div>
                    <div class="title mt-3">
                        <h5 class="fw-700">{{ gs('site_name') }}</h5>
                        <p class="text-muted text-small">@lang('Secure Digital Payments')</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="tf-container mb-5">
    {{-- Application Details Card --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 border-bottom">
                    <span class="text-muted text-small">@lang('Version')</span>
                    <span class="fw-500">1.0.4 (Stable)</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 border-bottom">
                    <span class="text-muted text-small">@lang('Build Number')</span>
                    <span class="fw-500">#20251218</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 border-bottom">
                    <span class="text-muted text-small">@lang('Last Updated')</span>
                    <span class="fw-500">Dec 15, 2025</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 border-bottom">
                    <span class="text-muted text-small">@lang('Developer')</span>
                    <span class="text-primary fw-500">PayQra Tech Team</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center py-3 border-0">
                    <span class="text-muted text-small">@lang('Server Status')</span>
                    <span class="badge bg-success-transparent text-success px-3 py-2" style="font-size: 10px; border-radius: 20px;">
                        <i class="fas fa-circle me-1" style="font-size: 8px;"></i> @lang('Operational')
                    </span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="d-grid gap-3">
        <button type="button" class="tf-btn secondary w-100 py-3 d-flex align-items-center justify-content-center" style="background: #f8f9fa; border: 1px solid #eee; color: #333;">
            <i class="fas fa-sync-alt me-2 text-muted"></i> @lang('Check for Updates')
        </button>
        
        <a href="{{ route('user.profile.setting') }}" class="text-center text-primary fw-500 text-small">
            @lang('Licenses & Legal Information')
        </a>
    </div>

    {{-- Footer Copyright --}}
    <div class="mt-5 text-center">
        <p class="text-muted text-extra-small">
            &copy; {{ date('Y') }} {{ gs('site_name') }}. @lang('All Rights Reserved.')
        </p>
    </div>
</div>

{{-- Navigation footer --}}
@include($activeTemplate . 'partials.footer_nav')
@endsection

@push('style')
<style>
    .text-small {
        font-size: 14px;
    }
    .text-extra-small {
        font-size: 12px;
    }
    .fw-700 {
        font-weight: 700;
    }
    .fw-500 {
        font-weight: 500;
    }
    .bg-success-transparent {
        background-color: rgba(40, 167, 69, 0.1);
    }
    .list-group-item {
        background-color: transparent;
    }
    .card {
        background-color: #fff;
    }
    /* Simple button adjustment */
    .secondary:hover {
        background-color: #f1f1f1 !important;
    }
</style>
@endpush