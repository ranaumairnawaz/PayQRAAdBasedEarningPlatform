@extends($activeTemplate . 'layouts.auth')
@section('panel')
    @php
        $loginCaption = getContent('login.content', true);
    @endphp
    <div class="tf-container">
        <form class="action-form from-login loginForm verify-gcaptcha" action="{{ route('user.login') }}" method="post">
            @csrf
            <div class="top-from">
                <h4 class="title fw-6">{{ __($loginCaption->data_values->heading) }}</h4>
                <div class="sub-title">Welcome back! Please enter yout details.</div>
            </div>
            <div class="middle-from">
                <fieldset class="mb-12 icon-absolute">
                    <i class="icon-mail"></i>
                    <input type="text" name="username" class="tf-field-input tf-input" required placeholder="@lang('Username or Email')">
                </fieldset>
                <fieldset class="box-auth-pass mb-12 tf-field icon-absolute">
                    <i class="icon-lock"></i>
                    <input type="password" name="password" placeholder="@lang('Password')" id="pass" class="password-field tf-field-input tf-input">
                    <label class="tf-field-label" for="pass">Password</label>
                    <span class="show-pass">
                        <span class="icon-eye"></span>
                        <span class="icon-eye-off"></span>
                    </span>
                </fieldset>

                <p>Forgot password? <a href="{{ route('user.password.request') }}">Reset it</a></p>
            </div>
            <div class="bottom-from">
                <button type="submit" class="tf-btn primary mb-12">Sign In</button>
            </div>
            <div class="fixed-bottom-btn">
                <p class="text-bottom">
                    Don’t have and account? <a href="{{ route('user.register') }}">Sign Up</a>
                </p>
            </div>
        </form>

    </div>
@endsection

@push('style')
   
@endpush
