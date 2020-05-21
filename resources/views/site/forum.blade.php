@extends('site.layout')
@section('title', __('site.forum'))
@section('content')
<main>
    <section>
        <div class="container">
            <h1 class="section__headering mb-5">{{__('site.forum')}}</h1>
            <div class="grayBox mb-4">
                <div class="grayBox__content forum__content">
                    <h1 class="mb-20">{{__('site.late_discussions')}}</h1>
                    <div class="form-row">
{{--                        <div class="col-lg-3">--}}
{{--                            <div class="btn-group paymant__btnGroup ">--}}

{{--                                <select class="advert-category">--}}
{{--                                    <option value=""></option>--}}
{{--                                    <option value="AL">Kateqoriya</option>--}}
{{--                                    <option value="AL">Abkhama</option>--}}
{{--                                    <option value="AL">Alyhama</option>--}}
{{--                                    <option value="WY">Wyoming</option>--}}
{{--                                </select>--}}
{{--                                <input type="hidden" value="" class="advert-category-hidden">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="@if(\Illuminate\Support\Facades\Auth::check()) col-lg-9 @else col-lg-12 @endif">
                            <input type="text" id="forumDiscussInput" class="forum__discuss-input"  placeholder="{{__('site.search')}}" title="Type in a name">
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::check())
                        <div class="col-lg-3">
                            <a href="{{route('site.create-discussion')}}" class="forum__discuss-btn myBtn">{{__('site.create_new_discussion')}}</a>
                        </div>
                        @endif
                        <div class="col-lg-12">
                            <div class="forum__discuss">
                                <div class="forum__discuss--head">
                                    <div class="forum__discuss--item forum__discuss--item-left">{{__('site.topics')}}</div>
                                    <div class="forum__discuss--item forum__discuss--item-right forum__discuss--item-display">{{__('site.category')}}</div>
                                    <div class="forum__discuss--item forum__discuss--item-right forum__discuss--item-display">{{__('site.user')}}</div>
                                    <div class="forum__discuss--item forum__discuss--item-right  forum__discuss--like">{{__('site.likes')}}</div>
                                    <div class="forum__discuss--item forum__discuss--item-right">{{__('site.comments')}}</div>
                                    <div class="forum__discuss--item forum__discuss--item-right">{{__('site.views')}}</div>
                                </div>
                                <div class="forum__discuss--body" id="forum__discuss--body">


                                    @foreach($discussions as $d)
                                    <div class="forum__discuss--body-item">
                                        <div class="forum__discuss--item  forum__discuss--item-left">
                                            <a href="/forum/{{$d->id}}/{{$d->slug}}" class="forum__discuss--topic">{{$d->title}}</a>
                                            <div class="forum__discuss--date">{{$d->created_at->format('d-m-Y')}}</div>
                                        </div>
                                        <div class="forum__discuss--item forum__discuss--item-right forum__discuss--item-display">
                                            <i class="{{$d->category->icon}}"></i>
                                            <span>{{$d->category->name}}</span>
                                            </div>
                                        <div class="forum__discuss--item forum__discuss--item-right forum__discuss--user forum__discuss--item-display"> <i class="fas fa-user"></i>
                                            <span> {{$d->createdby->name}} </span></div>
                                        <div class="forum__discuss--item forum__discuss--item-right forum__discuss--like"> <i class="fas fa-thumbs-up"></i>
                                            <span> {{$d->likes}}</span></div>
                                        <div class="forum__discuss--item forum__discuss--item-right">
                                            <i class="fas fa-comment-alt"></i>
                                            <span>{{$d->comments}}</span>
                                        </div>
                                        <div class="forum__discuss--item forum__discuss--item-right">
                                            <i class="fas fa-eye"></i>
                                            <span> {{$d->views}} </span>
                                        </div>
                                    </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
