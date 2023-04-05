@foreach($comments as $comment)
<div class="display-comment" style="padding-left: 3%;">
    <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->body }}</p>
    <div style="color:blue;" class="label" onclick="show('reply{{$comment->id}}')">Reply</div>
    <form method="post" action="{{ route('reply.add') }}" id="reply{{$comment->id}}" style="display: none;">
        @csrf
        <div class="form-group comment-{{$comment->id}}">
            <input type="text" name="body" class="form-control" />
            <input type="hidden" name="task_id" value="{{ $task_id }}" />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            <input type="submit" class="btn btn-warning btn-reply" value="Reply" />
        </div>
    </form>
    @include('tasks._comment_replies', ['comments' => $comment->replies])
</div>
<script type="text/javascript">
    window.onload = setup;

    function setup() {
   
        document.getElementById('reply{{$comment->id}}').style.display = 'reply{{$comment->id}}';

    }

    function show(newItem) {
        var item = document.getElementById(newItem);
        if (item.style.display == 'none') {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    }
</script>
@endforeach
