@extends('site.layout')
@section('title', 'Ana Səhifə')
@section('content')
    <main>
        <section class="advert">
            <div class="container">
                @if(count($premium_products)>0)
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="section__headering mb-5">Premium</h3>
                        <div class="row">
                            @foreach($premium_products as $product)
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="advertCard">
                                        <a href="/product/{{$product->slug}}">
                                            <div class="advertCard__imgBox" style="max-width: 100%; height: 170px; text-align: center">
                                                {{--advertCard__img--}}

                                                @foreach($product->images as $image)
                                                    @if($image->default == 1)
                                                        <img class="" src="/uploads/products/{{$image->img}}" alt="" style="width:100%;max-height: 100%">
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
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @if(count($general_products)>0)

                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="section__headering mb-5">General</h3>
                        <div class="row">
                            @foreach($general_products as $product)
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="advertCard">
                                        <a href="/product/{{$product->slug}}">
                                            <div class="advertCard__imgBox" style="max-width: 100%; height: 170px; text-align: center">
                                                {{--advertCard__img--}}

                                                @foreach($product->images as $image)
                                                    @if($image->default == 1)
                                                        <img class="" src="/uploads/products/{{$image->img}}" alt="" style="max-height: 100%;width:100%">
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
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                    @endif
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
