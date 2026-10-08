<header class="header {{ request()->routeIs('home') ? 'transparent-header' : '' }}">
    <div class="header__top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">


                @if (gs('multi_language'))
                    @php
                        $langs = App\Models\Language::all();
                        $defaultLanguage = App\Models\Language::where('code', config('app.locale'))->first();
                    @endphp
                    <div class="custom--dropdown">
                        <div class="custom--dropdown__selected dropdown-list__item gap-2">
                            <div class="thumb">
                                <img src="{{ getImage(getFilePath('language') . '/' . @$defaultLanguage->image) }}"
                                    alt="img">
                            </div>
                            <span class="text">{{ strtoupper($defaultLanguage->code) }}</span>
                        </div>
                        <ul class="dropdown-list">
                            @foreach ($langs as $lang)
                                <li class="dropdown-list__item">
                                    <a href="{{ route('lang', @$lang->code) }}" class="d-flex gap-2 flex-wrap align-content-center thumb flex-md-nowrap">
                                        <img src="{{ getImage(getFilePath('language') . '/' . @$lang->image) }}"
                                            alt="lang-img">
                                        <span class="text">{{ strtoupper($lang->code) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                @endif
                <ul>
                    <div class="right text-sm-end text-center">
                        @guest
                            <a href="{{ route('user.login') }}" class="me-2"><i class="las la-sign-in-alt"></i>
                                @lang('Login')</a>
                            <a href="{{ route('user.register') }}"><i class="las la-user-plus"></i>
                                @lang('Registration')</a>
                        @else
                            <a href="{{ route('user.home') }}"><i class="las la-user-plus"></i>
                                @lang('Dashboard')</a>
                        @endguest
                    </div>
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container">
            <nav class="navbar navbar-expand-xl p-0 align-items-center">
                <a class="site-logo site-title" href="{{ route('home') }}"><img src="{{ siteLogo() }}"
                        alt="site-logo"><span class="logo-icon"><i class="flaticon-fire"></i></span></a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu-toggle"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav main-menu ms-auto">
                        <li><a href="{{ route('home') }}">@lang('Home')</a></li>
                        @php
                            $pages = App\Models\Page::where('tempname', $activeTemplate)
                                ->where('is_default', Status::NO)
                                ->get();
                        @endphp
                        @foreach ($pages as $page)
                            @if ($page->slug != 'home' && $page->slug != 'blog' && $page->slug != 'contact')
                                <li><a href="{{ route('pages', $page->slug) }}">{{ __($page->name) }}</a>
                                </li>
                            @endif
                        @endforeach
                        <li><a href="{{ route('plans') }}">@lang('Plans')</a></li>
                        <li><a href="{{ route('blog') }}">@lang('Blog')</a></li>
                    </ul>
                    <div class="nav-right">
                        <a href="{{ route('contact') }}" class="cmn-btn style--three">@lang('Contact')</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
<div class="notice" ></div>
