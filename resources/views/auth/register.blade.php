@extends('site.layout')
@section('title', __('site.Register'))
@section('content')

<main>
    <section>
        <div class="container">
            <h1 class="section__headering mb-5">{{__('site.Register')}}</h1>
            <div class="grayBox">
                <div class="grayBox__content">
                    <h1 class="mb-20">{{__('site.Register')}}</h1>
                    <p class="note mb-5"><span>{{__('site.NOTE')}}: </span> {{__('site.note_info')}}</p>
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
                <h3 class="box__title">VƏ YA</h3>
                <div class="grayBox__content">
                    <form method="POST" action="{{ route('register') }}" class="register-form">
                        @csrf

                        <div class="form-row">
                            <div class="col-lg-4 col-md-6">
                                <input type="text" class="form-control form__control  @error('name') is-invalid @enderror" placeholder="{{__('site.Name')}}" name="name" autocomplete="name" autofocus value="{{old('name')}}">
                                @error('name')
                                <p class="invalid-feedback mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="text" class="form-control form__control @error('surname') is-invalid @enderror" placeholder="{{__('site.Surname')}}"  name="surname" autocomplete="surname" value="{{old('surname')}}">
                                @error('surname')
                                <p class="invalid-feedback mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="email" class="form-control form__control  @error('email') is-invalid @enderror" placeholder="{{__('site.E-mail')}}"  name="email" autocomplete="email" value="{{old('email')}}">
                                @error('email')
                                <p class="invalid-feedback mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="text" class="form-control form__control @error('phone') is-invalid @enderror" placeholder="{{__('site.Phone')}}" name="phone" value="{{old('phone')}}" autocomplete="phone">
                                @error('phone')
                                <p class="invalid-feedback mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="inputBox">
                                    <span class="inputBox__fieldType">{{__('site.Gender')}}</span>
                                    <label class="myRadio">{{__('site.Male')}}
                                        <input type="radio" checked="checked" name="gender"  required value="0">
                                        <span class="myRadio__checkmark"></span>
                                    </label>
                                    <label class="myRadio">{{__('site.Female')}}
                                        <input type="radio" name="gender" value="1">
                                        <span class="myRadio__checkmark"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <input type="text" id="bd" class="form-control form__control @error('birthday') is-invalid @enderror" placeholder="Doğum tarixi" name="birthday">
                                @error('birthday')
                                <p class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="password" class="form-control form__control  @error('password]') is-invalid @enderror" id="form-password" placeholder="{{__('site.Password')}}" name="password">
                                @error('password')
                                <p class="invalid-feedback mb-2 d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="password" class="form-control form__control "
                                       placeholder="{{__('site.repeat_password')}}" data-parsley-equalto="#form-password"  name="password_confirmation" >
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <button type="submit" class="myBtn">{{__('site.sign_in')}}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</main>
@endsection
