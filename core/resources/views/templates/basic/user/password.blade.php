@extends($activeTemplate . 'layouts.simple')
@section('content')
<div class="wrap">
    <div class="wg-setting">
        <div class="top-wg mb-20">
            
            {{-- Fixed Header --}}
            <div class="header-2 header-fix bg-primary-100">
                @include($activeTemplate . 'partials.simple_header', ['title' => 'Change Password'])
            </div>
        </div>
    </div>
</div>

<div class="tf-container mb-5">
    <div class="card border-0 shadow-sm border-radius-sm">
        <div class="card-body">
            <form method="post">
                @csrf
                
                <div class="form-group mb-3">
                    <label class="form-label text-small fw-5">@lang('Current Password')</label>
                    <div class="position-relative">
                        <input type="password" class="form-control form--control" name="current_password" required autocomplete="current-password" placeholder="@lang('Enter current password')">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label text-small fw-5">@lang('New Password')</label>
                    <div class="position-relative">
                        <input type="password" class="form-control form--control @if(gs('secure_password')) secure-password @endif" name="password" required autocomplete="new-password" placeholder="@lang('Enter new password')">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="form-label text-small fw-5">@lang('Confirm Password')</label>
                    <div class="position-relative">
                        <input type="password" class="form-control form--control" name="password_confirmation" required autocomplete="new-password" placeholder="@lang('Confirm new password')">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="tf-btn primary w-100">@lang('Change Password')</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Navigation footer --}}
@include($activeTemplate . 'partials.footer_nav')

@endsection

@if(gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('style')
<style>
    /* Styling to match Simple UI */
    .form--control {
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 12px 15px;
        background-color: #fff;
    }
    .form--control:focus {
        border-color: var(--primary);
        box-shadow: none;
    }
    .form-label {
        margin-bottom: 6px;
        color: #444;
    }
    .card {
        border-radius: 12px;
    }
    /* Style for secure password strength requirements */
    .hover-input-popup {
        position: relative;
    }
    .input-popup {
        background-color: #333;
        color: #fff;
        border-radius: 5px;
        padding: 10px;
        font-size: 12px;
        margin-top: 5px;
    }
</style>
@endpush