@extends('admin.layout')
@section('title', 'Edit period Name')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Edit {{ $period->name }}</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('period.update', $period->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-row">
                        <div class="col-md-3"><label for="">Count</label></div>
                        <div class="col-md-9">
                            <input id="count" type="text" class="form-control @error('count') is-invalid @enderror" name="count"
                                   value="{{ $period->count }}" autocomplete="count" placeholder="{{ __('Count') }}">

                            @error('count')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-3"><label for="code">Period</label></div>
                        <div class="col-md-9">
                            <select name="period" id="period"  class="form-control  @error('type') is-invalid @enderror">
                                <option value="day" @if($period->period == 'day') selected @endif>Day</option>
                                <option value="week" @if($period->period == 'week') selected @endif>Week</option>
                                <option value="month" @if($period->period == 'month') selected @endif>Month</option>
                                <option value="year" @if($period->period == 'year') selected @endif>Year</option>
                            </select>
                            @error('period')
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


@push('scripts')
    <script>
        $(function () {

            $('.textarea').ckeditor();

        })

    </script>
@endpush
