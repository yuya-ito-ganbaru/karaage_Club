@foreach ($article->comments as $comment)
  <div class="mb-2">
        <span>
            <strong>
                <a class="no-text-decoration black-color" href="{{ route('users.show', ['name' => $comment->user->name]) }}">{{ $comment->user->name }}</a>
            </strong>
        </span>
        <span>{{ $comment->comment }}</span>
        @if ($comment->user->id == Auth::id())
            <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/comments/{{ $comment->id }}">
            </a>
        @endif
  </div>
@endforeach