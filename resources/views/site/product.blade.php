@extends('site.layout')
@section('title', $product->name)
@section('content')
    <style>
        table,tr,td ,th{
            border: 1px solid #56585B !important;
        }
    </style>
<main>
    <section>
        <div class="container">
            <h1 class="section__headering mb-5">{{$product->name}}</h1>
            <div class="row">
                <div class="col-lg-6">

                    <div class="advertInner">
                        <div class="advertInner__circleIcon">
                            <i class="fas fa-key"></i>
                        </div>
                        <div class="advertInner__circleIcon advertInner__circleIcon--green">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div class="advertInner__imgBox">
                            <img class="paymant__img" src="/uploads/products/{{$img}}" alt="">
                        </div>
                        <div class="advertInner__infoBox">
                            <p class="advertInner__title">{{$product->name}}</p>
                            <div class="advertInner__info">
                                @if($product->ads_type == 'premium')
                                <div class="advertInner__categiry">
                                    <p class="advertInner__icon advertInner__icon--gold"><i class="fas fa-gem"></i></p>
                                    <p>Premium</p>
                                </div>
                                @endif
                                <div class="advertInner__consol">
                                    <p class="advertInner__icon advertInner__icon--blue">
                                        @if($product->platform_id ==1 || $product->platform->parent == 1)
                                                <img src="/site/img/ps4.png" alt="">
                                        @elseif($product->platform_id ==2 || $product->platform->parent == 2)
                                                <img src="/site/img/pc.png" alt="">
                                        @elseif($product->platform_id ==3 || $product->platform->parent == 3)
                                                <img src="/site/img/xbox.png" alt="">
                                        @endif
                                    </p>
                                    <p>{{$product->platform->name}}</p>
                                </div>
                                <div class="advertInner__price">
                                    <p class="advertInner__numeral">
                                        @if($product->sell_price != '')
                                            {{$product->sell_price}}
                                        @elseif($product->hire_price !== '')
                                            {{$product->hire_price}}
                                        @else
                                            {{$product->barter_price}}
                                        @endif
                                        <sup><span class="azn">M</span></sup></p>
                                    <p class="advertInner__priceText">{{__('site.price')}}</p>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="advertInner__phone">
                                            <div class="advertInner__phoneIcon">
                                                <i class=" fas fa-phone-alt"></i>
                                            </div>
                                            <div class="advertInner__phoneBody">
                                                <h3 class="">{{$product->user->phone}}</h3>
                                                <p class="">{{$product->user->name}} {{$product->user->surname}}</p>
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div class="col-lg-6 col-sm-6">--}}
{{--                                        <div>--}}
{{--                                            <a class="advertInner__messageLink ripple-effect"--}}
{{--                                               href="javascript:void(0)"><i class="fas fa-envelope"></i> MƏKTUB YAZ</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <h3 class="box__title mt-4">{{__('site.share')}}</h3>
                            <div class="text-center">
                                <ul class="social pb-10">
                                    <li class="social__list">
                                        <a class="social__link" href="javascript:void()">
                                            <i class="fab fa-facebook-square"></i>
                                        </a>
                                    </li>
                                    <li class="social__list">
                                        <a class="social__link" href="javascript:void()">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="social__list">
                                        <a class="social__link" href="javascript:void()">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="col-lg-6">
                    <div class="advertInner__tab" style="height: 586px; overflow-y: auto">

                        <ul class="nav justify-content-center" id="pills-tab" role="tablist">
                            <li class=" advertInner__tabItem ripple-effect">
                                <a class="advertInner__tabLink active " id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                   role="tab" aria-controls="pills-home" aria-selected="true">{{__('site.information')}}</a>
                            </li>
                            <li class=" advertInner__tabItem ripple-effect">
                                <a class="advertInner__tabLink" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                   role="tab" aria-controls="pills-profile" aria-selected="false">{{__('site.hire_info')}}</a>
                            </li>
                            <li class=" advertInner__tabItem ripple-effect">
                                <a class="advertInner__tabLink" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                   role="tab" aria-controls="pills-contact" aria-selected="false">{{__('site.barter_info')}}</a>
                            </li>
                        </ul>


                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane advertInner__tabPanel active h-100" id="pills-home" role="tabpanel"
                                 aria-labelledby="pills-home-tab">
                                <p class="m-2">{!! $product->description !!}</p>
                                <table class="table text-white table-bordered mt-5">
                                    <tr>
                                        <td>{{__('site.game-category')}}</td>
                                        <td>{{$product->category->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('site.game-platform')}}</td>
                                        <td>{{$product->platform->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('site.city')}}</td>
                                        <td>{{$product->city->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('site.ads_type')}}</td>
                                        <td>
                                            @if($product->type == 'mix')
                                                @foreach($product->types as $type)
                                                    @if($type->type == 'sell')
                                                        {{__('site.sell')}}
                                                    @elseif($type->type == 'hire')
                                                        {{__('site.hire')}}
                                                    @else
                                                        {{__('site.barter')}}
                                                    @endif
                                                @endforeach
                                            @else
                                                @if($product->type == 'sell')
                                                    {{__('site.sell')}}
                                                @elseif($product->type == 'barter')
                                                    {{__('site.barter')}}
                                                @else
                                                    {{__('site.hire')}}
                                                @endif
                                            @endif
                                        </td>
                                    </tr>


                                    @if($product->type == 'sell' || in_array('sell', $product_types))
                                        <tr>
                                            <td>{{__('site.sell_price')}}</td>
                                            <td> {{$product->sell_price}} <span class="azn">M</span> </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>{{__('site.ads_number')}}</td>
                                        <td>{{$product->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('site.views')}}</td>
                                        <td>{{$product->view}}</td>
                                    </tr>
                                </table>

                            </div>
                            <div class="tab-pane advertInner__tabPanel fade h-100" id="pills-profile" role="tabpanel"
                                 aria-labelledby="pills-profile-tab">
                                @if($product->type == 'hire' || in_array('hire', $product_types))
                                    <p>{!! $product->hire_description !!}</p>
                                <table class="table text-white table-bordered mt-5">

                                    <tr>
                                        <td>{{__('site.hire_price')}}</td>
                                        <td>{{$product->hire_price}} <span class="azn">M</span></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('site.hire_period')}}</td>
                                        <td>
                                            @if($product->hire_period_id !==0)
                                                {{$product->period->count}}
                                                @if($product->period->period == 'day')
                                                    {{__('site.day')}}
                                                @elseif($product->period->period == 'month')
                                                    {{__('site.month')}}
                                                @elseif($product->period->period == 'week')
                                                    {{__('site.week')}}
                                                @else
                                                    {{__('site.year')}}
                                                @endif

                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                    @endif

                            </div>


                            <div class="tab-pane advertInner__tabPanel h-100" id="pills-contact" role="tabpanel"
                                 aria-labelledby="pills-contact-tab">
                                @if($product->type == 'barter' || in_array('barter', $product_types))
                                    <table class="table text-white table-bordered mt-5">
                                        <tr>
                                            <td>{{__('site.barter_type')}}</td>
                                            <td>
                                                @if($product->barter_type == 'equal')
                                                    {{__('site.equal terms')}}
                                                    @elseif($product->barter_type == 'take')
                                                    {{__('site.Get money on product')}}
                                                    @else
                                                    {{__('site.Give money on product')}}
                                                    @endif
                                            </td>
                                        </tr>
                                        @if($product->barter_type !== 'equal')
                                            <tr>
                                                <td>{{__('site.barter_price')}}</td>
                                                <td>{{$product->barter_money}} <span class="azn">M</span></td>
                                            </tr>
                                        @endif

                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="section__headering mb-5 text-uppercase">{{__('site.other_products_of_user')}}</h1>

            <div class="row">

                @foreach($user_products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="/product/{{$product->slug}}">
                            <div class="advertCard">
                                <div class="advertCard__imgBox">
                                    @foreach($product->images as $image)
                                        @if($image->default == 1)
                                            <img class="advertCard__img" src="/uploads/products/{{$image->img}}" alt="">
                                        @endif
                                    @endforeach
                                </div>
                                <span class="advertCard__title">{{$product->name}}</span>

                                <div class="advertCard__content">

                                    @if($product->platform_id ==1)
                                        <div class="consol consol--ps4">
                                            <img src="/site/img/ps4.png" alt="">
                                            <span>{{$product->platform->name}}</span>
                                        </div>
                                    @elseif($product->platform_id ==2)
                                        <div class="consol consol--pc">
                                            <img src="/site/img/pc.png" alt="">
                                            <span>{{$product->platform->name}}</span>
                                        </div>
                                    @elseif($product->platform_id ==3)
                                        <div class="consol consol--xbox">
                                            <img src="/site/img/xbox.png" alt="">
                                            <span>{{$product->platform->name}}</span>
                                        </div>
                                    @endif

                                    <div class="advertCard__price">
                                        <p>
                                            @if($product->sell_price != '')
                                                {{$product->sell_price}}
                                            @elseif($product->hire_price !== '')
                                                {{$product->hire_price}}
                                            @else
                                                {{$product->barter_price}}
                                            @endif
                                            <sup><span class="azn">M</span></sup></p>
                                    </div>
                                </div>
                                <span class="advertCard__date text-capitalize">{{$product->city->name}}, {{$product->created_at->translatedFormat('d F Y')}}</span>
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>


            @if(count($related_products)>0)
            <h1 class="section__headering mb-5 text-uppercase">{{__('site.similar_products')}}</h1>
            <div class="row">


                @foreach($related_products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="/product/{{$product->slug}}">
                        <div class="advertCard">
                            <div class="advertCard__imgBox">
                                @foreach($product->images as $image)
                                    @if($image->default == 1)
                                        <img class="advertCard__img" src="/uploads/products/{{$image->img}}" alt="">
                                    @endif
                                @endforeach
                            </div>
                            <span class="advertCard__title">{{$product->name}}</span>

                            <div class="advertCard__content">

                                @if($product->platform_id ==1)
                                    <div class="consol consol--ps4">
                                        <img src="/site/img/ps4.png" alt="">
                                        <span>{{$product->platform->name}}</span>
                                    </div>
                                @elseif($product->platform_id ==2)
                                    <div class="consol consol--pc">
                                        <img src="/site/img/pc.png" alt="">
                                        <span>{{$product->platform->name}}</span>
                                    </div>
                                @elseif($product->platform_id ==3)
                                    <div class="consol consol--xbox">
                                        <img src="/site/img/xbox.png" alt="">
                                        <span>{{$product->platform->name}}</span>
                                    </div>
                                @endif

                                <div class="advertCard__price">
                                    <p>
                                        @if($product->sell_price != '')
                                            {{$product->sell_price}}
                                        @elseif($product->hire_price !== '')
                                            {{$product->hire_price}}
                                        @else
                                            {{$product->barter_price}}
                                        @endif
                                        <sup><span class="azn">M</span></sup></p>
                                </div>
                            </div>
                            <span class="advertCard__date text-capitalize">{{$product->city->name}}, {{$product->created_at->translatedFormat('d F Y')}}</span>
                        </div>
                        </a>
                    </div>
                @endforeach

            </div>
                @endif
        </div>
    </section>
</main>


    @endsection
