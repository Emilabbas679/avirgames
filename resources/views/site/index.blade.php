@extends('site.layout')
@section('title', 'Ana Səhifə')
@section('content')
    <main>
        <section class="">
            <div class="owl-carousel main__carousel owlCard owl-theme">
                @foreach($premium_products as $product)

                <div class="owlCard__item">
                    <a href="/product/{{$product->slug}}">

                    <div class="owlCard__imgBox">
                        @foreach($product->images as $image)
                            @if($image->default == 1)
                                <img class="img-fluid" src="/uploads/products/{{$image->img}}" alt="" >
                            @endif
                        @endforeach

                    </div>
                    <div class="owlCard__content">
                        <div>
                            <p class="owlCard__name">{{$product->name}}</p>
                            <p class="owlCard__date text-capitalize"><i class="fas fa-clock"></i>{{$product->created_at->translatedFormat('d-M-Y')}}</p>

                            @if($product->platform_id ==1 || $product->platform->parent == 1)
                                <div class="consol consol--ps4">
                                    <img src="/site/img/ps4.png" alt="">
                                    <span>{{$product->platform->name}}</span>
                                </div>
                            @elseif($product->platform_id ==2 || $product->platform->parent == 2)
                                <div class="consol consol--pc">
                                    <img src="/site/img/pc.png" alt="">
                                    <span>{{$product->platform->name}}</span>
                                </div>
                            @elseif($product->platform_id ==3 || $product->platform->parent == 3)
                                <div class="consol consol--xbox">
                                    <img src="/site/img/xbox.png" alt="">
                                    <span>{{$product->platform->name}}</span>
                                </div>
                            @endif

                        </div>
                        <div class="owlCard__price">
                            <p>
                                @if(!empty($product->sell_price))
                                    {{explode('.',$product->sell_price)[0]}}
                                @elseif(!empty($product->hire_price))
                                    {{explode('.', $product->hire_price)[0]}}
                                @else
                                    {{explode('.', $product->barter_money)[0]}}
                                @endif
                                <sup><span class="azn">M</span></sup></p>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach

            </div>
            <div class="myOwl">
                <div id="carousel-custom-nav" class="myOwl__nav">
                    <div id="carousel-custom-dots" class="myOwl__dots">
                        <div class="owl-dot active "><button type="button" class="myOwl__dot myOwl__dot--active"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                        <div class="owl-dot"><button type="button" class="myOwl__dot"></button></div>
                    </div>
                </div>

            </div>
        </section>
        <section class="advert">
            <div class="container">
                <div class="row">
{{--                    <div class="col-lg-12">--}}
                        <h3 class="section__headering mb-5">{{__('site.adverts')}}</h3>
{{--                        <div class="row ">--}}
                            @foreach($general_products as $product)
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="advertCard">
                                    <a href="/product/{{$product->slug}}">
                                        <div class="advertCard__imgBox" style="max-width: 100%; height: 170px; text-align: center">
                                            {{--advertCard__img--}}

                                        @foreach($product->images as $image)
                                                @if($image->default == 1)
                                                    <img class="" src="/uploads/products/{{$image->img}}" alt="" style="max-height: 100%;width: 100%">
                                                @endif
                                            @endforeach
                                        </div>

                                        <span class="advertCard__title">{{$product->name}}</span>

                                        <div class="advertCard__content">

                                            @if($product->platform_id ==1 or $product->platform->parent==1)
                                                <div class="consol consol--ps4">
                                                    <img src="/site/img/ps4.png" alt="">
                                                    <span>@if($product->platform->parent == 0){{$product->platform->name}}@endif </span>
                                                </div>
                                            @elseif($product->platform_id ==2 or $product->platform->parent==2)
                                                <div class="consol consol--pc">
                                                    <img src="/site/img/pc.png" alt="">
                                                    <span>@if($product->platform->parent == 0){{$product->platform->name}} @endif </span>
                                                </div>
                                            @elseif($product->platform_id ==3 or $product->platform->parent == 3)
                                                <div class="consol consol--xbox">
                                                    <img src="/site/img/xbox.png" alt="">
                                                    <span>@if($product->platform->parent == 0) {{$product->platform->name}}
                                                        @else {{$product->platform->selfParent}}@endif </span>
                                                </div>
                                            @endif

                                            <div class="advertCard__price">
                                                <p>
                                                    @if(!empty($product->sell_price))
                                                        {{explode('.',$product->sell_price)[0]}}
                                                    @elseif(!empty($product->hire_price))
                                                        {{explode('.', $product->hire_price)[0]}}
                                                    @else
                                                        {{explode('.', $product->barter_money)[0]}}
                                                    @endif
                                                    <sup><span class="azn">M</span></sup></p>
                                            </div>
                                        </div>
                                        <span class="advertCard__date text-capitalize">{{$product->city->name}}, {{$product->created_at->translatedFormat('d F Y')}}</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach

{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-lg-3 d-none">
                        <h3 class="section__headering mb-5">{{__('site.top_users')}}</h3>
                        <ul>
                            <li>
                                <div class="users">
                                    <span class="users__number">1</span>
                                    <div class="users__imgBox">
                                        <img  class="users__img" src="/site/img/person.png" alt="">
                                        <img  class="users__img--point" src="/site/img/point-1.png" alt="">
                                    </div>
                                    <div class="users__infoBox">
                                        <p class="users__name">Asif Musayev</p>
                                        <p class="users__point">1,110,342 xal</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="users">
                                    <span class="users__number">2</span>
                                    <div class="users__imgBox">
                                        <img  class="users__img" src="/site/img/person-1.jpeg" alt="">
                                        <img  class="users__img--point" src="/site/img/point-2.png" alt="">
                                    </div>
                                    <div class="users__infoBox">
                                        <p class="users__name">Asif Musayev</p>
                                        <p class="users__point">1,110,342 xal</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="users">
                                    <span class="users__number">3</span>
                                    <div class="users__imgBox">
                                        <img  class="users__img" src="/site/img/person.png" alt="">
                                        <img  class="users__img--point" src="/site/img/point-1.png" alt="">
                                    </div>
                                    <div class="users__infoBox">
                                        <p class="users__name">Asif Musayev</p>
                                        <p class="users__point">1,110,342 xal</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="users">
                                    <span class="users__number">4</span>
                                    <div class="users__imgBox">
                                        <img  class="users__img" src="/site/img/person-1.jpeg" alt="">
                                        <img  class="users__img--point" src="/site/img/point-2.png" alt="">
                                    </div>
                                    <div class="users__infoBox">
                                        <p class="users__name">Asif Musayev</p>
                                        <p class="users__point">1,110,342 xal</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="users">
                                    <span class="users__number">5</span>
                                    <div class="users__imgBox">
                                        <img  class="users__img" src="/site/img/person.png" alt="">
                                        <img  class="users__img--point" src="/site/img/point-1.png" alt="">
                                    </div>
                                    <div class="users__infoBox">
                                        <p class="users__name">Asif Musayev</p>
                                        <p class="users__point">1,110,342 xal</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="users">
                                    <span class="users__number">6</span>
                                    <div class="users__imgBox">
                                        <img  class="users__img" src="/site/img/person-1.jpeg" alt="">
                                        <img  class="users__img--point" src="/site/img/point-2.png" alt="">
                                    </div>
                                    <div class="users__infoBox">
                                        <p class="users__name">Asif Musayev</p>
                                        <p class="users__point">1,110,342 xal</p>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
                {{$general_products->links()}}

            </div>
        </section>
    </main>

@endsection()


@push('scripts')
    <script>
        // $('button.owl-prev').html("{__('site.previous')}");
        $('.owl-prev').html('s');
    </script>
@endpush
