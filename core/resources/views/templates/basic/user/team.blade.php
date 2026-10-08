@extends($activeTemplate . 'layouts.simple')
@section('content')

<div class="wrap">
        <div class="wg-send-request">
            <div class="top-page-send-request send mb-20">
                <div class="header-2 header-fix style-bg-1">
                    @include($activeTemplate . 'partials.simple_header')
                </div>
                <div class="tf-container">

                    <div class="content pt-80">
                        <h5 class="name-send fw-7">{{ $user->firstname }}</h5>
                        <p class="number-card text-medium mb-16">{{ $user->team_code }}</p>
                        <fieldset class="price-send">
                            <div style="display: flex; gap: 10px; align-items: center;">
                                <input 
                                    type="text" 
                                    name="price-send" 
                                    id="price-send" 
                                    value="{{ route('home') }}?reference={{ $user->team_code }}"
                                    readonly {{-- Prevent users from editing the referral link --}}
                                >
                                
                                <button 
                                    type="button" style="width: 15%; color: var(--white);background-color: var(--bg-5);border-radius: 999px; padding: 18px 20px; font-size: 28px; border: 0px;" 
                                    data-target-id="price-send" 
                                    onclick="copyToClipboard(this)">
                                    <i class="fa fa-clipboard" ></i>
                                </button>
                            </div>
                        </fieldset>
                        <p class="fw-5 text-medium mb-16">Referral link</p>
                    </div>
                </div>
            </div>

            <div class="bottom-page-send-request">
                <div class="tf-container">
                    <h5 class="name-send fw-7 text-center">My Team</h5>
                    @if($user->allReferrals->count() > 0 && $maxLevel > 0)
                        <div class="treeview-container">
                            <ul class="treeview">
                              <li class="items-expanded"> {{ $user->fullname }} ( {{ $user->username }} )
                                    @include($activeTemplate.'partials.under_tree',['user'=>$user,'layer'=>0,'isFirst'=>true])
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @include($activeTemplate . 'partials.footer_nav')
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

@push('style-lib')
    <link href="{{ asset('assets/global/css/jquery.treeView.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/jquery.treeView.js') }}"></script>
@endpush