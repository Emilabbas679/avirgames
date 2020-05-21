@extends('site.layout')
@section('title', __('site.console'))
@section('content')
    <main>
        <section>
            <div class="container">
                <div class="category__sortBox">
                    <h1 class="section__headering">{{__('site.console')}}</h1>

                </div>
                <div class="row">
                    @foreach($platforms as $p)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="{{route('site.console-products', $p->id)}}">
                                <div class="categoryCard">
                                    <div class="categoryCard__imgBox">
                                        <img class="categoryCard__img" src="/uploads/platform/{{$p->img}}" alt="">

                                    </div>
                                    <span class="categoryCard__title">{{$p->name}}</span>

                                    <div class="categoryCard__content">
                                        <div>{{count($p->products)}} {{__('site.advertisements')}}</div>

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
