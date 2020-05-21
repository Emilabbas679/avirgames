@extends('site.layout')
@section('title', 'Ana Səhifə')

@section('content')
    <style>
        .is-invalid {
            border: 1px solid red;
        }
    </style>
<main>
    <section>
        <form action="{{route('site.create-ads')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <h1 class="section__headering mb-5">ELAN YERLƏŞDİR</h1>
                <div class="grayBox mb-4 d-none">
                    <div class="grayBox__content">
                        <h1 class="mb-20">ÜZVLÜK MƏLUMATLARI</h1>
                        <p class="note mb-5"><span>QEYD: </span>Daha öncə qeydiyyatdan keçmisinizsə qeydiyyatlı seçimi ilə
                            davam edin. Qeydiyyat etməmisinizsə, qeydiyyatsız seçərək
                            qeydiyyatdan keçin</p>
                        <div class="membership">
                            <a class="membership__link ripple-effect  with-registration-btn" href="javascript:void(0)">
                                <i class="fas fa-user-check"></i>
                                <span>Qeydiyyatlı</span>
                            </a>
                            <a class="membership__link ripple-effect without-registration-btn" href="javascript:void(0)">
                                <i class="fas fa-user-slash"></i>
                                <span>Qeydiyyatsız</span>
                            </a>

                        </div>
                    </div>

                </div>


                <div class="grayBox mb-4  @if(\Illuminate\Support\Facades\Auth::check()) d-none @endif " >
                    <div class="grayBox__content">
                        <h1 class="mb-20">ŞƏXSİ MƏLUMATLAR</h1>
                        <p class="note mb-5"><span>QEYD: </span>Aşağıdakı məlumatlar qeydiyyat məlumatlarından
                            götürülüb.
                            Siz elan dərc edildikdə görünəcək şəxsi məlumatlarda düzəliş
                            edə bilərsiniz.</p>

                        <div class="form-row">
                            <div class="col-lg-3 col-md-6">
                                <input type="text" value="{{old('user_name')}}" class="form-control form__control  @error('user_name') is-invalid @enderror" placeholder="Ad" name="user_name">
                                @error('user_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <input type="text" value="{{old('user_surname')}}" class="form-control form__control  @error('user_surname') is-invalid @enderror" placeholder="Soyad" name="user_surname">
                                @error('user_surname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <input type="text" value="{{old('user_phone')}}" class="form-control form__control  @error('user_phone') is-invalid @enderror" placeholder="Mobil nömrə" name="user_phone">
                                @error('user_phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <input type="email" value="{{old('user_email')}}" class="form-control form__control @error('user_email') is-invalid @enderror " placeholder="Email" name="user_email">
                                @error('user_email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-12 ">
                                <a href="#section-advert" class="myBtn ripple-effect">NÖVBƏTİ MƏRHƏLƏYƏ KEÇ</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grayBox mb-4" id="section-advert">
                    <div class="grayBox__content">
                        <h1 class="mb-20">ELAN MƏLUMATLARI</h1>
                        <p class="note mb-5"><span>QEYD: </span> Aşağıdakı məlumatlar qeydiyyat məlumatlarından
                            götürülüb.
                            Siz elan dərc edildikdə görünəcək şəxsi məlumatlarda düzəliş
                            edə bilərsiniz.</p>

                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="inputBox">
                                    <span class="inputBox__fieldType">Elanın növü</span>
                                    <label class="myCheckbox">Satıram
                                        <input type="checkbox" checked name="type[]" class="sale-checkbox" value="sell"  >
                                        <span class="myCheckbox__checkmark"></span>
                                    </label>
                                    <label class="myCheckbox">İcarəyə verirəm
                                        <input type="checkbox" name="type[]" class="rental-checkbox" value="hire" >
                                        <span class="myCheckbox__checkmark"></span>
                                    </label>
                                    <label class="myCheckbox">Barter edirəm
                                        <input type="checkbox" name="type[]" class="barter-checkbox" value="barter" >
                                        <span class="myCheckbox__checkmark"></span>
                                    </label>
                                </div>
                            </div>


                            <div class="col-lg-3">
                                <div class="btn-group paymant__btnGroup @error('platform_id') is-invalid @enderror">
                                    <select class="advert-platform  ">
                                        <option value=""></option>
                                        @foreach($platforms as $platform)
                                            <option value="{{$platform->id}}" @if(old('platform_id')==$platform->id) selected @endif>{{$platform->name}}</option>
                                        @endforeach

                                    </select>
                                    <input type="hidden" value="" class="advert-platform-hidden" name="platform_id">
                                    @error('platform_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="btn-group paymant__btnGroup @error('category_id') is-invalid @enderror">

                                    <select class="advert-category  @error('category_id') is-invalid @enderror">
                                        <option value=""></option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if(old('category_id')==$category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                    <input type="hidden" value="" class="advert-category-hidden " name="category_id">
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <input type="text" class="form-control form__control @error('name') is-invalid @enderror " placeholder="Elanın adı" name="name">
{{--                                @error('name')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
                            </div>

                            <div class="col-lg-4">
                                <div class="inputBox  @error('condition') is-invalid @enderror">
                                    <span class="inputBox__fieldType">Vəziyyəti</span>
                                    <label class="myRadio">Yeni
                                        <input type="radio" checked="checked" name="condition" value="new" @if(old('condition')=='new') checked @endif>
                                        <span class="myRadio__checkmark"></span>
                                    </label>
                                    <label class="myRadio">İşlənmiş
                                        <input type="radio" name="condition" value="old" @if(old('condition')=='old') checked @endif>
                                        <span class="myRadio__checkmark"></span>
                                    </label>
                                    @error('condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="btn-group paymant__btnGroup @error('city_id') is-invalid @enderror">

                                    <select class="advert-city  ">
                                        <option value=""></option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" @if(old('city_id') == $city->id) selected @endif>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{old('city_id')}}" class="advert-city-hidden" name="city_id">
                                    @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <textarea type="text" class="form-control form__control form__control--textarea  @error('description') is-invalid @enderror"
                                          placeholder="Məzmun" name="description"> {{old('description')}}
                                </textarea>
{{--                                @error('description')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
                            </div>
                            <div class="col">

                                <label class="myFileInp  @error('img-1') is-invalid @enderror">
                                    <input type="file" id="profile-img-1" name="img-1">
                                    <span class="myFileInp__checkmark "><i class="fas fa-plus"></i>Şəkil 1</span>
                                    <img src="" class=" myFileInp__img myFileInp__img-1">
                                    @error('img-1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </label>

                            </div>
                            <div class="col">
                                <label class="myFileInp  @error('img-2') is-invalid @enderror">
                                    <input type="file"  id="profile-img-2" name="img-2">
                                    <span class="myFileInp__checkmark "><i class="fas fa-plus"></i>Şəkil 2</span>
                                    <img src="" class=" myFileInp__img myFileInp__img-2">
                                    @error('img-2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </label>
                            </div>

                        </div>

                    </div>
                    <div class="sales-information">
                        <h3 class="box__title">SATIŞ MƏLUMATLARI</h3>
                        <div class="grayBox__content">

                            <div class="form-row">
                                <div class="col-lg-3">
                                    <input type="number" step="0.001" name="sell_price" value="{{old('sell_price')}}" class="form-control form__control  sales-information__input  @error('sell_price') is-invalid @enderror" placeholder="Satış qiyməti">
                                    @error('sell_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="rental-information">
                        <h3 class="box__title">İCARƏ MƏLUMATLARI</h3>
                        <div class="grayBox__content">

                            <div class="form-row">
                                <div class="col-lg-3">
                                    <input type="number" step="0.01" name="hire_price" class="form-control form__control rental-information__input  @error('hire_price') is-invalid @enderror" placeholder="İcarə qiyməti" value="{{old('hire_price')}}">
                                </div>

                                <div class="col-lg-3">
                                    <div class="btn-group paymant__btnGroup ">

                                        <select class="advert-rental-time  @error('hire_period_id') is-invalid @enderror">
                                            <option value=""></option>
                                            @foreach($periods as $period)
                                                <option value="{{$period->id}}" @if(old('hire_period_id') == $period->id) selected @endif>{{$period->count}}
                                                    @if($period->period == 'day') {{__('site.days')}}
                                                    @elseif($period->period == 'week') {{__('site.weeks')}}
                                                    @elseif($period->period == 'month') {{__('site.months')}}
                                                    @else {{__('site.years')}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" value="0" class="advert-rental-time-hidden" name="hire_period_id">
                                        @error('hire_period_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control form__control  rental-information__input  @error('hire_description') is-invalid @enderror" name="hire_description" placeholder="Əlavə qeydlər" value="{{old('hire_description')}}">
                                    @error('hire_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="barter-information">

                        <h3 class="box__title">BARTER MƏLUMATLARI</h3>
                        <div class="grayBox__content">

                            <div class="form-row">
                                <div class="col-lg-8">
                                    <div class="inputBox">
                                        <span class="inputBox__fieldType">Barter növü</span>
                                        <label class="myRadio">Başa-baş
                                            <input type="radio" name="barter_type" checked class="on-equal-terms" data-id="on-equal-terms" value="equal"  @if(old('barter_type') == 'equal') checked @endif>
                                            <span class="myRadio__checkmark"></span>
                                        </label>
                                        <label class="myRadio">Üstündə pul tələb edirəm
                                            <input type="radio" name="barter_type" data-id="on-money-terms" value="take" @if(old('barter_type') == 'take') checked @endif>
                                            <span class="myRadio__checkmark"></span>
                                        </label>
                                        <label class="myRadio">Üstündə pul verirəm
                                            <input type="radio" name="barter_type" data-id="on-money-terms" value="give" @if(old('barter_type') == 'give') checked @endif>
                                            <span class="myRadio__checkmark"></span>
                                        </label>
                                        @error('barter_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">

                                    <input type="number" step="0.01" class="form-control form__control barter-information__input" placeholder="Məbləğ" name="barter_price" value="{{old('barter_price')}}">
                                    @error('barter_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="grayBox__content">
                        <button type="submit" class="myBtn add-advert__btn ripple-effect">ELANI DƏRC ET</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>

@endsection


@push('scripts')
    <script>
        $('input[name="barter_type"]').click(function () {
            let barter_type = $("input[name='barter_type']:checked").val();
            if( barter_type == 'give' || barter_type=='take'){
                $("input[name='barter_price']").show()
            }
            else{
                $("input[name='barter_price']").hide()
            }
        })
    </script>
@endpush



