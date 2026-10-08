@extends($activeTemplate . 'layouts.dashboard')
@section('content')
    
    <div class="card-payment mb-24">
        <div class="image-item">
            <img loading="lazy" alt="img" src="{{ asset('assets/templates/payqra') }}/images/icons/img-item-1.png">
        </div>
        <div class="image-item item-2">
            <img loading="lazy" alt="img" src="{{ asset('assets/templates/payqra') }}/images/icons/img-item-2.png">
        </div>
        <div class="top-card d-flex align-items-center justify-content-between">
            <div class="left">
                <div class="text fw-5 text-medium">
                    Available Balance
                </div>
                <div class="price fw-6">
                    {{ showAmount($user->balance) }}
                </div>
            </div>
            <div class="right">
                <img class="w-50" style="float: right;" src="{{ siteLogo() }}" >
            </div>
        </div>
        <div class="bottom-card">
            <div class="left">
            </div>
            <div class="right">
                <a href="{{ route('user.transactions') }}" class="btn-my-report">
                    <span>My Transactions</span>
                    <div class="icon"><i class="icon-direction-right"></i></div>
                </a>
            </div>
        </div>
    </div>
    <div class="list-box-icon mb-24">
        <a href="{{ route('user.deposit.index') }}" class="box-icon top-up">
            <div class="icon">
                <i class="icon-mobile-payment"></i>
            </div>
            <span class="text text-medium fw-5">Top Up</span>
        </a>

        <a href="{{ route('user.withdraw') }}" class="box-icon transfer">
            <div class="icon">
                <i class="icon-money-send"></i>
            </div>
            <span class="text text-medium fw-5">Withdraw</span>
        </a>
        <a href="{{ route('user.transactions') }}" class="box-icon request">
            <div class="icon">
                <i class="icon-group"></i>
            </div>
            <span class="text text-medium fw-5">Transactions</span>
        </a>
    </div>
    
    
            
    <div class="wg-frequently-contacts mb-24">
        <div class="d-flex justify-content-between align-items-center mb-16 heading-wg">
            <h6 class="title fw-6">Stats</h6>
        </div>
        <div class="card-payment v2 bg-color-white mb-24">
            <div class="d-flex justify-content-between">
                <div class="left">
                    <div class="text fw-5 text-medium">
                        Total Deposit
                    </div>
                    <div class="price fw-6">
                        {{ showAmount($user->deposits->sum('amount')) }}
                    </div>
                </div>
                <div class="right">
                    <a href="{{ route('user.deposit.history') }}" >
                        <div class="btn" style="background-color: var(--primary);;"><i class="icon-direction-right text-white"></i></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-payment v2 bg-color-white mb-24">
            <div class="d-flex justify-content-between">
                <div class="left">
                    <div class="text fw-5 text-medium">
                        Total Withdraw
                    </div>
                    <div class="price fw-6">
                        {{ showAmount($user->withdrawals->where('status', 1)->sum('amount')) }}
                    </div>
                </div>
                <div class="right">
                    <a href="{{ route('user.withdraw.history') }}" >
                        <div class="btn" style="background-color: var(--primary);;"><i class="icon-direction-right text-white"></i></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-payment v2 bg-color-white mb-24">
            <div class="d-flex justify-content-between">
                <div class="left">
                    <div class="text fw-5 text-medium">
                        Total Earned
                    </div>
                    <div class="price fw-6">
                        {{ showAmount($user->earnings->sum('amount')) }}
                    </div>
                </div>
                <div class="right">
                    <a href="{{ route('user.earnings') }}" >
                        <div class="btn" style="background-color: var(--primary);;"><i class="icon-direction-right text-white"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="wg-transaction-history">
        <div class="tf-container">
            <div class="d-flex justify-content-between align-items-center mb-16 heading-wg">
                <h6 class="title fw-6">Transaction History</h6>
                <a href="{{ route('user.transactions') }}">View All</a>
            </div>
            <ul class="list">
                @forelse($trxs as $trx)
                <li>
                    <a href="{{ route('user.transactions') }}" class="box-transaction-item">
                        <div class="content" style="max-width: 100%;">
                            <div class="top d-flex justify-content-between align-items-center w-100">
                                <p class="name fw-6">
                                    {{-- Conditional Logic for Remark --}}
                                    @if ($trx->remark == 'ptc_earn')
                                        @lang('Earnings')
                                    @elseif ($trx->remark == 'withdraw')
                                        @lang('Withdraw')
                                    @elseif ($trx->remark == 'subscribe_plan')
                                        @lang('Plan Subscription')
                                    @elseif ($trx->remark == 'deposit' || $trx->remark == 'balance_add')
                                        @lang('Deposit')
                                    @else
                                        {{ __($trx->remark) }}
                                    @endif
                                </p>
                                <p class="price fw-5 @if ($trx->trx_type == '+') text-success @else text-danger @endif ">
                                    {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                                </p>
                            </div>
                            <div class="bottom d-flex justify-content-between align-items-center">
                                <p class="text-medium">{{ diffForHumans($trx->created_at) }}</p>
                            </div>
                        </div>
                    </a>
                </li>
                @empty
                <li>
                    <a href="" class="box-transaction-item">
                        <div class="content">
                            <div class="top d-flex justify-content-between align-items-center">
                                <p class="name fw-6">No transactions</p>
                            </div>
                    </a>
                </li>
                @endforelse
            </ul>
        </div>
    </div>
    


@endsection
@push('script')
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            // apex-bar-chart js
            var options = {
                series: [{
                    name: 'Clicks',
                    data: [
                        @foreach ($chart['click'] as $key => $click)
                            {{ $click }},
                        @endforeach
                    ]
                }, {
                    name: 'Earn Amount',
                    data: [
                        @foreach ($chart['amount'] as $key => $amount)
                            {{ $amount }},
                        @endforeach
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 455,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: [
                        @foreach ($chart['amount'] as $key => $amount)
                            '{{ $key }}',
                        @endforeach
                    ],
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#apex-bar-chart"), options);
            chart.render();

            function createCountDown(elementId, sec) {
                var tms = sec;
                var x = setInterval(function() {
                    var distance = tms * 1000;
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById(elementId).innerHTML = days + "d: " + hours + "h " + minutes +
                        "m " + seconds + "s ";
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById(elementId).innerHTML = "{{ __('COMPLETE') }}";
                    }
                    tms--;
                }, 1000);
            }
            createCountDown('counter', {{ \Carbon\Carbon::tomorrow()->diffInSeconds() }});
        })(jQuery);
    </script>
@endpush
