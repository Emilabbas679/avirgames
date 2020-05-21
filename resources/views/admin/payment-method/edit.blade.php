@extends('admin.layout')
@section('title', 'Edit Payment method')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Edit {{ $method->name }}</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('payment-method.update', $method->id )}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                    <div class="col-md-3"><label for="name">Name</label></div>
                                    <div class="col-md-9">
                                        <input id="question" type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name[{{ $locale->code }}]" value="{{ $method->getTranslation('name', $locale->code) }}"
                                               placeholder="{{ __('Name -').$locale->code}}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="tab-pane fade show"
                         role="tabpanel" aria-labelledby="pills-tab-{{ $locale->code }}">
                        <div class="form-group form-row">
                            <div class="col-md-3"><label for="name">Image</label></div>
                            <div class="col-md-9">
                                <img src="/uploads/payment-methods/{{$method->img}}" width="50" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show "
                         role="tabpanel" aria-labelledby="pills-tab-{{ $locale->code }}">
                        <div class="form-group form-row">
                            <div class="col-md-3"><label for="name">Image</label></div>
                            <div class="col-md-9">
                                <input id="img" type="file" class="form-control @error('img') is-invalid @enderror"
                                       name="img">
                                @error('img')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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
