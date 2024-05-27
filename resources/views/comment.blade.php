<div>
    <form action="{{ route('post.comment') }}" method="POST">
        @csrf
        <input type="hidden" name="blog_id" value="{{ request()->input('blog_id') }}">
        <input type="hidden" name="author_id" value="{{ request()->input('author_id') }}">

        <label for ="comment">Comment:</label>
        <textarea name="comment"></textarea>

        <button type="submit">Post Comment</button>
    </form>
</div>