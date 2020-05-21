@extends("admin.layout")
@section('title', 'Platform')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Platform table</h6>
            <a href="{{ route('platform.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Logo</th>
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
                        <th>Parent</th>
                        <th>Logo</th>
                        <th>Created by</th>
                        <th>Updated by</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($platforms as $platform)
                        <tr>
                            <td>{{ $platform->id }}</td>
                            <td>{{ $platform->name }}</td>
                            <td>
                                @if($platform->parent == 0)
                                    Parent
                                    @else
                                    {{$platform->parent_id}}
{{--                                    {{$platform->selfPlatform->name}}--}}
                                @endif
                            </td>
                            <td>
                                <img src="/uploads/platform/{{$platform->img}}" width="100" height="50" alt="">
                            </td>
                            <td>
                                @if($platform->created_by !== 0)
                                    {{$platform->createdBy->name}} {{$platform->createdBy->surname}}
                                @endif
                            </td>
                            <td>
                                @if($platform->updated_by !== 0)
                                    {{$platform->updatedBy->name}} {{$platform->updatedBy->surname}}
                                @endif
                            </td>
                            <td>{{ $platform->created_at }}</td>
                            <td>{{ $platform->updated_at }}</td>
                            <td>

                                <form id="delete-form" action="{{ route('platform.destroy', $platform->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('platform.edit', $platform->id) }}">
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
