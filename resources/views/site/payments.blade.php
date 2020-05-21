@extends('site.layout')
@section('title', 'Payments')
@section('content')


    <main>
        <section class="paymants">
            <div class="container">
                <h3 class="section__headering mb-5">{{__('site.game-payments')}}</h3>
                <div class="row">

                    @foreach($methods as $method)
                    <div class="col-lg-3 col-md-4">
                        <div class="paymantCard">
                            <img src="/uploads/payment-methods/{{$method->img}}" alt="">
                            <p class="paymantCard__title">{{$method->name}}</p>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </section>
    </main>



    @endsection
