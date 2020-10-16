<x-admin-master>
    @section('content')
        <h1>Edit role: {{$role->name}}</h1>

        @if(session('error'))
            <x-alert type="danger" :message="session('error')"/>
        @elseif(session('success'))
            <x-alert type="success" :message="session('success')"/>
        @endif

        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('roles.update', $role)}}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{$role->name}}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-1">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @if($permissions->isNotEmpty())
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="roles" class="col-form-label text-md-right">{{ __('Permissions') }}</label>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <input type="checkbox" {{$role->hasPermission($permission->slug) ? 'checked': ''}}>
                                        </td>
                                        <td>{{$permission->id}}</td>
                                        <td>
                                            <a href="{{route('permissions.edit', $role->id)}}">{{$permission->name}}</a>
                                        </td>
                                        <td>{{$permission->slug}}</td>
                                        <td>
                                            @if($role->permissions->contains($permission))

                                                <form method="post"
                                                      action="{{route('roles.permission.detach', $role)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission"
                                                           value="{{$permission->id}}">
                                                    <button class="btn btn-danger"
                                                            @if(!$role->permissions->contains($permission)) disabled @endif>
                                                        Detach
                                                    </button>
                                                </form>
                                            @else
                                                <form method="post"
                                                      action="{{route('roles.permission.attach', $role)}}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission"
                                                           value="{{$permission->id}}">
                                                    <button class="btn btn-info"
                                                            @if($role->permissions->contains($permission)) disabled @endif >
                                                        Attach
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endsection
</x-admin-master>