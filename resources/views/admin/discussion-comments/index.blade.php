@extends('admin.layout')
@section('title', 'comments')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">comment table</h6>
            <a href="{{ route('discussion-comment.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add new</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Comment</th>
                        <th>Discussion</th>
                        <th>Created by</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Comment</th>
                        <th>Discussion</th>
                        <th>Created by</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->discussion->title }}</td>
                            <td>{{$comment->createdby->name}} {{$comment->createdby->surname}}</td>

                            <td>{{ $comment->created_at }}</td>
                            <td>
                                <form id="delete-form" action="{{ route('discussion-comment.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
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

@endsection()
