<div class="card-body line-height">
    <div id="comment-article-{{ $article->id }}">
        @include('topPages/comment_list')
    </div>
    <a class="light-color post-time no-text-decoration" href="/articles/{{ $article->id }}">{{ $article->created_at }}</a>
    <hr>
    <div class="row actions" id="comment-form-article-{{ $article->id }}">
        <form class="w-100" id="new_comment" action="/articles/{{ $article->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="&#x2713;" />
            {{csrf_field()}}
            <input value="{{ $article->id }}" type="hidden" name="article_id" />
            <input value="{{ Auth::id() }}" type="hidden" name="user_id" />
            <input class="form-control comment-input border-0" placeholder="コメント ..." autocomplete="off" type="text" name="comment" />
        </form>
    </div>
</div>
</div>