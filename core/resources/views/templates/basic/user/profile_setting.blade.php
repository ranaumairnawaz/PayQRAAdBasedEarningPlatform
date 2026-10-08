@extends($activeTemplate . 'layouts.simple')
@section('content')
<div class="wrap">
    <div class="wg-setting">
        <div class="top-wg mb-20">
            
            {{-- Fixed Header --}}
            <div class="header-2 header-fix bg-primary-100">
                @include($activeTemplate . 'partials.simple_header', ['title' => 'Profile Setting'])
            </div>
            
            {{-- Profile Identity Section --}}
            <div class="tf-container pt-80">
                <div class="wg-setting-profile">
                    <div class="image">
                        {{-- Replace with actual user image if available, otherwise use placeholder --}}
                        <img loading="lazy" alt="img" width="60" height="60" src="{{ asset('assets/templates/payqra') }}/images/avartar/avartar-4.jpg">
                    </div>
                    <div class="title d-flex align-items-center gap-8 justify-content-center">
                        <h6>{{ $user->firstname }} {{ $user->lastname }}</h6>
                    </div>
                    <div class="gmail text-muted">
                        {{ $user->username }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="tf-container mb-5">
    <div class="card border-0 shadow-sm border-radius-sm">
        <div class="card-body">
            <form class="register" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="form-group col-sm-6 mb-3">
                        <label class="form-label text-small fw-5">@lang('First Name')</label>
                        <input type="text" class="form-control form--control" name="firstname" value="{{$user->firstname}}" required>
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        <label class="form-label text-small fw-5">@lang('Last Name')</label>
                        <input type="text" class="form-control form--control" name="lastname" value="{{$user->lastname}}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 mb-3">
                        <label class="form-label text-small fw-5">@lang('E-mail Address')</label>
                        <input class="form-control form--control bg-light" value="{{$user->email}}" readonly>
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        <label class="form-label text-small fw-5">@lang('Mobile Number')</label>
                        <input class="form-control form--control bg-light" value="{{$user->mobile}}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 mb-3">
                        <label class="form-label text-small fw-5">@lang('Address')</label>
                        <input type="text" class="form-control form--control" name="address" value="{{@$user->address}}">
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        <label class="form-label text-small fw-5">@lang('State')</label>
                        <input type="text" class="form-control form--control" name="state" value="{{@$user->state}}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-4 mb-3">
                        <label class="form-label text-small fw-5">@lang('Zip Code')</label>
                        <input type="text" class="form-control form--control" name="zip" value="{{@$user->zip}}">
                    </div>

                    <div class="form-group col-sm-4 mb-3">
                        <label class="form-label text-small fw-5">@lang('City')</label>
                        <input type="text" class="form-control form--control" name="city" value="{{@$user->city}}">
                    </div>

                    <div class="form-group col-sm-4 mb-3">
                        <label class="form-label text-small fw-5">@lang('Country')</label>
                        <input class="form-control form--control bg-light" value="{{@$user->country_name}}" disabled>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="tf-btn primary w-100">@lang('Update Profile')</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Navigation footer if required --}}
@include($activeTemplate . 'partials.footer_nav')

@endsection

@push('style')
<style>
    /* Styling adjustments to match the "Simple" UI */
    .form--control {
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 10px 15px;
    }
    .form--control:focus {
        border-color: var(--primary);
        box-shadow: none;
    }
    .form-label {
        margin-bottom: 5px;
        color: #555;
    }
    .card {
        border-radius: 15px;
    }
</style>
@endpush