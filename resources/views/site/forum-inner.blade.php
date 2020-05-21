@extends('site.layout')
@section('title', $discussion->title)
@section('content')
    <main>
        <section>
            <div class="container">
                <h1 class="section__headering mb-5">{{__('site.forum')}}</h1>
                <div class="grayBox forum-inner">

                    <div class="forum-inner__div">
                        <div class="forum-inner__name-group">
                            <div class="forum-inner__name">
                                <i class="fas fa-user"></i>
                                <span>{{$discussion->createdby->name}}</span>
                            </div>
                            <div class="forum-inner__category">

                                <i class="{{$discussion->category->icon}}"></i>
                                <span>{{$discussion->category->name}}</span>
                            </div>
                        </div>
                        <div class="forum-inner__content">
                            <div class="forum-inner__content__group pb-3">
                                <div class="forum-inner__text-group">
                                    <div class="forum-inner--topic">{{$discussion->title}}</div>
                                    <p class="forum-inner--text">{!! $discussion->content !!}</p>
                                </div>
                                <div class="forum-inner__icon-group">
                                    <div class="forum-inner__date-group">
                                        <div class="forum-inner__views">
                                            <i class="fas fa-eye mr-2"></i>
                                            <span> {{$discussion->views}} </span>
                                        </div>
                                        <div class="forum-inner__date">
                                            <i class="fas fa-calendar mr-2"></i>
                                            <span>20.02.2020</span>
                                        </div>
                                    </div>
                                    <div class="forum-inner__like-group">
                                        <div class="forum-inner__like">
                                            <i class="fas fa-heart mr-2"></i>
                                            <span> {{$discussion->likes}} </span>
                                        </div>
                                        <div  class="forum-inner--comment">
                                            <i class="fas fa-comment mr-2"></i>
                                            <span>{{$discussion->comments}}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @if(\Illuminate\Support\Facades\Auth::check())

                            <div class="forum-inner__social-group">
                                <ul class="forum-inner__social">
                                    <li class="forum-inner__social--item"><a href="#"
                                                                             class="forum-inner__social--link fab fa-facebook-f"></a></li>
                                    <li class="forum-inner__social--item"><a href="#"
                                                                             class="forum-inner__social--link fab fa-instagram"></a></li>
                                    <li class="forum-inner__social--item"><a href="#"
                                                                             class="forum-inner__social--link fab fa-twitter"></a></li>
                                </ul>
                                <button class="forum-inner__btn"><i class="fas fa-comments mr-3"></i>{{__('site.add_comment')}}</button>
                            </div>
                                @endif
                        </div>
                    </div>

                </div>
                <div class="forum-inner__discuss grayBox ">
                    <form class="forum-inner__discuss--div" method="post">
                        @csrf
                    <textarea name="content" id="" cols="30" rows="3" class="forum-inner__discuss--textarea"
                              placeholder="{{__('site.add_comment')}}"></textarea>
                        <button class="forum-inner__discuss--btn" type="submit">{{__('site.add')}}</button>
                    </form>
                </div>

                @foreach($comments as $c)
                    <div class="grayBox forum-inner__comment">
                        <div class="forum-inner__comment__div">
                            <div class="forum-inner__comment--icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="forum-inner__comment__content">
                                <div class="forum-inner__comment__content__group">
                                    <div class="forum-inner__comment__text-group">
                                        <div class="forum-inner__comment--name">
                                            <span>{{$c->createdby->name}}</span>
                                        </div>
                                        <p class="forum-inner__comment--text">{!! $c->content !!}</p>
                                    </div>
                                    <div class="forum-inner__comment__date">
                                        <i class="fas fa-calendar mr-2"></i>
                                        <span>{{$c->created_at->format('d-m-y')}}</span>
                                    </div>
                                </div>
{{--                                <div class="forum-inner__comment__like--div">--}}
{{--                                    <div class="forum-inner__comment__like--text-group">--}}
{{--                                        <i class="forum-inner__comment__like fas fa-thumbs-up"></i>--}}
{{--                                        <p>{{__('site.usefull')}}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </section>
    </main>


@endsection


