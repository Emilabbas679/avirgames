@extends("admin.layout")
@section('title', 'Users')
@section('content')

    <div class="card shadow mb-4">


        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Users table</h6>
            <a href="{{ route('user.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50" id="add"></i> Add New User</a>
        </div>


        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Points</th>
{{--                        <th>Balance</th>--}}
                        <th>Birthday</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Points</th>
{{--                        <th>Balance</th>--}}
                        <th>Birthday</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->surname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>@if($user->gender) Q @else K @endif</td>
                            <td>{{$user->points}}</td>
{{--                            <td>{{$user->balance}}</td>--}}
                            <td>{{$user->birthday}}</td>
                            <td>{{$user->created_at->translatedFormat('d F Y')}}</td>

                            <td>

                                @role('super-admin')
                                @if(!$user->hasRole('super-admin'))
                                    <form style="display: inline-block;" id="delete-form"
                                          action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i>
                                        </button>

                                    </form>
                                @endif
                                @endrole


                                @role('admin')
                                @if(!$user->hasRole('super-admin') and !$user->hasRole('admin'))
                                    <form style="display: inline-block;" id="delete-form"
                                          action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i>
                                        </button>

                                    </form>
                                @endif
                                @endrole

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>








@endsection
