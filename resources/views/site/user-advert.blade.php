@extends('site.layout')
@section('title', $ads->name)
@section('content')
<main>
    <section>
        <div class="container">
            <h1 class="section__headering mb-5">User Advert</h1>



            <div class="grayBox mb-4" id="section-advert">
                <div class="grayBox__content">
                    <h1 class="mb-20">ELAN MƏLUMATLARI</h1>
                    <p class="note mb-5"><span>QEYD: </span> Aşağıdakı məlumatlar qeydiyyat məlumatlarından
                        götürülüb.
                        Siz elan dərc edildikdə görünəcək şəxsi məlumatlarda düzəliş
                        edə bilərsiniz.</p>
                    <form action="{{route('site.user-update-ads')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$ads->id}}">
                    <div class="form-row">
                        <div class="col-lg-6">
                            <div class="inputBox">
                                <span class="inputBox__fieldType">Elanın növü</span>
                                <label class="myCheckbox">Satıram
                                    <input type="checkbox" value="sell"  name="type[]" class="user-sale-checkbox" @if($ads->type=='sell' or in_array('sell', $types)) checked @endif>
                                    <span class="myCheckbox__checkmark"></span>
                                </label>
                                <label class="myCheckbox">İcarəyə verirəm
                                    <input type="checkbox" value="hire" name="type[]" class="user-rental-checkbox" @if($ads->type=='hire' or in_array('hire', $types)) checked @endif>
                                    <span class="myCheckbox__checkmark"></span>
                                </label>
                                <label class="myCheckbox">Barter edirəm
                                    <input type="checkbox" value="barter" name="type[]" class="user-barter-checkbox" @if($ads->type=='barter' or in_array('barter', $types)) checked @endif>
                                    <span class="myCheckbox__checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="btn-group paymant__btnGroup ">

                                <select class="advert-platform">
                                    <option value=""></option>
                                    @foreach($platforms as $p)
                                        <option value="{{$p->id}}"  @if($p->id == $ads->platform_id)  selected @endif>{{$p->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" value="{{$ads->platform_id}}" class="advert-platform-hidden" name="platform_id">

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="btn-group paymant__btnGroup ">

                                <select class="advert-category">
                                    <option value=""></option>
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}" @if($c->id == $ads->category_id)  selected @endif> {{$c->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" value="{{$ads->category_id}}" class="advert-category-hidden" name="category_id">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <input type="text" class="form-control form__control " placeholder="Elanın adı" name="name" value="{{$ads->name}}">
                        </div>
                        <div class="col-lg-4">
                            <div class="inputBox">
                                <span class="inputBox__fieldType">Vəziyyəti</span>
                                <label class="myRadio">Yeni
                                    <input type="radio" @if($ads->condition == 'new') checked @endif name="condition" value="new">
                                    <span class="myRadio__checkmark"></span>
                                </label>
                                <label class="myRadio">İşlənmiş
                                    <input type="radio" name="condition" value="old" @if($ads->condition == 'old') checked @endif>
                                    <span class="myRadio__checkmark"></span>
                                </label>

                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="btn-group paymant__btnGroup ">

                                <select class="advert-city">
                                    <option value=""></option>
                                    @foreach($cities as $c)
                                        <option value="{{$c->id}}" @if($ads->city_id == $c->id) selected @endif>{{$c->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" value="{{$ads->city_id}}" class="advert-city-hidden" name="city_id">

                            </div>
                        </div>

                        <div class="col-lg-9">
                            <textarea type="text" class="form-control form__control form__control--textarea"
                                      placeholder="Məzmun" name="description">
                                {!! $ads->description !!}
                            </textarea>
                        </div>



{{--                        <div class="col">--}}
{{--                            <label class="myFileInp  @error('img-1') is-invalid @enderror">--}}
{{--                                <input type="file" id="profile-img-1" name="img-1">--}}
{{--                                <span class="myFileInp__checkmark "><i class="fas fa-plus"></i>Şəkil 1</span>--}}
{{--                                <img src="" class=" myFileInp__img myFileInp__img-1">--}}
{{--                                @error('img-1')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </label>--}}

{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <label class="myFileInp  @error('img-2') is-invalid @enderror">--}}
{{--                                <input type="file"  id="profile-img-2" name="img-2">--}}
{{--                                <span class="myFileInp__checkmark "><i class="fas fa-plus"></i>Şəkil 2</span>--}}
{{--                                <img src="" class=" myFileInp__img myFileInp__img-2">--}}
{{--                                @error('img-2')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </label>--}}
{{--                        </div>--}}


                        <div class="col">
                            <label class="myFileInp">
                                <input type="file" id="profile-img-1" name="img-1">
                                <span class="myFileInp__checkmark"><i class="fas fa-plus my FileInp__checkmark--opacity"></i><span class="myFileInp__checkmark--opacity"> Şəkil 1</span>  </span>
                                <img @if($img1) src="/uploads/products/{{$img1->img}}" @endif class=" myFileInp__img myFileInp__img-1 myFileInp__img--opacity">
                            </label>
                        </div>
                        <div class="col">
                            <label class="myFileInp">
                                <input type="file"  id="profile-img-2" name="img-2">
                                <span class="myFileInp__checkmark"><i class="fas fa-plus my FileInp__checkmark--opacity"></i><span class="myFileInp__checkmark--opacity"> Şəkil 2</span> </span>
                                <img @if($img2) src="/uploads/products/{{$img2->img}}" @endif class=" myFileInp__img myFileInp__img-2  myFileInp__img--opacity">
                            </label>
                        </div>

                    </div>

                </div>
                <div class="user-sales-information">
                    <h3 class="box__title">SATIŞ MƏLUMATLARI</h3>
                    <div class="grayBox__content">

                        <div class="form-row">
                            <div class="col-lg-3">
                                <input type="number" step="0.01" class="form-control form__control  user-sales-information__input" value="{{$ads->sell_price}}" placeholder="Satış qiyməti" name="sell_price">
                            </div>


                        </div>

                    </div>
                </div>
                <div class="user-rental-information">
                    <h3 class="box__title">İCARƏ MƏLUMATLARI</h3>
                    <div class="grayBox__content">

                        <div class="form-row">
                            <div class="col-lg-3">
                                <input type="text" name="hire_price" value="{{$ads->hire_price}}" class="form-control form__control user-rental-information__input" placeholder="İcarə qiyməti">
                            </div>

                            <div class="col-lg-3">
                                <div class="btn-group paymant__btnGroup ">

                                    <select class="advert-rental-time">
                                        <option value=""></option>
                                        @foreach($periods as $p)
                                            <option value="{{$p->id}}" @if($p->id == $ads->hire_period_id) selected @endif>{{$p->count}} {{$p->period}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{$ads->hire_period_id}}" class="advert-rental-time-hidden" name="hire_period_id">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="hire_description" value="{{$ads->hire_description}}" class="form-control form__control  user-rental-information__input" placeholder="Əlavə qeydlər">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="user-barter-information">

                    <h3 class="box__title">BARTER MƏLUMATLARI</h3>
                    <div class="grayBox__content">

                        <div class="form-row">
                            <div class="col-lg-8">
                                <div class="inputBox">
                                    <span class="inputBox__fieldType">Barter növü</span>
                                    <label class="myRadio">Başa-baş
                                        <input type="radio" value="equal" name="barter-radio" @if('equal' == $ads->barter_type) checked @endif class="on-equal-terms" data-id="on-equal-terms">
                                        <span class="myRadio__checkmark"></span>
                                    </label>
                                    <label class="myRadio">Üstündə pul tələb edirəm
                                        <input type="radio" class="barter-take-money" value="take_money" name="barter-radio" @if('take_money' == $ads->barter_type) checked @endif data-id="on-money-terms">
                                        <span class="myRadio__checkmark"></span>
                                    </label>
                                    <label class="myRadio">Üstündə pul verirəm
                                        <input type="radio" class="barter-give-money" value="give_money" name="barter-radio" @if('give_money' == $ads->barter_type) checked @endif data-id="on-money-terms">
                                        <span class="myRadio__checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">

                                <input type="text" class="form-control form__control user-barter-information__input" value="{{$ads->barter_money}}" placeholder="Məbləğ" name="barter_money">
                            </div>

                        </div>

                    </div>
                </div>

                <div class="grayBox__content">
                    <button type="submit" class="myBtn add-advert__btn ripple-effect">ELANI DƏRC ET</button>
                </div>
            </div>
            </div>
        </div>
    </section>
</main>
@endsection


@push('scripts')

    <script>
        if($('.barter-take-money').is(':checked') || $('.barter-give-money').is(':checked')){
            $("input[name='barter_money']").show();
        }

    </script>
@endpush





