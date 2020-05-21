@extends('admin.layout')
@section('title', 'Add category')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Add category </h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @foreach ($locales as $locale)
                            <li class="nav-item">
                                <a class="nav-link {{ ($locale->code == 'az') ? 'active': '' }}" id="pills-tab-{{ $locale->code }}"
                                   data-toggle="pill" href="#pills-{{ $locale->code }}" role="tab"
                                   aria-controls="pills-{{ $locale->code }}" aria-selected="true">{{ $locale->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        @foreach ($locales as $locale)
                            <div class="tab-pane fade show {{ ($locale->code == 'az') ? 'active': '' }}" id="pills-{{ $locale->code }}"
                                 role="tabpanel" aria-labelledby="pills-tab-{{ $locale->code }}">
                                <div class="form-group form-row">
                                    <div class="col-md-3"><label for="question">Name</label></div>
                                    <div class="col-md-9">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name[{{ $locale->code }}]" value="{{ old('name') }}"
                                               placeholder="{{ __('Name -').$locale->name }}" >
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        @endforeach
                            <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::id()}}" name="created_by">
                            <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::id()}}" name="updated_by">
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Parent</label>
                        <div class="col-sm-9">
                            <select name="parent_id" class="form-control  @error('parent_id') is-invalid @enderror">
                                <option value="0" >Parent</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <input id="name" type="file" class="form-control @error('img') is-invalid @enderror"
                                   name="img" value="{{ old('img') }}">
                            @error('img')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection



