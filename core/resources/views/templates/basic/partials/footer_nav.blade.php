<div style="background-color: white;" class="menubar-footer footer-fixed bg-color-white">
    <div class="d-flex justify-content-between">
        <div class="left inner-bar position-relative">
            <a href="{{ route('user.home') }}" class="inner-bar-item {{ request()->routeIs('user.home') ? 'active' : '' }}">
                <i class="icon-home"></i>
                <span class="text-small fw-5">Home</span>
            </a>
            <a href="{{ route('user.plans') }}" class="inner-bar-item {{ request()->routeIs('user.plans') ? 'active' : '' }}" >
                <i class="icon-card"></i>
                <span class="text-small fw-5">Plans</span>
            </a>
            <a href="{{ route('user.ptc.index') }}" class="inner-bar-item {{ request()->routeIs('user.ptc.index') ? 'active' : '' }}" >
                <i class="fa fa-external-link"></i>
                <span class="text-small fw-5">Earn</span>
            </a>
            <a href="{{ route('user.team') }}" class="inner-bar-item {{ request()->routeIs('user.team') ? 'active' : '' }}">
                <i class="fa fa-users"></i>
                <span class="text-small fw-5">Team</span>
            </a>
            <a href="{{ route('user.profile.index') }}" class="inner-bar-item {{ request()->routeIs('user.profile.index') ? 'active' : '' }}">
                <i class="icon-profile"></i>
                <span class="text-small fw-5">Profile</span>
            </a>
        </div>
    </div>
</div>

<div class="modal fade modalLeft pop-up-notifications" id="pop-up-notifications">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="wg-list-notifications overflow-auto">
                <div class="header-2 mb-12 header-fix">
                    <div class="tf-container">
                        <div class="header-content">
                            <a href="#" class="tf-btn-arrow" data-bs-dismiss="modal">
                                <i class="icon-arrow-narrow-left"></i>
                            </a>
                            <h6 class="title fw-5">
                                Notification
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="wg-tab style-2">
                    <div class="tab-slide">
                        <ul class="tab-product" role="tablist">
                            <li class="item-slide-effect"></li>
                            <li class="nav-tab-item nav-item active" role="presentation">
                                <a href="#tab1" data-bs-toggle="tab" role="tab"
                                    class="nav-link active text-small">All</a>
                            </li>
                            <li class="nav-tab-item nav-item" role="presentation">
                                <a href="#tab2" data-bs-toggle="tab" role="tab" class="nav-link text-small">Remind</a>
                            </li>
                            <li class="nav-tab-item nav-item" role="presentation">
                                <a href="#tab3" data-bs-toggle="tab" role="tab"
                                    class="nav-link text-small">Transaction</a>
                            </li>
                            <li class="nav-tab-item nav-item" role="presentation">
                                <a href="#tab4" data-bs-toggle="tab" role="tab" class="nav-link text-small">Promotion</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active show" id="tab1" role="tabpanel">
                        <a href="#" class="notifications-item">
                            <div class="img-icon">
                                <i class="icon-logo-notifications"></i>
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon">
                                <i class="icon-logo-notifications"></i>
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon">
                                <i class="icon-logo-notifications"></i>
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon">
                                <i class="icon-logo-notifications"></i>
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                    </div>
                    <div class="tab-pane" id="tab2" role="tabpanel">
                        
                        <a href="#" class="notifications-item">
                            <div class="img-icon">
                                <i class="icon-logo-notifications"></i>
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon">
                                <i class="icon-logo-notifications"></i>
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                    </div>
                    <div class="tab-pane" id="tab3" role="tabpanel">
                       
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon">
                                <i class="icon-logo-notifications"></i>
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                    </div>
                    <div class="tab-pane" id="tab4" role="tabpanel">
                        <a href="#" class="notifications-item">
                            <div class="img-icon">
                                <i class="icon-logo-notifications"></i>
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon">
                                <i class="icon-logo-notifications"></i>
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                        <a href="#" class="notifications-item">
                            <div class="img-icon image">
                                <img loading="lazy" alt="img" width="48" height="48"
                                    src="images/avartar/avartar-13.jpg">
                            </div>
                            <div class="content">
                                <p class="title fw-7">
                                    Discount Available
                                </p>
                                <p class="text text-medium">We recommend a 5% discount for <span
                                        class="fw-7">Tesla
                                        Model X</span> in San Fransisco.</p>
                                <p class="time-notifications text-small"><i class="icon-clock"></i> Jun 12, 2022
                                    at
                                    02:00 PM</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modalRight pop-up-menu-mobile" id="menu-mobile">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-sidebar">
            <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            <div class="sidebar-header">
                <a href="{{ route('user.home') }}" class="w-100 text-center">
                    <img src="{{ siteLogo() }}" class="w-50" alt="img">
                </a>
            </div>
            <div class="sidebar-content">
                <ul class="pt-20 pb-20">
                    <li class="mt-18 ">
                        <a href="{{ route('user.home') }}" class="nav-link-item no-page"><span>Home</span></a>
                    </li>
                    <li class="mt-16">
                        <a href="{{ route('user.team') }}" class="nav-link-item no-page">
                            <span>Team</span>
                        </a>
                    </li>
                    <li class="mt-16">
                        <a href="javascript:void(0);" class="nav-link-item btn-choose-component">
                            <span>Transtions</span>
                        </a>
                    </li>

                    <li class="mt-16">
                        <a href="{{ route('user.profile.index') }}" class="nav-link-item no-page">
                            <span>Profile</span>
                        </a>
                    </li>

                    <li class="mt-16">
                        <a href="{{ route('user.logout') }}" class="nav-link-item no-page">
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modalRight" id="modalComponent">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-second">
            <div class="header-2 mb-0">
                <div class="tf-container">
                    <div class="header-content">
                        <a href="javascript:void(0);" class="tf-btn-arrow" data-bs-dismiss="modal">
                            <i class="icon-arrow-narrow-left"></i>
                        </a>
                        <h6>Transactions</h6>
                    </div>
                </div>
            </div>
            <div class="overflow-auto pb-32">
                <div class="tf-container">
                    <ul>
                        <li><a href="{{ route('user.deposit.history') }}" class="nav-link-item pt-16 pb-16 line-bt no-page">
                                <span>Deposit History</span>
                            </a></li>
                        <li><a href="{{ route('user.withdraw.history') }}" class="nav-link-item pt-16 pb-16 line-bt no-page">
                                <span>Withdraw History</span>
                            </a></li>
                        <li><a href="{{ route('user.earnings') }}" class="nav-link-item pt-16 pb-16 line-bt no-page">
                                <span>Earnings</span>
                            </a></li>
                        <li><a href="{{ route('user.transactions') }}" class="nav-link-item pt-16 pb-16 line-bt no-page">
                                <span>All Transactions</span>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modalDown pop-up-more-services" id="more-services">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="wg-more-services">
                <div class="tf-container">
                    <div class="divider mb-24"></div>
                    <h5 class="title mb-24">More Services</h5>
                    <div class="list-box-icon mb-24">
                        <a href="top-up.html" class="box-icon v3">
                            <div class="icon">
                                <i class="icon-top-up"></i>
                            </div>
                            <span class="text text-medium fw-5">Top Up</span>
                        </a>
                        <a href="select-contact-all-contact-send.html" class="box-icon v3">
                            <div class="icon">
                                <i class="icon-transfer"></i>
                            </div>
                            <span class="text text-medium fw-5">Transfer</span>
                        </a>
                        <a href="top-up.html" class="box-icon v3">
                            <div class="icon">
                                <i class="icon-withdraw"></i>
                            </div>
                            <span class="text text-medium fw-5">Withdraw</span>
                        </a>
                    </div>
                    <div class="list-box-icon">
                        <a href="qr-code.html" class="box-icon v3">
                            <div class="icon">
                                <i class="icon-mobile-pay"></i>
                            </div>
                            <span class="text text-medium fw-5">Mobile Pay</span>
                        </a>
                        <a href="qr-code.html" class="box-icon v3">
                            <div class="icon">
                                <i class="icon-scan-2"></i>
                            </div>
                            <span class="text text-medium fw-5">Scan</span>
                        </a>
                        <a href="history.html" class="box-icon v3">
                            <div class="icon">
                                <img src="images/icons/pay-bill-2.svg" alt="">
                            </div>
                            <span class="text text-medium fw-5">History</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>