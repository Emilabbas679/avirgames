@extends('site.layout')
@section('content')

<main>
    <section>
        <div class="container">
            <h1 class="section__headering mb-5">Forget Password</h1>
            <div class="grayBox col-lg-4 mx-auto forget-password">
                <div class="grayBox__content">
                    <h1 class="mb-20">Şifrəni Yenilə</h1>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="forget-password__form" method="post" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-row">

                            <input type="email" id="email" autocomplete="email" autofocus class="form-control form__control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" name="email" placeholder="E-poçt ünvanı">

                            @error('email')
                            <span class="invalid-feedback" style="display: block; margin-bottom: 10px; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <button type="submit" class="myBtn">Göndər</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
</main>

@endsection
