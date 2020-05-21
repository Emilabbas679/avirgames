@extends("admin.layout")
@section('title', 'Payment method')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Platform table</h6>
            <a href="{{ route('payment-method.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Img</th>
                        <th>Created by</th>
                        <th>Updated by</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Img</th>
                        <th>Created by</th>
                        <th>Updated by</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($methods as $method)
                        <tr>
                            <td>{{ $method->id }}</td>
                            <td>{{ $method->name }}</td>
                            <td>
                                <img src="/uploads/payment-methods/{{$method->img}}" alt="" width="40">
                            </td>
                            <td>
                                @if($method->created_by !== 0)
                                    {{$method->createdBy->name}} {{$method->createdBy->surname}}
                                @endif
                            </td>
                            <td>
                                @if($method->updated_by !== 0)
                                    {{$method->updatedBy->name}} {{$method->updatedBy->surname}}
                                @endif
                            </td>
                            <td>{{ $method->created_at }}</td>
                            <td>{{ $method->updated_at }}</td>
                            <td>

                                <form id="delete-form" action="{{ route('payment-method.destroy', $method->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('payment-method.edit', $method->id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
