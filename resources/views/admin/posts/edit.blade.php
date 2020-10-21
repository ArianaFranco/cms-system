<x-admin-master>
    @section('content')
        @include('includes.tinyeditor')

        <h1>Edit post</h1>
        <form method="post" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby=""
                       placeholder="Enter title" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <div><img src="{{$post->post_image}}" height="100px"></div>
                <label for="post_image">File</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image" aria-describedby=""
                       placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="body"></label>
                <textarea type="text" name="body" class="form-control" id="body" cols="30" rows="10"
                          placeholder="">{{$post->body}}</textarea>
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