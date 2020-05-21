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
                    <tr>
                        <th>#</th>
                        <td>{{$discussion->id}}</td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{$discussion->title}}</td>
                    </tr>
                    <tr>
                        <th>Content</th>
                        <td>{!! $discussion->content !!}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{$discussion->category->name}}</td>
                    </tr>
                    <tr>
                        <th>Views</th>
                        <td>{{$discussion->views}}</td>
                    </tr>
                    <tr>
                        <th>Likes</th>
                        <td>{{$discussion->likes}}</td>

                    </tr>
                    <tr>
                        <th>Comments</th>
                        <td>{{$discussion->comments}}</td>

                    </tr>
                    <tr>
                        <th>Created by</th>
                        <td>{{$discussion->createdBy->name}} {{$discussion->createdBy->surname}}</td>

                    </tr>
                    <tr>
                        <th>Created at</th>
                        <td>{{$discussion->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Operations</th>
                        <td>
                            <form id="delete-form" action="{{ route('discussion.destroy', $discussion->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary btn-circle btn-sm" href="{{ route('discussion.edit', $discussion->id) }}">
                                    <i class="far fa-edit"></i>
                                </a>

                                <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>


                </table>
            </div>
        </div>
    </div>

@endsection
