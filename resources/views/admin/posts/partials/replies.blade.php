@foreach($comments as $comment)

    <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="{{$comment->user->avatar}}" alt="" style="height: 3rem; width: 3rem;">
        <div class="media-body">
            <h5 class="mt-0">{{ $comment->user->name }}</h5>
            {{ $comment->comment }}
            <div class="display-comment">
                <a href="#" class="reply">Reply comment</a>
                <form method="post" action="{{ route('comments.update', $comment->id)}}">
                    @csrf

                    @method('PUT')
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="reply_comment"></textarea>
                        <input type="hidden" name="post_id" value="{{ $post_id }}" />
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Reply" />
                    </div>
                </form>
                @include('admin.posts.partials.replies', ['comments' => $comment->replies])
            </div>
        </div>
    </div>
@endforeach


