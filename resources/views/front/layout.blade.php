<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('style')

    <!-- script
    ================================================== -->
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script defer src="{{ asset('js/fontawesome/all.min.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

</head>

<body id="top">


    <!-- preloader
    ================================================== -->
    <div id="preloader">
    	<div id="loader"></div>
    </div>


    <!-- header
    ================================================== -->
    <header class="s-header">

        <div class="s-header__logo">
            <a class="logo" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="Homepage">
            </a>
        </div>

        <div class="row s-header__navigation">

            <nav class="s-header__nav-wrap">

                <h3 class="s-header__nav-heading h6">@lang('Navigate to')</h3>

                <ul class="s-header__nav">
                    <li {{ currentRoute('home') }}>
                        <a href="{{ route('home') }}" title="">@lang('Home')</a>
                    </li>
                    <li class="has-children">
                        <a href="#" title="">@lang('Categories')</a>
                        <ul class="sub-menu">
                            @foreach($categories as $category)
                                <li><a href="#">{{ $category->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

                <a href="#0" title="@lang('Close Menu')" class="s-header__overlay-close close-mobile-menu">@lang('Close')</a>

            </nav>

        </div>

        <a class="s-header__toggle-menu" href="#0" title="@lang('Menu')"><span>@lang('Menu')</span></a>

        <div class="s-header__search">

            <div class="s-header__search-inner">
                <div class="row wide">

                    <form role="search" method="get" class="s-header__search-form" action="#">
                        <label>
                            <span class="h-screen-reader-text">@lang('Search for:')</span>
                            <input type="search" class="s-header__search-field" placeholder="Search for..." value="" name="s" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="s-header__search-submit" value="Search">
                    </form>

                    <a href="#0" title="@lang('Close Search')" class="s-header__overlay-close">@lang('Close')</a>

                </div>
            </div>

        </div>

        <a class="s-header__search-trigger" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.982 17.983"><path fill="#010101" d="M12.622 13.611l-.209.163A7.607 7.607 0 017.7 15.399C3.454 15.399 0 11.945 0 7.7 0 3.454 3.454 0 7.7 0c4.245 0 7.699 3.454 7.699 7.7a7.613 7.613 0 01-1.626 4.714l-.163.209 4.372 4.371-.989.989-4.371-4.372zM7.7 1.399a6.307 6.307 0 00-6.3 6.3A6.307 6.307 0 007.7 14c3.473 0 6.3-2.827 6.3-6.3a6.308 6.308 0 00-6.3-6.301z"/></svg>
        </a>

    </header>


    <!-- hero
    ================================================== -->
    @yield('hero')


    <!-- content
    ================================================== -->
    <section class="s-content s-content--no-top-padding">

        @yield('main')

    </section>


    <!-- footer
    ================================================== -->
    <footer class="s-footer">

        <div class="s-footer__main">

            <div class="row">

                <div class="column large-3 medium-6 tab-12 s-footer__info">

                    <h5>A propos du Site</h5>

                    <p>
                    Ce site est un blog d'article<br>
                    Permettant aux utilisateurs de poster<br>
                    Leurs articles préférés, de commenter....<br>
                    </p>

                </div> <!-- end s-footer__info -->

                <div class="column large-2 medium-3 tab-6 s-footer__site-links">

                    <h5>Lins Utiles</h5>

                    <ul>
                        <li><a href="#0">About Us</a></li>
                        <li><a href="#0">Blog</a></li>
                        <li><a href="#0">FAQ</a></li>
                        <li><a href="#0">Terms</a></li>
                        <li><a href="#0">Privacy Policy</a></li>
                    </ul>

                </div> <!-- end s-footer__site-links -->

                <div class="column large-2 medium-3 tab-6 s-footer__social-links">

                    <h5>Abonnez-vous</h5>

                    <ul>
                        <li><a href="#0">Twitter</a></li>
                        <li><a href="#0">Facebook</a></li>
                        <li><a href="#0">Dribbble</a></li>
                        <li><a href="#0">Pinterest</a></li>
                        <li><a href="#0">Instagram</a></li>
                    </ul>

                </div> <!-- end s-footer__social links -->

                <div class="column large-3 medium-6 tab-12 s-footer__subscribe">

                    <h5>Sign Up for Newsletter</h5>

                    <p>Signup to get updates on articles, interviews and events.</p>

                    <div class="subscribe-form">

                        <form id="mc-form" class="group" novalidate="true">

                            <input type="email" value="" name="dEmail" class="email" id="mc-email" placeholder="Your Email Address" required="">

                            <input type="submit" name="subscribe" value="subscribe" >

                            <label for="mc-email" class="subscribe-message"></label>

                        </form>

                    </div>

                </div> <!-- end s-footer__subscribe -->

            </div> <!-- end row -->

        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
            <div class="row">
                <div class="column">
                    <div class="ss-copyright">
                        <span>© Copyright Mon Blog 2021</span>
                        <span>Design by <a href="https://github.com/HIHEAGLO98">Ghust H</a></span>
                    </div> <!-- end ss-copyright -->
                </div>
            </div>

            <div class="ss-go-top">
                <a class="smoothscroll" title="Back to Top" href="#top">
                    <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M7.5 1.5l.354-.354L7.5.793l-.354.353.354.354zm-.354.354l4 4 .708-.708-4-4-.708.708zm0-.708l-4 4 .708.708 4-4-.708-.708zM7 1.5V14h1V1.5H7z" fill="currentColor"></path></svg>
                </a>
            </div> <!-- end ss-go-top -->
        </div> <!-- end s-footer__bottom -->

   </footer> <!-- end s-footer -->


    <!-- JavaScript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')

</body>

</html>
