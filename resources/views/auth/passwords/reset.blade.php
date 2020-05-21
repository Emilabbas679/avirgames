@extends('site.layout')

@section('content')
<main>
    <section>
        <div class="container">
            <h1 class="section__headering mb-5">Forget Password</h1>
            <div class="grayBox col-lg-4 mx-auto reset-password">
                <div class="grayBox__content">
                    <h1 class="mb-20">Şifrəni Yenilə</h1>
                    <form class="reset-password__form"method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <div class="form-row">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="email" name="email" class="form-control form__control " placeholder="E-poçt ünvanı" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input placeholder="Şifrə" id="password" type="password" class="form-control form__control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="password" class="form-control form__control " placeholder="Şifrəni təsdiqlə" name="password_confirmation" required>
                            <button type="submit" class="myBtn">Göndər</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
</main>


@endsection
