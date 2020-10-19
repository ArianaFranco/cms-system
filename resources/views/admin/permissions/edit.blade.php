<x-admin-master>
    @section('content')
        <h1>Edit permission: {{$permission->name}}</h1>

        @if(session('error'))
            <x-alert type="danger" :message="session('error')"/>
        @elseif(session('success'))
            <x-alert type="success" :message="session('success')"/>
        @endif

        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('permissions.update', $permission)}}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{$permission->name}}">

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

        </div>
    @endsection
</x-admin-master>