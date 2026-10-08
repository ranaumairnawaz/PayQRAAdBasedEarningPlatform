@extends($activeTemplate . 'layouts.simple')
@section('content')
<div class="wrap">
    <div class="wg-setting">
        <div class="top-wg mb-20">
            
            {{-- Modified Header Section --}}
            <div class="header-2 header-fix bg-primary-100">
                {{-- Assuming simple_header handles the back button/title for the page --}}
                @include($activeTemplate . 'partials.simple_header', ['title' => 'Transaction Log'])
            </div>
        </div>
    </div>
</div>

<div class="tf-container mb-5">
    
    {{-- Transaction List Section (adapted for minimalist/mobile view) --}}
    @if (!blank($transactions))
        <div class="list-setting-item transaction-list">
            @foreach ($transactions as $trx)
                <div class="transaction-item mb-3 p-3 bg-white border-radius-sm shadow-sm">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-medium fw-5 mb-1 d-block">{{ __($trx->details) }}</span>
                            <small class="text-muted d-block">{{ showDateTime($trx->created_at, 'M d, Y') }} - {{ diffForHumans($trx->created_at) }}</small>
                        </div>
                        <div class="text-end">
                            <span class="fw-bold fs-5 @if ($trx->trx_type == '+') text-success @else text-danger @endif">
                                {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                            </span>
                            <small class="text-muted d-block">@lang('Balance'): {{ showAmount($trx->post_balance) }}</small>
                        </div>
                    </div>
                    <div class="mt-2 pt-2 border-top">
                        <small class="text-small d-block">@lang('Trx ID'): **{{ $trx->trx }}**</small>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card">
            <div class="card-body p-0">
                {{-- Assuming you have a style for the empty partial that fits the new design --}}
                @include($activeTemplate . 'partials.empty', ['message' => 'Transaction not found'])
            </div>
        </div>
    @endif
    
    {{-- Pagination --}}
    <div class="mt-4">
        {{ paginateLinks($transactions) }}
    </div>
</div>

@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            // Initialize select2 for the filter dropdowns
            $('.select2-basic').select2({
                dropdownParent: $('.responsive-filter-card')
            });

            // Toggle filter card visibility for the "simple" design
            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        /* Adapt select2 for the simple style */
        .select2-container .select2-selection--single {
            height: 44px !important; /* Matches form-control style-1 height */
            border: 1px solid #e5e5e5 !important;
            border-radius: 8px !important;
            line-height: 44px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 44px !important;
            padding-left: 15px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 42px !important;
        }

        .responsive-filter-card {
            display: none; /* Hidden by default, shown by JS */
        }
        
        /* Ensure the transaction items look like clean, separate cards/list items */
        .transaction-list .transaction-item {
            border: 1px solid #eee; /* Subtle border for separation */
        }
    </style>
@endpush