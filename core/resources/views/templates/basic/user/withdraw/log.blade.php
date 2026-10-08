@extends($activeTemplate . 'layouts.simple')
@section('content')
<div class="wrap">
    <div class="wg-setting">
        <div class="top-wg">

            {{-- Header Section --}}
            <div class="header-2 header-fix bg-primary-100">
                {{-- Passing 'Withdraw History' as the title --}}
                @include($activeTemplate . 'partials.simple_header', ['title' => 'Withdraw History'])
            </div>

        </div>
        
        <div class="tf-container mb-5 pt-80">
    
            {{-- Withdraw List Section (adapted for minimalist/mobile view) --}}
            @if (!blank($withdraws))
                <div class="list-setting-item transaction-list">
                    @foreach ($withdraws as $withdraw)
                        <div class="transaction-item mb-3 p-3 bg-white border-radius-sm shadow-sm">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1 me-2">
                                    {{-- Gateway Name and Status (Primary Info) --}}
                                    <span class="text-medium fw-5 mb-1 d-block text-primary">
                                        {{ __(@$withdraw->method->name) }}
                                    </span>
                                    <small class="text-muted d-block">@lang('Initiated'): {{ showDateTime($withdraw->created_at, 'M d, Y') }}</small>
                                    <div class="mt-1">
                                        @php echo $withdraw->statusBadge @endphp
                                    </div>
                                </div>
                                <div class="text-end">
                                    {{-- Amount and Charge (Financial Info) --}}
                                    <span class="fw-bold fs-5 text-danger">
                                        - {{ showAmount($withdraw->amount) }}
                                    </span>
                                    <small class="text-muted d-block" title="@lang('Amount') - @lang('Charge')">
                                        {{ showAmount($withdraw->amount) }} - <span class="text-danger">{{ showAmount($withdraw->charge) }}</span>
                                    </small>
                                </div>
                            </div>
                            
                            <div class="mt-2 pt-2 border-top">
                                {{-- Net Amount and Conversion Rate --}}
                                <div class="d-flex justify-content-between text-small fw-bold">
                                    <span>@lang('Net Payable'):</span>
                                    <span class="text-success">
                                        {{ showAmount($withdraw->amount - $withdraw->charge) }} {{ __(gs('cur_text')) }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between text-small text-muted mt-1">
                                    <span>@lang('Exchange Rate'):</span>
                                    <span>1 {{ __(gs('cur_text')) }} = {{ showAmount($withdraw->rate, currencyFormat:false) }} {{ __($withdraw->currency) }}</span>
                                </div>
                                <div class="d-flex justify-content-between text-small mt-1 fw-bold">
                                    <span>@lang('Final Withdrawal'):</span>
                                    <span>{{ showAmount($withdraw->final_amount, currencyFormat:false) }} {{ __($withdraw->currency) }}</span>
                                </div>
                                
                                {{-- Transaction ID and Details Button --}}
                                <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                                    <small class="text-small d-block">@lang('Trx ID'): **{{ $withdraw->trx }}**</small>
                                    
                                    <div>
                                        <button class="btn btn-sm btn-primary-100 detailBtn"
                                            data-user_data="{{ json_encode($withdraw->withdraw_information) }}"
                                            @if ($withdraw->status == Status::PAYMENT_REJECT) data-admin_feedback="{{ $withdraw->admin_feedback }}" @endif>
                                            <i class="icon-eye"></i> @lang('Details')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card">
                    <div class="card-body p-0">
                        @include($activeTemplate . 'partials.empty', [
                            'message' => 'Withdraw not found',
                        ])
                    </div>
                </div>
            @endif
        
            {{-- Pagination --}}
            @if ($withdraws->hasPages())
                <div class="mt-4">
                    {{ paginateLinks($withdraws) }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Footer Nav (from the simple template) --}}
@include($activeTemplate . 'partials.footer_nav')


{{-- DETAIL MODAL --}}
<div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Withdraw Details')</h5>
                <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <div class="modal-body">
                <ul class="list-group userData">
                </ul>
                <div class="feedback"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');
                // Note: Using data('user_data') for withdraw information
                var userData = $(this).data('user_data'); 
                var html = ``;
                
                if (userData) {
                    userData.forEach(element => {
                        // Displaying non-file fields in the modal
                        if (element.type != 'file') {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${element.name}</span>
                                <span class="fw-bold">${element.value}</span>
                            </li>`;
                        }
                    });
                }
                
                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3 p-3 bg-light border-radius-sm">
                            <strong class="text-danger">@lang('Admin Feedback')</strong>
                            <p class="mt-1">${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }

                modal.find('.feedback').html(adminFeedback);

                modal.modal('show');
            });
            
            // Initialize tooltips (optional, but good practice if using them)
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        /* Adapt search input height to match simple design inputs if necessary */
        .search-form .form-control {
            height: 44px; 
            border-radius: 8px 0 0 8px;
        }
        .search-form .input-group-text {
            height: 44px; 
            border-radius: 0 8px 8px 0;
        }
        
        /* Ensure the withdrawal items look like clean, separate cards/list items */
        .transaction-list .transaction-item {
            border: 1px solid #eee; /* Subtle border for separation */
        }
    </style>
@endpush