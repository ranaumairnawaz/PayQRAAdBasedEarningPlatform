@extends($activeTemplate . 'layouts.simple')
@section('content')
    @php
        $planId = null;
        if ($plan) {
            $planId = $plan->id;
            $amount = getAmount(@$plan->price);
        } else {
            $amount = old('amount');
        }
    @endphp
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
            <form action="{{ route('user.deposit.insert') }}" method="post" class="deposit-form">
                @csrf
                <input type="hidden" name="currency">
                <input type="hidden" name="plan_id" value="{{ @$plan->id }}">
                
                <div class="tf-container">
                    <div class="wg-top-up-input mb-25">
                        <ul class="grid-2 gap-12 mb-16">
                            @foreach($plans as $price)
                                @if($price->status == 1 && $price->price != 0)
                                <li><a href="javascript:void(0);" class="tag-money"><span> {{ getAmount($price->price) }}</span></a></li>
                                @endif
                            @endforeach
                        </ul>
    
                        <div class="accent-box mb-25">
                            <fieldset class="mb-24">
                                <label for="input-accent" class="text-medium fw-5">Nominal balance</label>
                                <div class="mt-12 box-input-field">
                                    <input type="text" @if($plan) value="{{ $amount }}"  @else value="1500" @endif name="amount" required class="clear-ip value_input" style="margin-left: 19px;"  id="input-accent">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    
                    @foreach ($gatewayCurrency as $data)
                        <label for="{{ titleToKey($data->name) }}"
                            class="payment-item @if ($loop->index > 4) d-none @endif gateway-option company-list-item mb-12 fieldset-radio">
                                <input class="tf-check-rounded style-border-greyscale-200 payment-item__radio gateway-input" id="{{ titleToKey($data->name) }}" hidden
                                data-gateway='@json($data)' type="radio" name="gateway"
                                value="{{ $data->method_code }}"
                                @if (old('gateway')) @checked(old('gateway') == $data->method_code) @else
                                @checked($loop->first) @endif
                                data-min-amount="{{ showAmount($data->min_amount) }}"
                                data-max-amount="{{ showAmount($data->max_amount) }}">
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="w-75" >
                                    <h6 class="name-company fw-5">{{ __($data->name) }}</h6>
                                </div>
                                <div style="width: 10%;" >
                                    <img class="w-100 payment-item__thumb-img"
                                    src="{{ getImage(getFilePath('gateway') . '/' . $data->method->image) }}" alt="@lang('payment-thumb')">
                                </div>
                            </div>
                            
                        </label>
                    @endforeach
                    <input class="payment-item__radio gateway-input" id="account_balance" hidden type="radio" name="gateway"
                                                    value="wallet" @if (old('gateway')) @checked(old('gateway') == 'wallet') @endif>
                                                    
                    <div class="card p-3 mb-24 border-0 shadow-sm">
                        <div class="card-body p-0">
                    
                            @if (!@$plan)
                                <div class="row align-items-center mb-2 hideInfo">
                                    <div class="col-6">
                                        <p class="text-muted mb-0 d-flex align-items-center">
                                            <i class="fas fa-arrows-alt-h me-2 text-primary"></i>
                                            @lang('Limit')
                                        </p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="fw-bold mb-0">
                                            <span class="gateway-limit text-dark">@lang('0.00')</span>
                                        </p>
                                    </div>
                                </div>
                                <hr class="my-3 hideInfo">
                            @endif
                    
                            <div class="row align-items-center mb-2 hideInfo">
                                <div class="col-6">
                                    <p class="text-muted mb-0 d-flex align-items-center">
                                        <i class="fas fa-percentage me-2 text-danger"></i>
                                        @lang('Processing Charge')
                                        <span data-bs-toggle="tooltip" title="@lang('Processing charge for payment gateways')" class="ms-1 proccessing-fee-info text-info">
                                            <i class="las la-info-circle"></i>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="fw-bold mb-0">
                                        <span class="processing-fee text-dark">@lang('0.00')</span>
                                        {{ __(gs('cur_text')) }}
                                    </p>
                                </div>
                            </div>
                    
                            <div class="row align-items-center pt-3 total-amount border-top border-secondary-subtle">
                                <div class="col-6">
                                    <p class="text-dark fw-bold mb-0">@lang('Total Payable')</p>
                                </div>
                                <div class="col-6 text-end">
                                    <h5 class="text-success mb-0">
                                        <span class="final-amount">@lang('0.00')</span>
                                        {{ __(gs('cur_text')) }}
                                    </h5>
                                </div>
                            </div>
                    
                            <div class="row align-items-center mt-3 pt-2 hideInfo gateway-conversion d-none total-amount border-top border-secondary-subtle">
                                <div class="col-6">
                                    <p class="text-muted mb-0">@lang('Conversion Rate')</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="text-primary fw-bold mb-0"></p>
                                </div>
                            </div>
                    
                            <div class="row align-items-center pt-2 hideInfo conversion-currency d-none total-amount">
                                <div class="col-6">
                                    <p class="text-muted mb-0">
                                        @lang('In') <span class="gateway-currency text-dark fw-bold"></span>
                                    </p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="text-primary fw-bold mb-0">
                                        <span class="in-currency"></span>
                                    </p>
                                </div>
                            </div>
                    
                            <div class="alert alert-warning d-none hideInfo crypto-message mt-3 mb-0" role="alert">
                                <i class="fas fa-exchange-alt me-2"></i>
                                @lang('Conversion with') <span class="gateway-currency fw-bold"></span> @lang('and final value will Show on next step')
                            </div>
                    
                        </div>
                    </div>
                    <button type="submit" class="tf-btn greyscale mb-4" >Deposit</button>
    
                </div>
            </form>
        </div>
    </div>
    
    
@endsection

@push('script')
    <script>
        "use strict";
        (function($) {

            // --- CHANGED SELECTION: Using .value_input instead of .amount ---
            var amount = parseFloat($('.value_input').val() || 0); 
            var plan = "{{ @$planId }}"
            var gateway, minAmount, maxAmount;



            function gatewayChange() {

                let gatewayElement = $('.gateway-input:checked');

                // --- NEW LOGIC: HIGHLIGHT SELECTED GATEWAY ---
                // Remove active class from all items
                $('.company-list-item').removeClass('active-gateway');
                // Add active class to the parent of the selected input
                gatewayElement.closest('.company-list-item').addClass('active-gateway');
                // ---------------------------------------------

                let methodCode = gatewayElement.val();
                let gatewayValue = $('.gateway-input:checked').val();

                if (gatewayValue == 'wallet') {
                    @if (auth()->user()->balance < @$plan->price)
                        $(".deposit-form button[type=submit]").attr('disabled', true);
                    @else
                        $(".deposit-form button[type=submit]").removeAttr('disabled');
                    @endif
                    var totalAmount = parseFloat('{{ @$plan->price }}');
                    $('.hideInfo').addClass('d-none')
                    $(".final-amount").text(totalAmount.toFixed(2));
                } else {
                    $(".deposit-form button[type=submit]").removeAttr('disabled');
                    $('.hideInfo').removeClass('d-none')

                    gateway = gatewayElement.data('gateway');
                    minAmount = gatewayElement.data('min-amount');
                    maxAmount = gatewayElement.data('max-amount');
                }
                let processingFeeInfo =
                    `${parseFloat(gateway.percent_charge).toFixed(2)}% with ${parseFloat(gateway.fixed_charge).toFixed(2)} {{ __(gs('cur_text')) }} charge for payment gateway processing fees`
                $(".proccessing-fee-info").attr("data-bs-original-title", processingFeeInfo);
                calculation();
            }




            // --- CHANGED SELECTION: Using .value_input instead of .amount ---
            $('.value_input').on('input', function(e) {
                amount = parseFloat($(this).val());

                if (!amount) {
                    amount = 0;
                }
                calculation();
            });


            $('.gateway-input').on('change', function(e) {
                gatewayChange();
            });



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


                if (!plan) {
                    $(".gateway-limit").text(minAmount + " - " + maxAmount);
                }


                let percentCharge = 0;
                let fixedCharge = 0;
                let totalPercentCharge = 0;

                if (amount) {
                    percentCharge = parseFloat(gateway.percent_charge);

                    fixedCharge = parseFloat(gateway.fixed_charge);
                    totalPercentCharge = parseFloat(amount / 100 * percentCharge);
                }

                let totalCharge = parseFloat(totalPercentCharge + fixedCharge);
                let totalAmount = parseFloat((amount || 0) + totalPercentCharge + fixedCharge);

                $(".final-amount").text(totalAmount.toFixed(2));
                $(".processing-fee").text(totalCharge.toFixed(2));
                $("input[name=currency]").val(gateway.currency);
                $(".gateway-currency").text(gateway.currency);

                @if (!$planId)
                    if (amount < Number(gateway.min_amount) || amount > Number(gateway.max_amount)) {
                        $(".deposit-form button[type=submit]").attr('disabled', true);
                    } else {
                        $(".deposit-form button[type=submit]").removeAttr('disabled');
                    }
                @endif

                if (gateway.currency != "{{ gs('cur_text') }}" && gateway.method.crypto != 1) {
                    $('.deposit-form').addClass('adjust-height')

                    $(".gateway-conversion, .conversion-currency").removeClass('d-none');
                    $(".gateway-conversion").find('.deposit-info__input .text').html(
                        `1 {{ __(gs('cur_text')) }} = <span class="rate">${parseFloat(gateway.rate).toFixed(2)}</span>  <span class="method_currency">${gateway.currency}</span>`
                    );
                    $('.in-currency').text(parseFloat(totalAmount * gateway.rate).toFixed(gateway.method.crypto == 1 ?
                        8 : 2))
                } else {
                    $(".gateway-conversion, .conversion-currency").addClass('d-none');
                    $('.deposit-form').removeClass('adjust-height')
                }

                if (gateway.method.crypto == 1) {
                    $('.crypto-message').removeClass('d-none');
                } else {
                    $('.crypto-message').addClass('d-none');
                }
            }

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
            $('.gateway-input').change();
        })(jQuery);
    </script>
@endpush