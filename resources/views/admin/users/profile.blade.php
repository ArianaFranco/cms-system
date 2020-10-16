<x-admin-master>
    @section('content')
        <h1>User Profile for: {{$user->name}}</h1>

        @if(session('error'))
            <x-alert type="danger" :message="session('error')"/>
        @elseif(session('success'))
            <x-alert type="success" :message="session('success')"/>
        @endif

        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data">
                    @csrf

                    @method('PUT')
                    @if(!$user->avatar)
                        <i class="fa fa-user-circle fa-4" aria-hidden="true"></i>
                    @else
                        <div class="mb-4">
                            <img class="img-profile rounded-circle" src="{{$user->avatar}}"
                                 style="height: 6rem; width: 6rem;">
                        </div>
                    @endif


                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" class="form-control-file" id="avatar" aria-describedby="">
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="surname" class="col-form-label text-md-right">{{ __('surname') }}</label>

                        <div class="col-md-12">
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                                   name="surname" value="{{$user->surname}}" required autocomplete="surname" autofocus>

                            @error('surname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-form-label text-md-right">{{ __('username') }}</label>

                        <div class="col-md-12">
                            <input id="username" type="text"
                                   class="form-control @error('username') is-invalid @enderror" name="username"
                                   value="{{$user->username}}" required autocomplete="username" autofocus>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{$user->email}}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm"
                               class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-1">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="roles" class="col-form-label text-md-right">{{ __('Roles') }}</label>
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            <input type="checkbox" {{$user->hasRole($role->name) ? 'checked': ''}}>
                                        </td>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>

                                        <td>
                                            @if($user->roles->contains($role))

                                                <form method="post" action="{{route('users.role.detach', $user)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="role" value="{{$role->id}}">
                                                    <button class="btn btn-danger"
                                                            @if(!$user->roles->contains($role)) disabled @endif>Detach
                                                    </button>
                                                </form>
                                            @else
                                                <form method="post" action="{{route('users.role.attach', $user)}}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="role" value="{{$role->id}}">
                                                    <button class="btn btn-info"
                                                            @if($user->roles->contains($role)) disabled @endif >Attach
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
            </div>

        </div>


    @endsection
</x-admin-master>