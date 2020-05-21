<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    <link rel="manifest" href="site.webmanifest">--}}
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="/site/libs/normalize.css/normalize.css">
    <!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous"> -->
    <link rel="icon" href="/site/img/favicon.png" type="image/gif">
    <link rel="stylesheet" href="/site/libs/components-font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/site/libs/components-font-awesome/css/brands.min.css">
    <link rel="stylesheet" href="/site/libs/components-font-awesome/css/solid.min.css">


    <!--  -->

    <link href="/site/libs/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/site/libs/dropzone/dist/dropzone.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <link rel="stylesheet" href="/site/css/main/main.min.css">
    <link rel="stylesheet" type="text/css" href="/site/libs/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="/site/libs/owl.carousel/dist/assets/owl.theme.default.min.css">
{{--    <link rel="stylesheet" href="/site/css/custom.css">--}}
</head>
<style>

    .is-invalid {
        border: 1px solid #E74755;
    }

    div.alert-danger{
        background: #E74755;
        border:none !important;
        /*border-color: white;*/
        color: white;
        font-size: 20px;
        text-align: center;
    }
    div.alert-success{
        background: green;
        /*border-color: white;*/
        border:none !important;

        color: white;
        font-size: 20px;
        text-align: center;
    }

    button.close {
        font-size: 30px;
    }

    .pagination {
        display: -ms-flexbox;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-left: 0;
        list-style: none;
        border-radius: .25rem;
    }


    .page-link {
        position: relative;
        display: block;
        padding: .5rem .9rem;
        margin-left: -1px;
        color: #fff;
        line-height: 15px;
        font-size: 16px;
        background-color: transparent;
        border: 1px solid #F22655;
    }

    .page-item.disabled .page-link {
        color: #fff;
        pointer-events: none;
        cursor: auto;
        background-color: #FC5D81;
        border-color: #FC5D81;
    }


    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #F52756;
        border-color: #F42756;
    }

    .page-link:hover {
        z-index: 2;
        color: #fff;
        text-decoration: none;
        background-color: #FC5D81;
        border-color: #FC5D81;
    }

    .page-item.disabled .page-link {
        color: #fff;
        pointer-events: none;
        cursor: auto;
        background-color: #FC5D81;
        border-color: #FC5D81;
        display: none;
    }

    .pagination {
        display: -ms-flexbox;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-left: 0;
        list-style: none;
        margin-bottom: 20px;
        border-radius: .25rem;
    }
    .page-link {
        position: relative;
        display: block;
        padding: .8rem 1.5rem;
        margin-left: -1px;
        color: #fff;
        line-height: 15px;
        font-size: 16px;
        background-color: transparent;
        border: 1px solid #F22655;
    }


</style>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<div class="header">
    <div class="container">
        <div class="header__top">
            <ul class="header__list header__list-left   header__top--left">
                <li class=" header__top--item"><span class="header__span text-uppercase">{{__('site.follow-us')}}</span></li>
                <li class="header__top--item"><a class="header__topLink" href="#"><i
                            class="fab fa-facebook-square header__topLink--icon"></i></a></li>
                <li class=" header__top--item"><a class="header__topLink" href="#"><i
                            class="fab fa-instagram header__topLink--icon"></i></a> </li>
                <li class=" header__top--item"><a class="header__topLink" href="#"><i
                            class="fab fa-twitter header__topLink--icon"></i></a>
                </li>
                <li class=" header__top--item"> <input type="checkbox" name="" class="header__toggle-btn">
                </li>
            </ul>
            <ul class="header__list header__list-right header__top--right">
                <li class="header__top--item">
                    <div class="btn-group ">
                        <a class="header__topLink" data-toggle="dropdown" style="color:#777"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-globe mr-2" aria-hidden="true"></i>
                            <span style="text-transform: uppercase">{{Config::get('app.locale')}}</span>
                        </a>
                        <div class="dropdown-menu myDrop__menu">
                            @foreach($langs as $lang)
                                @if(Config::get('app.locale') !== $lang->code)
                                    <a class="dropdown-item myDrop__item locale" data-id="{{$lang->code}}" href="#">{{$lang->name}}</a>
                                @endif
                            @endforeach


                        </div>
                    </div>
                </li>
                @if(\Auth::check())
                    <li class="header__top--item">
                        <div class="btn-group ">
                            <a class="header__topLink text-uppercase" data-toggle="dropdown" style="color:#777"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="header__icon fas fa-user mr-2"></i>
                                {{__('site.my-profile')}}
                            </a>
                            <div class="dropdown-menu myDrop__menu text-uppercase">
                                <a class="dropdown-item myDrop__item" href="{{route('site.my-profile')}}">{{__('site.my profile')}}</a>
                                <a class="dropdown-item myDrop__item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('site.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                @else
                    <li class=" header__top--item"><a class="header__topLink text-uppercase" href="{{route('login')}}"><i
                                class="header__icon fas fa-sign-in-alt mr-2"></i>{{__('site.login')}}</a></li>
                    <li class=" header__top--item"><a class="header__topLink text-uppercase" href="{{route('register')}}"><i
                                class="header__icon fas fa-user mr-2"></i>{{__('site.register')}}</a></li>

                @endif
            </ul>

        </div>
        <div class="header__bottom">
            <div class="header__list--left text-uppercase">
                <div class="header__logo">


                    <a class="header__logo__link" href="/"><img src="/site/img/logo-new.png" alt="logo"
                                                                class="header__logo--img" /> </a>

                </div>

                <ul class="header__list header-none">
                    <li class="nav-item header__item header__item__skew-right ripple-effect"><a
                            class="header__link header__link__skew-right" href="/">{{__('site.home-page')}}</a></li>
                    <li class="nav-item header__item header__item__skew-right ripple-effect "><a
                            class="header__link header__link__skew-right" href="{{route('site.consoles')}}">{{__('site.console')}}</a></li>                                     <li class="nav-item header__item header__item__skew-right ripple-effect"><a
                            class="header__link header__link__skew-right" href="{{route('site.categories')}}">{{__('site.categories')}}</a></li>
                    <li class="nav-item header__item header__item__skew-right ripple-effect"><a
                            class="header__link header__link__skew-right" href="{{route('site.all-ads')}}">{{__('site.game')}}</a></li>
                    <li class="nav-item header__item header__item__skew-right ripple-effect"><a
                            class="header__link header__link__skew-right" href="{{route('site.forum')}}">{{__('site.forum')}}</a></li>
                    <li class="nav-item header__item  header__item__skew-right ripple-effect"><a
                            class="header__link header__link__skew-right" href="{{route('site.payments')}}">{{__('site.game-payments')}}</a></li>
                </ul>
            </div>



            <ul class="header__list  header__list--right header-none">
                <li class="nav-item header__item  header__item__skew-right header__item--active  ripple-effect"><a
                        class="header__link header__link__skew-right " href="{{route('site.add-advert')}}"><i class="fas fa-plus mr-2"></i>{{__('site.add-ads')}}</a></li>

            </ul>
            <span onclick="openNav()" class="hamburger-menu">&#9776;</span>
            <ul id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <li class="nav-item header__item sidenav__item header__item__skew-right header__item--active"><a
                        class="header__link header__link__skew-right " href="{{route('site.add-advert')}}"><i class="fas fa-plus mr-2"></i>{{__('site.add-ads')}}</a></li>
                <li class="nav-item header__item sidenav__item header__item__skew-right"><a
                        class="header__link header__link__skew-right" href="/">{{__('site.home-page')}}</a></li>
                <li class="nav-item header__item sidenav__item header__item__skew-right"><a
                        class="header__link header__link__skew-right" href="#">{{__('site.console')}}</a></li>
                <li class="nav-item header__item sidenav__item  header__item__skew-right"><a
                        class="header__link header__link__skew-right" href="#">{{__('site.game')}}</a></li>
                <li class="nav-item header__item sidenav__item header__item__skew-right"><a
                        class="header__link header__link__skew-right" href="{{route('site.forum')}}">{{__('site.forum')}}</a></li>
                <li class="nav-item header__item sidenav__item header__item__skew-right"><a
                        class="header__link header__link__skew-right" href="{{route('site.payments')}}">{{__('site.game-payments')}}</a></li>
            </ul>

        </div>
    </div>
</div>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
<div style="background: red !important;">
    @include('flash-message')
</div>
@yield('content')



<footer>
    <div class="footer__top"></div>
    <div class="footer__middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer__about">
                        <div class="footer__logoBox">
                            <img src="/site/img/logo-new.png" alt="">
                        </div>

                        <div>
                            <p class="footer__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan
                                lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
                        </div>
                        <div class="text-center">
                            <ul class="social">
                                <li class="social__list">
                                    <a class="social__link social__link--white" href="javascript:void()">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                </li>
                                <li class="social__list">
                                    <a class="social__link social__link--white" href="javascript:void()">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="social__list">
                                    <a class="social__link social__link--white" href="javascript:void()">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="pt-40">
                                <h3 class="footer__title">{{__('site.categories')}}</h3>
                                <ul>
                                    @foreach($categories as $cat)
                                        <li><a class="footer__link" href="/cat/{{$cat->id}}/products">{{$cat->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="pt-40">
                                <h3 class="footer__title">{{__('site.pages')}}</h3>
                                <ul class="text-capitalize">
                                    <li><a class="footer__link" href="{{route('site.consoles')}}">{{__('site.console')}}</a></li>
                                    <li><a class="footer__link" href="{{route('site.categories')}}">{{__('site.categories')}}</a></li>
                                    <li><a class="footer__link" href="{{route('site.all-ads')}}">{{__('site.game')}}</a></li>
                                    <li><a class="footer__link" href="{{route('site.forum')}}">{{__('site.forum')}}</a></li>
                                    <li><a class="footer__link" href="{{route('site.payments')}}">{{__('site.game-payments')}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="pt-40">
                                <h3 class="footer__title">{{__('site.last_adverts')}}</h3>
                                <ul>
                                    @foreach($last_ads as $product)
                                        <li><a class="footer__link" href="/product/{{$product->slug}}">{{$product->name}}</a></li>


                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom"></div>
</footer>





<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/site/libs/jquery/dist/jquery.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="/site/libs/select2/dist/js/select2.min.js"></script>
{{--<script src="/site/libs/owl.carousel/dist/owl.carousel.min.js" type="text/javascript" charset="utf-8" async defer></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="/site/libs/dropzone/dist/dropzone.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- PARSLEY JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.1/parsley.min.js"></script>
<!-- <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script> -->
<!-- <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script> -->

<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script src="/site/js/all.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
<script>
    $('a.locale').click(function () {
        var locale = $(this).attr("data-id");
        $.ajax({
            type:"POST",
            data: { 'locale' : locale,
                "_token": "{{ csrf_token() }}",
            },
            url:'/site/setlocale',
            success:function(response){
                location.reload();
            }
        });
    })
    $(document).ready(function() {
        $('button.owl-next').html("{{__('site.next')}}");
        $('button.owl-prev').html("{{__('site.previous')}}");

    })

</script>

@stack('scripts')

</body>
</html>
