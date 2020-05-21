@extends('site.layout')
@section('title', __('site.login'))
@section('content')
    <style>
        .forgot-pass{
            display: inline-block;
            margin-top: 5px;
            margin-right: 0px;
            color: white;
            font-size: 13px;
        }
        .forgot-pass:hover {
            color: red;
        }
    </style>
<main>
    <section>
        <div class="container">
            <h1 class="section__headering mb-5"> {{__('site.login')}}</h1>
            <div class="grayBox">
                <div class="grayBox__content">
                    <h1 class="mb-20">{{__('site.login')}}</h1>
                    <p class="note mb-5"><span>{{__('site.NOTE')}}: </span>{{__('site.login_information')}}</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col-5">
                                <input type="text" class="form-control form__control @error('email') is-invalid @enderror"
                                       placeholder="{{__('site.E-mail')}}" name="email" value="{{old('email')}}">
                                @error('email')
                                <span class="invalid-feedback text-uppercase" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <input type="password" class="form-control form__control  @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="{{__('site.Password')}}" >
                                @error('password')
                                <span class="invalid-feedback text-uppercase" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <button type="submit" class="myBtn">{{__('site.login')}}</button>
                                <a href="/password/reset" class="forgot-pass">{{__('site.forgot_password?')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
                <h3 class="box__title">{{__('site.or')}}</h3>
                <div class="grayBox__content">
                    <div class="form-row">
                        <div class="col-lg-3 col-md-6">
                            <a class="myBtn myBtn__social myBtn__social--fb" href="/"><i
                                    class="fab fa-facebook-f"></i>{{__('site.Login with Facebook')}}</a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a class="myBtn myBtn__social myBtn__social--tw" href="/"><i
                                    class="fab fa-twitter"></i> {{__('site.Login with Twitter')}}</a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a class="myBtn myBtn__social myBtn__social--ins" href="javascript:void(0)"><i
                                    class="fab fa-instagram"></i>{{__('site.Login with Instagram')}}</a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a class="myBtn myBtn__social myBtn__social--reddit" href="javascript:void(0)"><i
                                    class="fab fa-reddit-alien"></i>{{__('site.Login with Reddit')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
