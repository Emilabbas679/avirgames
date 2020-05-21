@extends('site.layout')
@section('title', __('site.categories'))
@section('content')
<main>
    <section>
        <div class="container">
            <div class="category__sortBox">
                <h1 class="section__headering">{{__('site.categories')}}</h1>

            </div>
            <div class="row">
                @foreach($categories as $cat)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{route('site.cat-products', $cat->id)}}">
                            <div class="categoryCard">
                                <div class="categoryCard__imgBox">
                                    <img class="categoryCard__img" src="/uploads/category/{{$cat->img}}" alt="">

                                </div>
                                <span class="categoryCard__title">{{$cat->name}}</span>

                                <div class="categoryCard__content">
                                    <div>{{count($cat->products)}} {{__('site.advertisements')}}</div>

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</main>

    @endsection
