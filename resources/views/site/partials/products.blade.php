<div class="row">
    @foreach($products as $product)

        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="advertCard">
                <a href="/product/{{$product->slug}}" target="_blank">
                    <div class="advertCard__imgBox">
                        @foreach($product->images as $image)
                            @if($image->default == 1)
                                <img class="advertCard__img" src="/uploads/products/{{$image->img}}">
                            @endif
                        @endforeach
                    </div>
                    <span class="advertCard__title">{{$product->name}}</span>

                    <div class="advertCard__content">
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

                        <div class="advertCard__price">
                            <p>
                                @if(!empty($product->sell_price))
                                    {{$product->sell_price}}
                                @elseif(!empty($product->hire_price))
                                    {{$product->hire_price}}
                                @else
                                    {{$product->barter_money}}
                                @endif
                                <sup><span class="azn">M</span></sup>
                            </p>
                        </div>
                    </div>
                    <span class="advertCard__date">{{$product->city->name}}, {{$product->created_at->translatedFormat('d F Y')}}</span>
                </a>
            </div>
        </div>
    @endforeach
</div>
{{ $products->links() }}
