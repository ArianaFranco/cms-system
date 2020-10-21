<x-admin-master>
    @section('content')
        @include('includes.tinyeditor')

        <h1>Create post</h1>
        <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="post_image">File</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image" aria-describedby="">
            </div>
            {{--<div class="custom-file">
                <input type="file" class="custom-file-input" id="post_image">
                <label class="custom-file-label" for="post_image">Choose file</label>
            </div>--}}
            <div class="form-group">
                <label for="body"></label>
                <textarea type="text" name="body" class="form-control" id="body" cols="30" rows="10" placeholder=""></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    @endsection
</x-admin-master>