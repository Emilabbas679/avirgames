@extends('admin.layout')
@section('title', 'Create Period')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create period</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('period.store') }}">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-3">
                            <label>Count</label>
                        </div>
                        <div class="col-md-9">
                            <input id="count" type="text" class="form-control @error('count') is-invalid @enderror" name="count"
                                   value="{{ old('count') }}" autocomplete="name" autofocus placeholder="{{ __('period count') }}">

                            @error('count')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="created_by" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                    <input type="hidden" name="updated_by" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                    <div class="form-group form-row">
                        <div class="col-md-3">
                            <label>Period</label>
                        </div>
                        <div class="col-md-9">
                            <select name="period" id="period"  class="form-control  @error('type') is-invalid @enderror">
                                <option value="day">Day</option>
                                <option value="week">Week</option>
                                <option value="month">Month</option>
                                <option value="year">Year</option>
                            </select>
                            @error('period')
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
