@extends('site.layout')
@section('content')

    <main>
        <section>
            <div class="container">
                <h1 class="section__headering mb-5">Forum</h1>
                <div class="grayBox mb-4 discussion">
                    <div class="grayBox__content discussion__content ">
                        <h1 class="mb-20 discussion__h1">Müzakirə Yaradın</h1>
                        <div class="form-row">
                            <div class="col-md-8 col-lg-9 mx-auto">
                                <form action="{{route('site.add-discussion')}}" class="discussion__form" method="post">
                                    @csrf
                                    <div class="form-group mb-4 ">
                                        <label for="discussionSubject" class="discussion__label">Mövzu</label>
                                        <input type="text" name="subject" class="form-control discussion__subject-input @error('subject') is-invalid @enderror" id="discussionSubject"
                                               placeholder="Mövzu">
                                    </div>

                                    <div class="form-group mb-4 ">
                                        <label for="discussionContent" class="discussion__label">Kateqoriya seçin</label>
                                        <div class="btn-group discussion__select @error('category') is-invalid @enderror">
                                            <select class="advert-category discussion__category " name="category">
                                                <option value=""></option>
                                                @foreach($categories as $c)
                                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" value="" class="discussion__category-hidden">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 ">
                                        <label class="discussion__label">Məzmun</label>
                                        <textarea name="discussionEditor" class=""></textarea>
                                    </div>
                                    <button class="discussion__btn ripple-effect" type="submit">Yarat</button>
                                </form>

                            </div>
                            <!-- <div class="col-md-4 col-lg-3">
                                <p class="discussion__right">Müzakirənizə şərh yazıldıqda e-poçt ilə bildiriş alacaqsınız.</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>



    @endsection
