<x-admin-master>
    @section('content')
        <h1>Users</h1>


        @if(session('message'))
            <div class="alert alert-danger">{{session('message')}}</div>
        @elseif(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Avatar</th>
                            <th>Created At</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Avatar</th>
                            <th>Created At</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td><a href="{{route('users.edit', $user->id)}}">{{$user->fullname}}</a></td>
                                <td>{{$user->username}}</td>
                                <td>
                                    <img class="img-profile rounded-circle" src="{{$user->avatar}}" alt="" style="height: 3rem; width: 3rem;">
                                </td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                <td>
                                    <form method="post" action="{{route('users.destroy', $user->id)}}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="mx-auto">
                {{--{{$users->total()}}--}}
                {{$users->links()}}
            </div>
        </div>



    @endsection
    @section('scripts')

    @endsection
</x-admin-master>