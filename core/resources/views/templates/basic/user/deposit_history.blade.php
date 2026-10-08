@extends($activeTemplate . 'layouts.simple')
@section('content')
<div class="wrap">
    <div class="wg-setting">
        <div class="top-wg mb-20">

            {{-- Header Section --}}
            <div class="header-2 header-fix bg-primary-100">
                {{-- Passing 'Deposit History' as the title --}}
                @include($activeTemplate . 'partials.simple_header', ['title' => 'Deposit History'])
            </div>
        </div>
    </div>
</div>

<div class="tf-container mb-5">

    {{-- Deposit List Section (adapted for minimalist/mobile view) --}}
    @if (!blank($deposits))
        <div class="list-setting-item transaction-list">
            @foreach ($deposits as $deposit)
                @php
                    // Define Status Text and Class based on $deposit->status
                    $statusText = '';
                    $statusClass = '';
                    if ($deposit->status == 1) {
                        $statusText = 'Success';
                        $statusClass = 'badge--success';
                    } elseif ($deposit->status == 2) {
                        $statusText = 'Pending';
                        $statusClass = 'badge--warning';
                    } elseif ($deposit->status == 3) {
                        $statusText = 'Cancelled';
                        $statusClass = 'badge--danger';
                    } else {
                        $statusText = 'Rejected';
                        $statusClass = 'badge--dark';
                    }

                    // Prepare details for the modal
                    $details = [];
                    if ($deposit->method_code >= 1000 && $deposit->method_code <= 5000) {
                        foreach (@$deposit->detail ?? [] as $key => $info) {
                            $details[$key] = $info;
                            if ($info->type == 'file') {
                                $details[$key]->value = route(
                                    'user.download.attachment',
                                    encrypt(getFilePath('verify') . '/' . $info->value),
                                );
                            }
                        }
                    }
                @endphp

                <div class="transaction-item mb-3 p-3 bg-white border-radius-sm shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1 me-2">
                            {{-- Gateway Name and Status (Primary Info) --}}
                            <span class="text-medium fw-5 mb-1 d-block text-primary">
                                {{ __($deposit->gateway?->name) }}
                            </span>

                            <small class="text-muted d-block mt-1">@lang('Initiated'): {{ showDateTime($deposit->created_at, 'M d, Y') }} - {{ diffForHumans($deposit->created_at) }}</small>
                        </div>
                        <div class="text-end">
                            {{-- Amount and Conversion (Financial Info) --}}
                            <span class="fw-bold fs-5 text-success">
                                + {{ showAmount($deposit->amount + $deposit->charge) }} {{ __(gs('cur_sym')) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-2 pt-2 border-top">
                        {{-- Conversion Rate and Final Amount (Secondary Info) --}}
                        <div class="d-flex justify-content-between text-small text-muted">
                            <span>@lang('Conversion Rate'):</span>
                            <span>1 {{ __(gs('cur_text')) }} = {{ showAmount($deposit->rate, decimal:4, currencyFormat: false) }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-small mt-1 fw-bold">
                            <span>@lang('Final Amount'):</span>
                            <span>{{ showAmount($deposit->final_amount, currencyFormat: false) }} {{ __($deposit->method_currency) }}</span>
                        </div>
                        
                        {{-- Transaction ID and Details Button --}}
                        <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                             <small class="text-small d-block">@lang('Trx ID'): **{{ $deposit->trx }}**</small>
                             
                             <span class="badge {{ $statusClass }} py-1 px-2 text-small">{{ __($statusText) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card">
            <div class="card-body p-0">
                @include($activeTemplate . 'partials.empty', [
                    'message' => 'Deposit not found !',
                ])
            </div>
        </div>
    @endif

    {{-- Pagination --}}
    <div class="mt-4">
        {{ paginateLinks($deposits) }}
    </div>
</div>

{{-- MODAL FOR DEPOSIT DETAILS (REQUIRED BY JAVASCRIPT) --}}
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">@lang('Deposit Details')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group userData list-group-flush">
                    {{-- User Data will be inserted here by JS --}}
                </ul>
                <div class="feedback">
                    {{-- Admin Feedback will be inserted here by JS --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
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
                var userData = $(this).data('info');
                var html = '';
                
                // Clear previous data
                modal.find('.userData').empty();
                modal.find('.feedback').empty();

                if (userData) {
                    userData.forEach(element => {
                        // Display non-file types directly
                        if (element.type != 'file') {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">${element.name}</span>
                                <span class="fw-bold">${element.value}</span>
                            </li>`;
                        }
                    });
                }

                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined && $(this).data('admin_feedback') != '') {
                    var adminFeedback = `
                        <div class="my-3 p-3 bg-light border-radius-sm">
                            <strong class="text-danger">@lang('Admin Feedback')</strong>
                            <p class="mt-1">${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                    modal.find('.feedback').html(adminFeedback);
                }

                modal.modal('show');
            });
            
            // Add Font Awesome dependency if it's not in the main layout
            if (typeof fontawesome !== 'undefined') {
                 // Nothing to do, Font Awesome is loaded
            } else {
                 // For status badges and detail button icons
                 $('head').append('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />');
            }


        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        /* Define custom badge colors (assuming --primary-color, etc., are defined in the template) */
        .badge {
            font-size: 0.75em;
            font-weight: 600;
            padding: 0.4em 0.8em;
            border-radius: 0.25rem;
        }

        .badge--success {
            color: #155724;
            background-color: #d4edda;
        }
        .badge--warning {
            color: #856404;
            background-color: #fff3cd;
        }
        .badge--danger {
            color: #721c24;
            background-color: #f8d7da;
        }
        .badge--dark {
            color: #000;
            background-color: #c9c9c9;
        }

        /* Ensure the deposit items look like clean, separate cards/list items */
        .transaction-list .transaction-item {
            border: 1px solid #eee; /* Subtle border for separation */
        }
    </style>
@endpush