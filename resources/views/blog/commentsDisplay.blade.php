<style>
    .display-comment{
        margin-left:200px;
        margin-right: 125px;

    }

</style>

@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) @endif>
        <a href="{{ $comment->user->avatar }}"><img class="rounded-circle" height="70" width="70" style="float:left;"
        src="{{ $comment->user->avatar }}" alt="User profile picture"></a>



        <strong style="font-size: 1.20rem; font-weight:bold; float:left;">{{ $comment->user->name }}
        &nbsp;
        &nbsp;
        <br>
        &nbsp;
        <span style="color: gray;font-size: small; font-style:italic;">{{ $comment->created_at->diffForHumans() }}</span></strong>
        <br><br><br>
        <p style="float:left; text-align: justify;">{{ $comment->body }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
        @include('blog.commentsDisplay', ['comments' => $comment->replies])
       <br><br>
    </div>
@endforeach
