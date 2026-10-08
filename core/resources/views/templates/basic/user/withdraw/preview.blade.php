@extends($activeTemplate.'layouts.simple')
@section('content')

<div class="wrap">
    {{-- Header Section --}}
    <div class="wg-top-up pb-63">
        <div class="header-2 header-fix style-bg-1 mb-12">
            {{-- Assuming $activeTemplate is available for the header partial --}}
            @include($activeTemplate . 'partials.simple_header', ['pageTitle' => __('Withdraw Confirmation')]) 
        </div>
    </div>

    {{-- Withdrawal Method Summary Card --}}
    <div class="card m-3">
        <div class="card-body p-3 d-flex justify-content-between align-items-center">
            <div class="text-left">
                <span class="text-medium fw-5">{{ $withdraw->method->name }}</span>
            </div>
            <div style="width: 10%;">
                {{-- Using the correct image path for the withdrawal method --}}
                <img class="w-100" src="{{ getImage(getFilePath('withdrawMethod') . '/' . $withdraw->method->image) }}" alt="@lang('Withdrawal Method Image')">
            </div>
        </div>
    </div>

    {{-- Instruction and Form Card --}}
    <div class="card m-3 mb-5">
        <div class="card-body p-3">
            
            <div class="mb-3">
                @php
                    echo $withdraw->method->description;
                @endphp
            </div>
            
            <form action="{{ route('user.withdraw.submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            
            {{-- 🔑 ESSENTIAL MISSING INPUT --}}
            {{-- This tells the backend which pending withdrawal request to finalize. --}}
            <input type="hidden" name="id" value="{{ $withdraw->id }}">
        
            {{-- Custom Form Fields (for account details, etc.) --}}
            <x-viser-form identifier="id" identifierValue="{{ $withdraw->method->form_id }}" />
        
            {{-- Google Authenticator Code --}}
            @if (auth()->user()->ts)
                <fieldset class="form-group mb-4">
                    <label class="text-medium fw-5">@lang('Google Authenticator Code')</label>
                    <div class="mt-12 box-input-field">
                        <input type="text" name="authenticator_code" class="form-control form--control clear-ip" required>
                    </div>
                </fieldset>
            @endif
            
            <p class="mb-0"><i class="las la-info-circle"></i> @lang('You are requesting') <b>{{ showAmount($withdraw->amount) }}</b> @lang('for withdraw.') @lang('The admin will send you')
                <b class="text--success">{{ showAmount($withdraw->final_amount, currencyFormat:false) . ' ' . $withdraw->currency }} </b> @lang('to your account.')</p>
            
            <button type="submit" class="tf-btn greyscale mb-4 mt-4 w-100">@lang('Confirm Withdraw')</button>
        </form>
        </div>
    </div>
</div>
@endsection
