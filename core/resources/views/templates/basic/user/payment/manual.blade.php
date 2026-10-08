@extends($activeTemplate.'layouts.simple')
@section('content')
<style>
    /* Container for the whole component */
.custom-file-input-wrapper {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

/* 1. Hide the ugly default browser input */
.file-input-hidden {
    /* Hide visually but keep it accessible */
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    width: 0.1px;
}

/* 2. Style the Label (The new, visible button) */
.file-input-label {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 15px;
    border: 1px solid #ccc; /* Light border */
    border-radius: 6px; /* Rounded corners */
    background-color: #f7f7f7; /* Light background */
    cursor: pointer;
    transition: background-color 0.2s, border-color 0.2s;
    width: fit-content; /* Make it fit the content, not stretch across */
    font-weight: 600;
    color: #333;
}

/* Hover effect for a modern feel */
.file-input-label:hover {
    background-color: #e9e9e9;
    border-color: #999;
}

/* Focus state (when the user tabs to the hidden input) */
.file-input-hidden:focus + .file-input-label {
    outline: 2px solid #007bff; /* Custom focus ring */
    outline-offset: 2px;
}

/* 3. Style the Display Area for the file name */
.file-name-display {
    padding: 8px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #fff;
    font-size: 0.9em;
    color: #666;
    margin-top: 5px;
}

/* 4. Style the Supported Mimes Text */
.supported-mimes {
    font-size: 0.85em;
    color: #999;
    margin-top: 5px;
}
</style>
<div class="wrap">
    <div class="wg-top-up pb-63">

        <div class="header-2 header-fix style-bg-1 mb-12">
            @include($activeTemplate . 'partials.simple_header')
        </div>
    </div>
    
    <div class="card m-3" >
        <div class="card-body p-3 d-flex justify-content-between align-items-center" >
            <div class="text-left" >
                <span class="text-medium fw-5">{{ $gateway->name }}</span>
            </div>
            <div style="width: 10%;" >
                <img src="{{ getImage(getFilePath('gateway') . '/' . $gateway->image) }}" alt="">
            </div>
        </div>
    </div>
    
    <div class="card m-3 mb-5">
        <div class="card-body p-3">
            
            @foreach($account_values as $value)
                <fieldset class="mb-12">
                    <p>{{ $value->val_name }}</p>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="text" 
                               value="{{ $value->val_value }}" 
                               id="copy{{ $value->id }}" 
                               readonly>
                        
                        <button type="button" 
                                class="copy-btn w-25" 
                                data-target-id="copy{{ $value->id }}" 
                                onclick="copyToClipboard(this)">
                            <i class="fa fa-clipboard" ></i>
                        </button>
                    </div>
                </fieldset>
            @endforeach
            
            <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-viser-form identifier="id" identifierValue="{{ $gateway->form_id }}" />
            
                <p class="mb-0 mt-3"><i class="las la-info-circle"></i> @lang('You are requesting') <b>{{ showAmount($data['amount'])  }}</b> @lang('to deposit.') @lang('Please pay')
                                            <b>{{showAmount($data['final_amount'],currencyFormat:false) .' '.$data['method_currency'] }} </b> @lang('for successful payment.')</p>
                                            
                <button type="submit" class="tf-btn greyscale mb-4 mt-4" >Confirm</button>
            </form>
        </div>
    </div>
</div>

<div class="mb-5 mt-5" ></div>

<script>
    function copyToClipboard(buttonElement) {
        const targetId = buttonElement.getAttribute('data-target-id');
        const copyText = document.getElementById(targetId);
        const iconElement = buttonElement.querySelector('.fa'); // Select the Font Awesome icon inside the button

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        // Function to handle visual feedback
        const showFeedback = () => {
            // Change icon to fa-check (or fa-check-square) for success
            iconElement.classList.remove('fa-clipboard');
            iconElement.classList.add('fa-check');
            // Optional: You could also change the button color here if you like

            // Revert icon after 1.5 seconds
            setTimeout(() => {
                iconElement.classList.remove('fa-check');
                iconElement.classList.add('fa-clipboard');
            }, 1500);
        };

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(copyText.value)
                .then(showFeedback)
                .catch(err => {
                    console.error('Could not copy text: ', err);
                });
        } 
        else {
            document.execCommand("copy");
            showFeedback();
        }
    }
</script>


@endsection
