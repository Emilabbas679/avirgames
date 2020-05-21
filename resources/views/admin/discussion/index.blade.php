@extends("admin.layout")
@section('title', 'Discussion')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Discussion table</h6>
            <a href="{{ route('discussion.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created by</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>

                        <th>Created by</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($discussions as $discussion)
                        <tr>
                            <td>{{ $discussion->id }}</td>
                            <td>{{ $discussion->title }}</td>
                            <td>
                                {{$discussion->category->name}}
                            </td>

                            <td>
                                @if($discussion->created_by !== 0)
                                    {{$discussion->createdBy->name}} {{$discussion->createdBy->surname}}
                                @endif
                            </td>
                            <td>{{ $discussion->created_at }}</td>
                            <td>

                                <form id="delete-form" action="{{ route('discussion.destroy', $discussion->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('discussion.edit', $discussion->id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{route('discussion.show',$discussion->id)}}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="far fa-eye"></i>
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
