@extends($activeTemplate . 'layouts.simple')
@section('content')
    <style>
        .accent-box .box-input-field::before {
            content: "Rs.";
            font-size: 24px;
            font-weight: 700;
            position: absolute;
            left: 0px;
            top: 52%;
            transform: translateY(-50%);
        }

        /* --- NEW STYLES FOR SELECTED GATEWAY --- */
        .company-list-item {
            transition: all 0.3s ease;
        }

        .company-list-item {
            border: 2px solid var(--primary) !important;
        }
        .company-list-item.active-gateway {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        /* Force text to white inside the active item for contrast */
        .company-list-item.active-gateway h6,
        .company-list-item.active-gateway span,
        .company-list-item.active-gateway p,
        .company-list-item.active-gateway div,
        .company-list-item.active-gateway .name-company,
        .company-list-item.active-gateway .payment-item__name {
            color: #ffffff !important;
        }
    </style>
    <div class="wrap">
        <div class="wg-top-up pb-63">
        
            <div class="header-2 mb-12">
                @include($activeTemplate . 'partials.simple_header')
            </div>
                
            <form action="{{ route('user.withdraw.money') }}" method="post" class="withdraw-form">
            @csrf
        
            <div class="tf-container">
                
                {{-- 💰 Amount Input (Matching 'Nominal Balance' style) --}}
                <div class="wg-top-up-input mb-25">
                    <div class="accent-box mb-25">
                        <fieldset class="mb-24">
                            {{-- Note: Renamed 'Nominal balance' to 'Withdrawal Amount' for context --}}
                            <label for="input-accent" class="text-medium fw-5">@lang('Withdrawal Amount')</label>
                            <div class="mt-12 box-input-field">
                                <input type="text" 
                                       value="{{ old('amount') }}" 
                                       name="amount" 
                                       required 
                                       class="clear-ip value_input amount" 
                                       style="margin-left: 19px;"  
                                       placeholder="@lang('0.00')" 
                                       autocomplete="off"
                                       id="input-accent">
                            </div>
                        </fieldset>
                    </div>
                </div>
                
                {{-- Withdrawal Policy Note --}}
                <div class="alert alert-primary border-0 shadow-sm mb-24" style="background-color: #F3E8FF; border-left: 4px solid #9333EA !important;">
                    <div class="d-flex">
                        <i class="fa fa-info-circle mt-1 me-2 text-primary"></i>
                        <div>
                            <h6 class="mb-1 text-primary">@lang('Withdrawal Policy')</h6>
                            <p class="mb-0 text-small text-dark">
                                @lang('To ensure platform stability, withdrawals are limited to') <strong>@lang('once every 3 days')</strong>.
                                @if(auth()->user()->last_withdraw)
                                    <br>
                                    <small class="text-muted">
                                        @lang('Your last withdrawal was on'): {{ showDateTime(auth()->user()->last_withdraw) }}.
                                    </small>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
        
                {{-- 🏦 Withdrawal Methods List --}}
                @foreach ($withdrawMethod as $data)
                    <label for="{{ titleToKey($data->name) }}"
                        class="payment-item @if ($loop->index > 4) d-none @endif gateway-option company-list-item mb-12 fieldset-radio">
                        
                        {{-- IMPORTANT: Swapped 'gateway' name for 'method_code' as this is a WITHDRAWAL form --}}
                        <input class="tf-check-rounded style-border-greyscale-200 payment-item__radio gateway-input" id="{{ titleToKey($data->name) }}" hidden
                            data-gateway='@json($data)' 
                            type="radio" 
                            name="method_code" {{-- Correct name for withdrawal method --}}
                            value="{{ $data->id }}" {{-- Using $data->id as the value for the selected method --}}
                            @if (old('method_code')) @checked(old('method_code') == $data->id) @else @checked($loop->first) @endif
                            data-min-amount="{{ showAmount($data->min_limit) }}" {{-- Corrected to use min_limit --}}
                            data-max-amount="{{ showAmount($data->max_limit) }}"> {{-- Corrected to use max_limit --}}
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="w-75" >
                                <h6 class="name-company fw-5">{{ __($data->name) }}</h6>
                            </div>
                            <div style="width: 10%;" >
                                <img class="w-100 payment-item__thumb-img"
                                    src="{{ getImage(getFilePath('withdrawMethod') . '/' . $data->image) }}" {{-- Corrected image path to use $data->image and withdrawMethod path --}}
                                    alt="@lang('Withdrawal Method Image')">
                            </div>
                        </div>
                    </label>
                @endforeach
                
                {{-- Show All Options Button (if more than 4 methods) --}}
                @if ($withdrawMethod->count() > 4)
                    <div class="mb-12">
                        <button type="button" class="payment-item__btn more-gateway-option tf-btn secondary greyscale w-100">
                            <p class="payment-item__btn-text">@lang('Show All Withdrawal Options')</p>
                            <span class="payment-item__btn__icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                    </div>
                @endif
        
                {{-- The Account Balance Radio is usually not relevant for a standard withdrawal form, 
                     unless the user can withdraw from an internal account balance, but I've removed 
                     it since the target structure only had it because it was a Deposit form. --}}
        
                {{-- 📊 Fee & Total Information Card (Matching target design) --}}
                <div class="card p-3 mb-24 border-0 shadow-sm">
                    <div class="card-body p-0">
                        
                        {{-- Limit Display --}}
                        <div class="row align-items-center mb-2 hideInfo">
                            <div class="col-6">
                                <p class="text-muted mb-0 d-flex align-items-center">
                                    <i class="fas fa-arrows-alt-h me-2 text-primary"></i>
                                    @lang('Limit')
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="fw-bold mb-0">
                                    {{ gs('cur_sym') }} <span class="gateway-limit text-dark">@lang('0.00')</span>
                                </p>
                            </div>
                        </div>
                        <hr class="my-3 hideInfo">
                        
                        {{-- Processing Charge Display --}}
                        <div class="row align-items-center mb-2 hideInfo">
                            <div class="col-6">
                                <p class="text-muted mb-0 d-flex align-items-center">
                                    <i class="fas fa-percentage me-2 text-danger"></i>
                                    @lang('Processing Charge')
                                    <span data-bs-toggle="tooltip" title="@lang('Processing charge for withdraw method')" class="ms-1 proccessing-fee-info text-info">
                                        <i class="las la-info-circle"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="fw-bold mb-0">
                                    {{ gs('cur_sym') }}<span class="processing-fee text-dark">@lang('0.00')</span>
                                    {{ __(gs('cur_text')) }}
                                </p>
                            </div>
                        </div>
                        
                        {{-- Receivable / Final Amount --}}
                        <div class="row align-items-center pt-3 total-amount border-top border-secondary-subtle">
                            <div class="col-6">
                                {{-- Renamed 'Total Payable' to 'Receivable' for withdrawal context --}}
                                <p class="text-dark fw-bold mb-0">@lang('Receivable Amount')</p>
                            </div>
                            <div class="col-6 text-end">
                                <h5 class="text-success mb-0">
                                    <span class="final-amount">@lang('0.00')</span>
                                    {{ __(gs('cur_text')) }}
                                </h5>
                            </div>
                        </div>
                        
                        {{-- Conversion Rate (Hidden by default) --}}
                        <div class="row align-items-center mt-3 pt-2 hideInfo gateway-conversion d-none total-amount border-top border-secondary-subtle">
                            <div class="col-6">
                                <p class="text-muted mb-0">@lang('Conversion Rate')</p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="text-primary fw-bold mb-0"></p> {{-- Populated by JS --}}
                            </div>
                        </div>
                        
                        {{-- Amount in Gateway Currency (Hidden by default) --}}
                        <div class="row align-items-center pt-2 hideInfo conversion-currency d-none total-amount">
                            <div class="col-6">
                                <p class="text-muted mb-0">
                                    @lang('In') <span class="gateway-currency text-dark fw-bold"></span>
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="text-primary fw-bold mb-0">
                                    <span class="in-currency"></span> {{-- Populated by JS --}}
                                </p>
                            </div>
                        </div>
                        
                        {{-- Crypto Warning (Hidden by default) --}}
                        <div class="alert alert-warning d-none hideInfo crypto-message mt-3 mb-0" role="alert">
                            <i class="fas fa-exchange-alt me-2"></i>
                            @lang('Conversion with') <span class="gateway-currency fw-bold"></span> @lang('and final value will Show on next step')
                        </div>
                    </div>
                </div>
        
                {{-- Submit Button --}}
                {{-- Note: The submit button should likely start disabled if no amount/method is selected --}}
                <button type="submit" class="tf-btn greyscale mb-4" disabled>@lang('Confirm Withdraw')</button>
                
            </div>
        </form>
    </div>
</div>
@endsection



@push('script')
    <script>
        "use strict";
        (function($) {

            var amount = parseFloat($('.amount').val() || 0);
            var gateway, minAmount, maxAmount;

            $('.amount').on('input', function(e) {
                amount = parseFloat($(this).val());
                if(!amount){
                    amount = 0
                }
                calculation();
            });

            $('.gateway-input').on('change', function(e) {
                gatewayChange();
            });

            function gatewayChange() {
                let gatewayElement = $('.gateway-input:checked');
                let methodCode = gatewayElement.val();
                

                gateway   = gatewayElement.data('gateway');
                minAmount = gatewayElement.data('min-amount');
                maxAmount = gatewayElement.data('max-amount');

                let processingFeeInfo =
                    `${parseFloat(gateway.percent_charge).toFixed(2)}% with ${parseFloat(gateway.fixed_charge).toFixed(2)} {{ __(gs('cur_text')) }} charge for processing fees`
                $(".proccessing-fee-info").attr("data-bs-original-title", processingFeeInfo);

                calculation();
            }

            gatewayChange();

            $(".more-gateway-option").on("click", function(e) {
                let paymentList = $(".gateway-option-list");
                paymentList.find(".gateway-option").removeClass("d-none");
                $(this).addClass('d-none');
                paymentList.animate({
                    scrollTop: (paymentList.height() - 60)
                }, 'slow');
            });

            function calculation() {
                if (!gateway) return;
                $(".gateway-limit").text(minAmount + " - " + maxAmount);

                let percentCharge = 0;
                let fixedCharge = 0;
                let totalPercentCharge = 0;

                if (amount) {
                    let percentCharge = parseFloat(gateway.percent_charge);
                    let fixedCharge = parseFloat(gateway.fixed_charge);

                    totalPercentCharge = parseFloat(amount / 100 * percentCharge);
                }


                let totalCharge = parseFloat(totalPercentCharge + fixedCharge);



                let totalAmount = parseFloat((amount || 0) - totalPercentCharge - fixedCharge);


                $(".final-amount").text(totalAmount.toFixed(2));
                $(".processing-fee").text(totalCharge.toFixed(2));
                $("input[name=currency]").val(gateway.currency);
                $(".gateway-currency").text(gateway.currency);

                if (amount < Number(gateway.min_limit) || amount > Number(gateway.max_limit)) {
                    $(".withdraw-form button[type=submit]").attr('disabled', true);
                } else {
                    $(".withdraw-form button[type=submit]").removeAttr('disabled');
                }

                if (gateway.currency != "{{ gs('cur_text') }}") {
                    $('.withdraw-form').addClass('adjust-height')
                    $(".gateway-conversion, .conversion-currency").removeClass('d-none');
                    $(".gateway-conversion").find('.deposit-info__input .text').html(
                        `1 {{ __(gs('cur_text')) }} = <span class="rate">${parseFloat(gateway.rate).toFixed(2)}</span>  <span class="method_currency">${gateway.currency}</span>`
                    );
                    $('.in-currency').text(parseFloat(totalAmount * gateway.rate).toFixed(2))
                } else {
                    $(".gateway-conversion, .conversion-currency").addClass('d-none');
                    $('.withdraw-form').removeClass('adjust-height')
                }
            }

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            $('.gateway-input').change();
        
        })(jQuery);
    </script>
@endpush
