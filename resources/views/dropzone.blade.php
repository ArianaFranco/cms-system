<x-admin-master>


@section('styles')
    <link rel="stylesheet" href="{{asset('css/dropzone-style.css')}}">
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Upload Images') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{route('images-upload.store')}}" method="post" class="dropzone" id="myDropzone" enctype="multipart/form-data">
                            @csrf
                            <div class="fallback">
                                <input name="file" type="file" multiple/>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{ asset('js/dropzone-script.js') }}" defer></script>
@endsection
</x-admin-master>