@extends('site.layout')
@section('title', __('site.my profile'))
@section('content')
<main>
    <section class="profile">
        <div class="container">



            <div class="form-row profile__form-row">

                <div class="col-lg-12">
                    <div class="grayBox p-0">
                        <div class="my-profile__mainImgBox">

                            <form action="" class="my-profile__bg-img-form">
                                <div class="circle-1">

                                    <img class="bg-pic" src="/site/img/profile-bg.png" id="item-img-outputBG">


                                </div>
                                <div class="my-profile__btn-group">
                                    <div class="p-image-1 d-none">
                                        <i class="fa fa-camera upload-button-1"></i>
                                        <input class="file-upload-1  item-imgBG file " type="file" accept="image/*" />

                                    </div>

                                    <button type="submit" class="my-profile__btn my-profile__btn-bg btn">Save Background
                                        Image</button>
                                </div>

                            </form>
                            <div class="dropdown show my-profile__dropdown d-none">
                                <a class="btn btn-secondary dropdown-toggle my-profile__settings" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-cogs"></i>
                                </a>

                                <div class="dropdown-menu my-profile__dropdown-menu " aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>

                            <div class="my-profile__mainInfo">
                                <div class="my-profile__mainInfo--img-group">
                                    <div class="my-profile__userImgBox">

                                        <form action="" class="my-profile__img-form">
                                            <div class="circle">

                                                <img class="profile-pic " src="/site/img/user-default-img.png" id="item-img-output">
                                                <div class="p-image d-none">
                                                    <i class="fa fa-camera upload-button"></i>
                                                    <input class="file-upload item-img file " type="file" accept="image/*" />

                                                </div>
                                            </div>


                                            <button type="submit" class="my-profile__btn   my-profile__btn-save btn">Save</button>
                                        </form>
                                    </div>

                                    <p class="profile__userLevel d-none">Səviyyə:<span>Legend</span>
                                        <i class="fas fa-info-circle"></i>
                                    </p>
                                    <div class="profile__userProgress d-none">
                                        <div class="profile__userBar"></div>
                                    </div>
                                </div>

                                <ul class="nav  my-profile__list" id="myTab" role="tablist">
                                    <li class="my-profile__list--item">
                                        <a class="nav-link my-profile__list--link active"
                                            id="my-profile-information-tab" data-toggle="tab"
                                            href="#my-profile-information" role="tab" aria-controls="information"
                                            aria-selected="true">{{__('site.General')}}</a>
                                    </li>
                                    <li class=" my-profile__list--item">
                                        <a class="nav-link my-profile__list--link" id="my-profile-friends-tab"
                                            data-toggle="tab" href="#my-profile-friends" role="tab"
                                            aria-controls="friends" aria-selected="false">{{__('site.Friends')}}</a>
                                    </li>
                                    <li class=" my-profile__list--item">
                                        <a class="nav-link my-profile__list--link" id="my-profile-games-tab"
                                            data-toggle="tab" href="#my-profile-games" role="tab" aria-controls="games"
                                            aria-selected="false">{{__('site.games')}}(1275)</a>
                                    </li>
                                    <li class=" my-profile__list--item">
                                        <a class="nav-link my-profile__list--link" id="my-profile-advert-tab"
                                            data-toggle="tab" href="#my-profile-advert" role="tab"
                                            aria-controls="advert" aria-selected="false">{{__('site.advertisements')}}</a>
                                    </li>
                                    <li class=" my-profile__list--item">
                                        <a class="nav-link my-profile__list--link" id="my-profile-watch-tab"
                                            data-toggle="tab" href="#my-profile-watch" role="tab" aria-controls="watch"
                                            aria-selected="false">{{__('site.follow')}}(8)</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 order-2 order-lg-1">
                            <div class="grayBox my-profile__achievement">
                                <h4 class="profile-heading">{{__('site.activites')}} <i class="fas fa-info-circle"></i></h4>
                                <div class="profile__achievement__img-gorup">
                                    <div class="achievement-img"><img src="/site/img/archivements.png" alt="achievement"
                                            class="img-fluid"></div>
                                    <div class="achievement-img"><img src="/site/img/archivements.png" alt="achievement"
                                            class="img-fluid"></div>


                                </div>
                            </div>


                        </div>
                        <div class="col-lg-7 order-1 order-lg-2">
                            <div class="grayBox my-profile__tab-div">
                                <div class="tab-content" id="myTabContent">
                                    <!-- my-profile-achievement-tab -->
                                    <div class="tab-pane fade show active" id="my-profile-information" role="tabpanel"
                                        aria-labelledby="my-profile-information-tab">
                                        <form class="my-profile__form" method="post" action="{{route('site.update-profile')}}">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-sm-6 ">
                                                    <input type="text" class="form-control form__control "
                                                        placeholder="Ad" name="name" value="{{$user->name}}" required>
                                                    @error('name')
                                                    <p class="invalid-feedback mb-2" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                    @enderror
                                                </div>

                                                <div class="col-sm-6 ">
                                                    <input type="text" class="form-control form__control "
                                                        placeholder="Soyad" name="surname" value="{{$user->surname}}" required>
                                                    @error('surname')
                                                    <p class="invalid-feedback mb-2" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                    @enderror
                                                </div>


                                                <div class="col-sm-6 ">
                                                    <input type="text" class="form-control form__control "
                                                        placeholder="Mobil nömrə" name="phone" value="{{$user->phone}}" required>
                                                    @error('phone')
                                                    <p class="invalid-feedback mb-2" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <div class="inputBox">
                                                        <span class="inputBox__fieldType">{{__('site.Gender')}}</span>
                                                        <label class="myRadio">{{__('site.Male')}}
                                                            <input type="radio" name="gender"  value="0" @if($user->gender == 0) checked @endif>
                                                            <span class="myRadio__checkmark"></span>
                                                        </label>
                                                        <label class="myRadio">{{__('site.Female')}}
                                                            <input type="radio" value="1" name="gender" @if($user->gender == 1) checked @endif>
                                                            <span class="myRadio__checkmark"></span>
                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="col-sm-6 ">
                                                    <input type="text" id="bd" name="birthday" class="form-control form__control "
                                                        placeholder="{{__('site.birthday')}}" value="{{$user->birthday}}" required>
                                                    @error('birthday')
                                                    <p class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <input type ="password" class="form-control form__control "
                                                        id="form-password" name="password" placeholder="{{__('site.Password')}}" required>
                                                    @error('password')
                                                    <p class="invalid-feedback mb-2 d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <input type="password" class="form-control form__control "
                                                        placeholder="{{__('site.repeat_password')}}"
                                                        data-parsley-equalto="#form-password" name="password_confirmation" required>
                                                </div>

                                                <div class="col-sm-6">
                                                    <input type="password" placeholder="{{__('site.new_pass_desire')}}" name="new_pass" class="form-control form__control">
                                                </div>
                                                <div class="col-sm-12 ml-auto">
                                                    <button type="submit" class="myBtn">{{__('site.change')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="my-profile-friends" role="tabpanel"
                                        aria-labelledby="my-profile-friends-tab">

                                        <div class=" profile__friends">
                                            <h4 class="profile-heading">Dostlar (21 ortaq) <i
                                                    class="fas fa-info-circle"></i></h4>
                                            <div class="profile__friends__div row">

                                                <div class="profile__friends__div--img-group col-sm-6 col-md-3 ">
                                                    <div class="friend-img">
                                                        <img src="/site/img/hacibey.png" alt="hacibey" class="img-fluid">
                                                    </div>
                                                    <div class="friend-name">Hacıbəy Heydərli</div>
                                                </div>
                                                <div class="profile__friends__div--img-group col-sm-6 col-md-3 ">
                                                    <div class="friend-img">
                                                        <img src="/site/img/hacibey.png" alt="hacibey" class="img-fluid">
                                                    </div>
                                                    <div class="friend-name">Hacıbəy Heydərli</div>
                                                </div>
                                                <div class="profile__friends__div--img-group col-sm-6 col-md-3 ">
                                                    <div class="friend-img">
                                                        <img src="/site/img/hacibey.png" alt="hacibey" class="img-fluid">
                                                    </div>
                                                    <div class="friend-name">Hacıbəy Heydərli</div>
                                                </div>
                                                <div class="profile__friends__div--img-group col-sm-6 col-md-3 ">
                                                    <div class="friend-img">
                                                        <img src="/site/img/hacibey.png" alt="hacibey" class="img-fluid">
                                                    </div>
                                                    <div class="friend-name">Hacıbəy Heydərli</div>
                                                </div>
                                                <div class="profile__friends__div--img-group col-sm-6 col-md-3">
                                                    <div class="friend-img">
                                                        <img src="/site/img/hacibey.png" alt="hacibey" class="img-fluid">
                                                    </div>
                                                    <div class="friend-name">Hacıbəy Heydərli</div>
                                                </div>
                                                <div class="profile__friends__div--img-group col-sm-6 col-md-3">
                                                    <div class="friend-img">
                                                        <img src="/site/img/hacibey.png" alt="hacibey" class="img-fluid">
                                                    </div>
                                                    <div class="friend-name">Hacıbəy Heydərli</div>
                                                </div>
                                                <div class="profile__friends__div--img-group col-sm-6 col-md-3 ">
                                                    <div class="friend-img">
                                                        <img src="/site/img/hacibey.png" alt="hacibey" class="img-fluid">
                                                    </div>
                                                    <div class="friend-name">Hacıbəy Heydərli</div>
                                                </div>


                                            </div>

                                            <button type="submit" class="btn profile__btn ripple-effect">+ Bütün
                                                dostları gör
                                                (1234)</button>
                                        </div>



                                    </div>
                                    <div class="tab-pane fade" id="my-profile-games" role="tabpanel"
                                        aria-labelledby="my-profile-games-tab">
                                        <h4 class="profile-heading">Oyunlar <i class="fas fa-info-circle"></i></h4>
                                        <h4 class="profile__game--heading"><span>Ortaq Oyunlar</span></h4>
                                        <div class="profile__game__div row">
                                            <div
                                                class="profile__game__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>
                                            </div>
                                            <div
                                                class="profile__game__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>
                                            </div>
                                            <div
                                                class="profile__game__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>
                                            </div>
                                            <div
                                                class="profile__game__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="profile__game--heading"><span>Digər Oyunlar</span></h4>
                                        <div class="profile__game__div row">
                                            <div
                                                class="profile__game__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>
                                            </div>
                                            <div
                                                class="profile__game__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>
                                            </div>
                                            <div
                                                class="profile__game__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>
                                            </div>
                                            <div
                                                class="profile__game__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn profile__btn ripple-effect">+ Bütün oyunları
                                            gör
                                            (1234)</button>
                                    </div>
                                    <div class="tab-pane fade" id="my-profile-advert" role="tabpanel"
                                        aria-labelledby="my-profile-advert-tab">
                                        <div class="my-profile__advert">
                                            <div class="my-profile__advert--head">
                                                <div class="my-profile__advert--no">No</div>
                                                <div class="my-profile__advert__name">Adı</div>
                                                <div class="my-profile__advert--date">Yüklənmə tarixi</div>
                                                <div class="my-profile__advert--status">Statusu</div>
                                                <div class="my-profile__advert--type">Tipi</div>
                                                <div class="my-profile__advert--premium"></div>
                                            </div>
                                            <div class="my-profile__advert--body">
                                                @foreach($user_ads as $ads)
                                                <div class="my-profile__advert--item">
                                                    <div class="my-profile__advert--no">{{$loop->iteration}}</div>
                                                    <div class="my-profile__advert--name"> <a href="/user-advert/{{$ads->id}}" class="my-profile__advert--name-link" style="color: #ff295a"> {{$ads->name}}</a> </div>
                                                    <div class="my-profile__advert--date">{{$ads->created_at->format('d-m-Y')}}</div>
                                                    <div class="my-profile__advert--status">
                                                        @if($ads->status == 'accepted')
                                                            {{__('site.accepted')}}
                                                            @elseif($ads->status == 'pending')
                                                            {{__('site.pending')}}
                                                            @else
                                                            {{__('site.rejected')}}
                                                            @endif
                                                    </div>
                                                    <div class="my-profile__advert--type">
                                                        @if($ads->ads_type == 'general')
                                                            {{__('site.ads_general')}}
                                                        @else
                                                            {{__('site.ads_premium')}}
                                                        @endif
                                                    </div>
                                                    <div class="my-profile__advert--premium">
                                                        @if($ads->ads_type !== 'premium')

                                                        <a class="advertInner__listLink my-profile__advert--premium-link ripple-effect" href="javascript:void(0)" data-toggle="modal" data-target="#premiumModal"><i class="fas fa-gem" style="color: #ffaa64;"></i>PREMİUM ELAN ET</a>
                                                        @endif

                                                    </div>
                                                </div>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="my-profile-watch" role="tabpanel"
                                        aria-labelledby="my-profile-watch-tab">  <h4 class="profile-heading">İzlədikləri <i class="fas fa-info-circle"></i></h4>
                                        <div class="profile__watch__div row">
                                            <div class="profile__watch__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>

                                            </div>
                                            <div class="profile__watch__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>

                                            </div>
                                            <div class="profile__watch__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>

                                            </div>
                                            <div class="profile__watch__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>

                                            </div>
                                            <div class="profile__watch__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>

                                            </div>
                                            <div class="profile__watch__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>

                                            </div>
                                            <div class="profile__watch__div--img-group col-sm-6 col-md-3 col-lg-4 col-xl-3">
                                                <div class="game-group">
                                                    <img src="/site/img/farchy.png" alt="farcy" class="game-group--img">
                                                    <div class="game-group--div">
                                                        <img src="/site/img/playstation.png" alt="">
                                                        <span>PS4</span>
                                                    </div>
                                                    <p class="game-group--name">Far Cry New Dawn</p>
                                                </div>

                                            </div>
                                        </div>
                                        <button type="submit" class="btn profile__btn ripple-effect">+ Bütün oyunları gör (1234)</button></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>



<!-- Modal FOR PREMIUM -->
<div class="modal fade" id="premiumModal" tabindex="-1" role="dialog" aria-labelledby="premiumModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="premiumModalLabel">Premium Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL FOR AVATAR IMAGE -->
  <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

<div class="modal-body">
  <div id="upload-demo" class="center-block"></div>
</div>
          <div class="modal-footer">
<button type="button" class="btn btn-default" data dismiss="modal">Close</button>
<button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
</div>
    </div>
  </div>
</div>
  <!-- MODAL FOR BG IMAGE -->
  <div class="modal fade" id="cropImagePopBG" tabindex="-1" role="dialog" aria-labelledby="myModalLabelBG" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

<div class="modal-body">
  <div id="upload-demoBG" class="center-block"></div>
</div>
          <div class="modal-footer">
<button type="button" class="btn btn-default" data dismiss="modal">Close</button>
<button type="button" id="cropImageBtnBG" class="btn btn-primary">Crop</button>
</div>
    </div>
  </div>
</div>



@endsection
