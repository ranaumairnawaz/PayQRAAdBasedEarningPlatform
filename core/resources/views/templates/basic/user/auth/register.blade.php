@extends($activeTemplate . 'layouts.auth')
@section('panel')
    @if (gs('registration'))
        @php
            $registerCaption = getContent('register.content', true);
            $policyPages     = getContent('policy_pages.element', false, orderById: true);
        @endphp
        <div class="tf-container">
            <form class="action-form from-register loginForm verify-gcaptcha disableSubmission" action="{{ route('user.register') }}" method="post">
                @csrf

                {{-- Top Section: Heading and Login Link --}}
                <div class="top-from text-center pt-5 pb-3">
                    <h4 class="title fw-6">{{ __($registerCaption->data_values->heading) }}</h4>
                    <div class="sub-title">@lang('Create your account to get started.')</div>
                </div>

                {{-- Middle Section: Form Fields --}}
                <div class="middle-from">
                    <div class="row">

                        {{-- Reference By Field --}}
                        @if (session()->get('reference') != null)
                            <input type="hidden" name="referBy" class="tf-field-input tf-input"
                                        placeholder="@lang('Reference By')" value="{{ session()->get('reference') }}" readonly>
                        @endif

                        {{-- First Name --}}
                        <div class="col-sm-6">
                            <fieldset class="mb-12 icon-absolute">
                                <i class="icon-user"></i>
                                <input type="text" name="firstname" class="tf-field-input tf-input"
                                    placeholder="@lang('First Name')" value="{{ old('firstname') }}" required>
                            </fieldset>
                        </div>

                        {{-- Last Name --}}
                        <div class="col-sm-6">
                            <fieldset class="mb-12 icon-absolute">
                                <i class="icon-user"></i>
                                <input type="text" name="lastname" class="tf-field-input tf-input"
                                    placeholder="@lang('Last Name')" value="{{ old('lastname') }}" required>
                            </fieldset>
                        </div>

                        {{-- Email Address --}}
                        <div class="col-sm-12">
                            <fieldset class="mb-12 icon-absolute">
                                <i class="icon-mail"></i>
                                <input type="email" name="email" class="tf-field-input tf-input checkUser"
                                    placeholder="@lang('E-Mail Address')" value="{{ old('email') }}" required>
                            </fieldset>
                        </div>

                        {{-- Password --}}
                        <div class="col-sm-6">
                            <fieldset class="box-auth-pass mb-12 tf-field icon-absolute">
                                <i class="icon-lock"></i>
                                <input type="password" name="password" placeholder="@lang('Password')" id="pass"
                                    class="password-field tf-field-input tf-input @if (gs('secure_password')) secure-password @endif" required>
                                <span class="show-pass">
                                    <span class="icon-eye"></span>
                                    <span class="icon-eye-off"></span>
                                </span>
                            </fieldset>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="col-sm-6">
                            <fieldset class="box-auth-pass mb-12 tf-field icon-absolute">
                                <i class="icon-lock"></i>
                                <input type="password" name="password_confirmation" placeholder="@lang('Confirm Password')"
                                    id="pass_confirm" class="tf-field-input tf-input" required>
                                <span class="show-pass">
                                    <span class="icon-eye"></span>
                                    <span class="icon-eye-off"></span>
                                </span>
                            </fieldset>
                        </div>

                        {{-- Captcha --}}
                        <div class="col-sm-12">
                            <x-captcha />
                        </div>
                        
                        {{-- Terms and Policy Checkbox --}}
                        @if (gs('agree'))
                            <div class="col-sm-12 mb-3">
                                <input type="checkbox" id="agree" @checked(old('agree')) name="agree" required>
                                <label for="agree" class="text-small ms-2">@lang('I agree with')
                                    @foreach ($policyPages as $policy)
                                        <a href="{{ route('policy.pages', $policy->slug) }}" target="_blank" class="text-primary">{{ __($policy->data_values->title) }}</a>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </label>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Bottom Section: Register Button and Social Login --}}
                <div class="bottom-from">
                    <button type="submit" class="tf-btn primary mb-12">@lang('Register Now')</button>
                </div>

                {{-- Fixed Bottom Link --}}
                
                <div class="fixed-bottom-btn text-center">
                    <p class="text-bottom">
                        @lang('Already have an account?') <a class="text-primary" href="{{ route('user.login') }}">Sign In</a>
                    </p>
                </div>
            </form>
        </div>

        {{-- Exist Modal (Keep this as it's part of the checkUser logic) --}}
        <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                        <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </span>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                        <a href="{{ route('user.login') }}" class="btn btn--base">@lang('Login')</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Registration Disabled --}}
        @include($activeTemplate . 'partials.registration_disabled')
    @endif
@endsection

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
        "use strict";
        (function($) {

            // Check if user exists on email focusout
            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';

                var data = {
                    email: value,
                    _token: token
                }

                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $('#existModalCenter').modal('show');
                    }
                });
            });

            // Password field toggle functionality
            $('.box-auth-pass .show-pass').on('click', function() {
                var $input = $(this).siblings('.password-field');
                if ($input.attr('type') === 'password') {
                    $input.attr('type', 'text');
                    $(this).find('.icon-eye').hide();
                    $(this).find('.icon-eye-off').show();
                } else {
                    $input.attr('type', 'password');
                    $(this).find('.icon-eye').show();
                    $(this).find('.icon-eye-off').hide();
                }
            }).find('.icon-eye-off').hide(); // Initialize confirm password hide

        })(jQuery);
    </script>
@endpush
