@extends('admin.layout')
@section('title', 'Edit Discussion')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Edit {{ $discussion->name }}</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('discussion.update', $discussion->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-row">
                        <div class="col-md-3"><label for="title">Title</label></div>
                        <div class="col-md-9">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" value="{{$discussion->title }}"
                                   placeholder="Title">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-3"><label for="content">Content:</label></div>
                            <textarea name="content" id="content" class="@error('title') is-invalid @enderror" cols="30" rows="10">{!! $discussion->content !!}</textarea>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-3"><label for="category">Category</label></div>
                        <div class="col-md-9">
                            <select name="category_id" id="category" class="form-control">
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}" @if($cat->id == $discussion->category_id) selected @endif>{{$cat->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Edit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection



@section('js')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>
@endsection
