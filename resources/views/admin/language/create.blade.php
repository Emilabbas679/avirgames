@extends('admin.layout')
@section('title', 'Create Language')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create language</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('language.store') }}">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-3">
                            <label>Name</label>
                        </div>
                        <div class="col-md-9">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ old('name') }}" autocomplete="name" autofocus placeholder="{{ __('Language name') }}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-3">
                            <label>Code</label>
                        </div>
                        <div class="col-md-9">
                            <input id="code" type="text" class="form-control  @error('code') is-invalid @enderror"
                                   name="code" placeholder="{{ __('Language code') }}">

                            @error('code')
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

@endsection()
