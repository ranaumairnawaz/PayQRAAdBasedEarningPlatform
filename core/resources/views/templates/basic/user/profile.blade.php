@extends($activeTemplate . 'layouts.simple')
@section('content')
<div class="wrap">
    <div class="wg-setting">
        <div class="top-wg mb-20">
            
            <div class="header-2 header-fix bg-primary-100">
                @include($activeTemplate . 'partials.simple_header')
            </div>
            
            <div class="tf-container pt-80">
                <div class="wg-setting-profile">
                    <div class="image">
                        <img loading="lazy" alt="img" width="60" height="60" src="{{ asset('assets/templates/payqra') }}/images/avartar/avartar-4.jpg">
                    </div>
                    <div class="title d-flex align-items-center gap-8 justify-content-center">
                        <h6>{{ $user->firstname }} {{ $user->lastname }}</h6>
                        <a href="{{ route('user.profile.index') }}"><i class="icon-edit-rectangle"></i></a>
                    </div>
                    <div class="gmail">
                        {{ $user->username }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="tf-container mb-5">
    <div class="list-setting-item">
        <a href="{{ route('user.profile.setting') }}" class="setting-item">
            <i class="icon-user-settings-1"></i>
            <span class="text-medium fw-5">Profile Setting</span>
        </a>
        <a href="{{ route('user.change.password') }}" class="setting-item">
            <i class="icon-forgot-password"></i>
            <span class="text-medium fw-5">Password Change</span>
        </a>
        <a href="{{ route('user.support') }}" class="setting-item">
            <i class="icon-mentoring"></i>
            <span class="text-medium fw-5">Support Ticket</span>
        </a>
        <a href="{{ route('user.info') }}" class="setting-item">
            <i class="icon-mobile-protection"></i>
            <span class="text-medium fw-5">App info</span>
        </a>
        <a href="{{ route('user.logout') }}" class="setting-item">
            <i class="icon-logout"></i>
            <span class="text-medium fw-5">Logout</span>
        </a>
    </div>
</div>
@include($activeTemplate . 'partials.footer_nav')
@endsection